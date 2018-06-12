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

    	return $this->exportReportToExcel($itemId);
    }

    /**
     * Export Test Report to Excel
     * @param $itemId
     * @return Download
     */
    public function exportReportToExcel($itemId)
    {
        $itemTests = ItemsTestRecord::where('ItemID', $itemId)->get();
        if(count($itemTests) < 1)
        {
            return redirect()->back()->with('message', 'This item has no test records');
        }

    	$exportData = new ItemTestsExport($itemId);

    	return Excel::download($exportData, 'ItemTestReport.xls');
    }

    public function exportAllTests()
    {
        $exportData = new ItemTestsExport();

        return Excel::download($exportData, 'ItemTestReports.xls');
    }
}
