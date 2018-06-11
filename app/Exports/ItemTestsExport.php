<?php

namespace App\Exports;

use App\Models\Item;
use App\Models\ItemsTestRecord;
use App\Models\Lab;
use App\Models\Standard;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ItemTestsExport implements FromView
{
	public function __construct($itemId = null)
	{
	    $this->itemId = $itemId;
	}

    public function view(): View
    {
        if(isset($itemId))
        {
            $itemTests = ItemsTestRecord::where('ItemID', $this->itemId)->get();

            $item = Item::where('itemid', $this->itemId)->get();
            $lab = Lab::where('id', $itemTests[0]->TestLab)->get();

            return view('export-views.item-tests.excelTemplate', [
                'itemTests' => $itemTests,
                'item' => $item
            ]);
        }

        $tests = Standard::pluck('stdname');
        $itemTests = ItemsTestRecord::all()->groupBy('ItemID');



        return view('export-views.item-tests.excelTemplateAllTests', [
        'itemTests' => $itemTests,
        'tests' => $tests
        ]);

    }
}