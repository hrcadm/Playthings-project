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

class ExportItemTestReportController extends Controller
{

    public function exportItemTestReportView()
    {
    	$items = Item::pluck('itemid');
        $items = $items->toArray();

        $items = array_combine($items, $items);

    	return view('export-views.item-tests.select', compact('items'));
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
        return redirect()->back()->withErrors('Developing...');
    }
}
