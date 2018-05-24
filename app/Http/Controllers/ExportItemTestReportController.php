<?php

namespace App\Http\Controllers;

use App\Exports\ItemTestsExport;
use App\Models\Item;
use App\Models\ItemsTestRecord;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\Exception\Exception;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\TablePosition;

class ExportItemTestReportController extends Controller
{

    public function exportItemTestReportView()
    {
    	$items = Item::pluck('itemid');
        $items = $items->toArray();

        $items = array_combine($items, $items);

        if(\Auth::check())
        {
    	   return view('export-views.item-tests.select', compact('items'));
        }

        return view('export-views.item-tests.guestSelect', compact('items'));
    }

    /**
     *  Handles Test Reports exports logic
     * @param  Request $request
     * @return download
     */
    public function exportItemTestReport(Request $request)
    {
    	$itemId = $request->item;
    	$type = $request->type;

    	switch ($type) {
    		case 'excel':
    			return $this->exportReportToExcel($itemId);
    			break;

			case 'pdf':
    			return $this->exportReportToPdf($itemId);
    			break;

			case 'word':
    			return $this->exportReportToWord($itemId);
    			break;

    		default:
    			return redirect()->back()->withErrors('Please select all required inputs.');
    			break;
    	}
    }

    /**
     * Export Test Report to Excel
     * @param $itemId
     * @return Download
     */
    public function exportReportToExcel($itemId)
    {
    	$exportData = new ItemTestsExport($itemId);

    	return Excel::download($exportData, 'ItemTestReport.xls');
    }

    public function exportReportToPdf($itemId)
    {
        $itemTests = ItemsTestRecord::where('ItemID', $itemId)->get();
        $item = Item::where('itemid', $itemId)->get();

        $data = [
            'itemTests' => $itemTests,
            'item' => $item
        ];


        $pdf = PDF::loadView('export-views.item-tests.pdfTemplate',$data);
        return $pdf->download('ItemTestReport.pdf');
    }

    public function exportReportToWord($itemId)
    {
        $itemTests = ItemsTestRecord::where('ItemID', $itemId)->get();
        $item = Item::where('itemid', $itemId)->get();

        $wordDoc = new \PhpOffice\PhpWord\PhpWord();

        $title = 'Item Safety Test Report';
        $styleTitle = ['size' => 20, 'bold' => true];

        // Handling badly stored data to get a string
        $substrateLvl = $itemTests[0]->SubstrateLvl;
        switch ($substrateLvl) {
            case 1:
                $substrateLvl = ' 600 PPM';
                break;
            case 2:
                $substrateLvl = ' 300 PPM';
                break;
            case 3:
                $substrateLvl = ' 100 PPM';
                break;

            default:
                $substrateLvl = 'N/A';
                break;
        }

        // Handling badly stored data to get a string
        $surfaceLvl = $itemTests[0]->SurfaceLvl;
        switch ($surfaceLvl) {
            case 1:
                $surfaceLvl = ' 600 PPM';
                break;
            case 2:
                $surfaceLvl = ' 90 PPM';
                break;

            default:
                $surfaceLvl = 'N/A';
                break;
        }

        $addSection = $wordDoc->addSection();

        $addSection->addText($title);
        $addSection->addTextBreak(1);
        $addSection->addText(
            ' Item ID: '.$itemTests[0]->ItemID.
            $item[0]->desc1
            . 'Lab: '.$itemTests[0]->LabName
            . 'Test Report No: '.$itemTests[0]->ReptNo
            . 'Test Report PDF: '.$itemTests[0]->TestReptPdf
            . 'CPSIA Lead Substrate Level: '.$substrateLvl
            . 'CPSIA Lead Surface Coating Level: '.$surfaceLvl
        );

        $addSection->addTextBreak(1);

        $table = $addSection->addTable();

        // Table head
        $row = $table->addRow();
        $row->addCell()->addText('Test Date / Report Number');
        $row->addCell()->addText('Test Name');
        $row->addCell()->addText('Test Description');

        // Table body
        foreach ($itemTests as $test) {
            $row = $table->addRow();
            $row->addCell()->addTextRun($test->TestDate);
            $row->addCell()->addTextRun($test->StdName);
            $row->addCell()->addTextRun($test->StdDesc);
        }

        // Storing the Doc
        $complete = \PhpOffice\PhpWord\IOFactory::createWriter($wordDoc, 'Word2007');

        header("Content-Disposition: attachment; filename='ItemTestReport.docx'");

        ob_clean();
        $a = $complete->save("php://output");

        return $a;
    }
}
