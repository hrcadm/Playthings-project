<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Factory;
use App\Models\Vendor;
use App\Models\Lab;
use Illuminate\Http\Request;
use App\Models\ItemsTestRecord;
use Barryvdh\DomPDF\Facade as PDF;

class ExportCocController extends Controller
{
    public function exportCocView()
    {
    	$items = Item::pluck('itemid');
        $items = $items->toArray();

        $items = array_combine($items, $items);

        if(\Auth::check())
        {
            return view('export-views.coc.select', compact('items'));
        }
    	return view('export-views.coc.guestSelect', compact('items'));
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

		return $this->exportCocToPdf($itemId);
    }

    /**
     *  EXPORT COC TO PDF
     * @param $itemId
     * @return PDF document
     */
    public function exportCocToPdf($itemId)
    {
        $itemTests = ItemsTestRecord::where('ItemID', $itemId)->get();

        $item = Item::where('itemid', '=', $itemTests[0]->ItemID)->get();

        $factory = Factory::where('vendorno', '=', $item[0]->factoryno)->get();

        $vendor = Vendor::where('vendno', '=', $factory[0]->vendorno)->get();

        $lab = Lab::where('id', '=', $itemTests[0]->TestLab)->get();

        $data = [
            'tests' => $itemTests,
            'item' => $item,
            'factory' => $factory,
            'vendor' => $vendor,
            'lab' => $lab
        ];

        $pdf = PDF::loadView('export-views.coc.template', $data);

        return $pdf->download('invoice.pdf');
    }
}
