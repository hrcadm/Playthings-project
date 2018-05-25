<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Models\Item;
use App\Models\ItemsTestRecord;
use App\Models\Lab;
use App\Models\Standard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemsTestRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // generate years for dropdown dinamically
        $years = $this->yearsForDropdown();

        // get items list for dropdown
        $items = Item::pluck('itemid');
        $items = $items->toArray();

        $items = array_combine($items, $items);

        if(Auth::user()->role === 'admin')
        {
            return view('itemstestrecords.index', compact('years', 'items'));
        }


        return view('itemstestrecords.index', compact('years', 'items'));
    }

    /**
     * Update index method from year dropdown
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function updateIndex(Request $request)
    {
        // generate years for dropdown dinamically
        $years = $this->yearsForDropdown();

        // get items list for dropdown
        $items = Item::pluck('itemid');
        $items = $items->toArray();

        $items = array_combine($items, $items);

        if ($request->has('item'))
        {
            if(Auth::user()->role === 'admin')
            {
                $itemsTest = ItemsTestRecord::where('ItemID', '=', $request->item)->whereYear('TestDate', '=', date('Y'))->paginate(10);

                if ($itemsTest == '') {
                    $itemsTest = $request->item;
                }

                return view('itemstestrecords.index', compact('itemsTest', 'years', 'items'));
            }

            $itemsTest = ItemsTestRecord::where('ItemID', '=', $request->item)->whereYear('TestDate', '=', date('2016'))->paginate(10);


            return view('itemstestrecords.index', compact('itemsTest', 'years', 'items'));
        }

        if($request->has('year') && $request->has('selectedItem'))
        {
            $selectedYear = $request->year;
            $selectedItem = $request->selectedItem;

            if(Auth::user()->role === 'admin')
            {
                $itemsTest = ItemsTestRecord::where('ItemID', '=', $request->selectedItem)->whereYear('TestDate', '=', $selectedYear)->paginate(10);

                return view('itemstestrecords.index', compact('itemsTest', 'years', 'items', 'selectedItem'));
            }
        }



        return view('itemstestrecords.index', compact('years', 'items'))->withErrors('Choose an Item first.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = Item::pluck('itemid', 'desc1');

        $itemList =[];

        foreach($item as $i => $a)
        {
            array_push($itemList, $a.' [ '.$i.' ]');
        }

        foreach($itemList as $key => $val) {
            $value = explode(" ", $val);

            $items[$value[0]]=$val;
        }

        $lab = Lab::pluck('labname');
        $factory = Factory::pluck('factname');
        $standards = Standard::pluck('stdname');

        return view('itemstestrecords.manage', compact('items', 'lab', 'factory', 'standards'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach($request->tests as $store)
        {
            $test = ItemsTestRecord::create($request->all());
        }

        return redirect()->route('itemstestrecord.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $itemTest = ItemsTestRecord::findOrFail($id);

        $item = Item::pluck('itemid', 'desc1');

        $items =[];

        foreach($item as $i => $a)
        {
            array_push($items, $a.' [ '.$i.' ]');
        }

        $lab = Lab::pluck('labname');
        $factory = Factory::pluck('factname');
        $standards = Standard::pluck('stdname');

        return view('itemstestrecords.manage', compact('itemTest', 'items', 'lab', 'factory', 'standards'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Generate a dropdown list for Item Test Reports
     *
     * @return $combinedArray
     */
    public function yearsForDropdown()
    {
        // current year
        $endYear = date('Y');
        // 20 years back limit
        $startYear = $endYear - 20;

        // initiate array
        $years = [];

        // foreach year from this to 20 years ago, populate array
        foreach(range(date('Y'), $startYear) as $year)
        {
            array_push($years, $year);
        }

        // combining same key as value (2018 => 2018) cuz of dropdown option value
        $combinedArray = array_combine($years, $years);

        return $combinedArray;
    }
}
