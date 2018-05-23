<?php

namespace App\Exports;

use App\Models\Item;
use App\Models\ItemsTestRecord;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ItemTestsExport implements FromView
{
	public function __construct($itemId)
	{
	    $this->itemId = $itemId;
	}

    public function view(): View
    {
    	$itemTests = ItemsTestRecord::where('ItemID', $this->itemId)->get();
    	$item = Item::where('itemid', $this->itemId)->get();
        $lab = Lab::where('id', $itemTests[0]->TestLab)->get();

        return view('export-views.items-tests.excelTemplate', [
            'itemTests' => $itemTests,
            'item' => $item
        ]);
    }
}