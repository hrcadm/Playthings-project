<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Facades\Excel;

class ExportCocController extends Controller
{
    public function exportItemTestReportView()
    {
    	$items = Item::pluck('itemid');
        $items = $items->toArray();

        $items = array_combine($items, $items);

    	return view('export-views.coc.select', compact('items'));
    }

    /**
     *  Handles Coc exports logic
     * @param  Request $request
     * @return download
     */
    public function exportCoc(Request $request)
    {
    	$itemId = $request->item;
    	$type = $request->type;

    	switch ($type) {
    		case 'excel':
    			return $this->exportCocToExcel($itemId);
    			break;

			case 'pdf':
				return $this->exportCocToPdf($itemId);
				break;

			case 'word':
				return $this->exportCocToWord($itemId);
				break;

    		default:
    			return redirect()->back()->withErrors('Please select all required inputs.');
    			break;
    	}
    }

    /**
     * Export CoC to Excel
     * @param $itemId
     * @return Download
     */
    public function exportCocToExcel($itemId)
    {
    	//$exportData = new ItemTestsExport($itemId);

    	//return Excel::download($exportData, 'Cert of Conformity.xls');

        return redirect()->back()->withErrors('Developing...');
    }

    public function exportCocToPdf($itemId)
    {
        return redirect()->back()->withErrors('Developing...');
    }

    public function exportCocToWord($itemId)
    {
        return redirect()->back()->withErrors('Developing...');
    }
}
