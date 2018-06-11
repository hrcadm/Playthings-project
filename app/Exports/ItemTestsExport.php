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
        if(isset($this->itemId))
        {
            $itemTests = ItemsTestRecord::where('ItemID', $this->itemId)->get();

            $item = Item::where('itemid', $this->itemId)->get();
            $lab = Lab::where('id', $itemTests[0]->TestLab)->get();

            return view('export-views.item-tests.excelTemplate', [
                'itemTests' => $itemTests,
                'item' => $item
            ]);
        } else {


            $tests = Standard::pluck('stdname')->toArray();
            $itemTests = ItemsTestRecord::whereYear('TestDate', '>=', date('2017'))->get()->groupBy('ItemID')->toArray();

            $array = $itemTests;

            foreach($array as $key => $value)
            {
                foreach($value as $k => $v)
                {
                    $array[$key]['Desc1'] = $v['Desc1'];
                }
            }

            return view('export-views.item-tests.excelTemplateAllTests', [
            'itemTests' => $itemTests,
            'tests' => $tests,
            'array' => $array
            ]);

        }

    }
}