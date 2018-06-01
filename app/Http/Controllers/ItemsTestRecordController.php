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
        asort($items);

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
        asort($items);

        $selectedItem = $request->item;
        $selectedYear = $request->year;

        if ($request->has('item') && ($selectedYear == null || $selectedYear === 'All'))
        {
            if(Auth::user()->role === 'admin')
            {
                $itemsTest = ItemsTestRecord::where('ItemID', '=', $request->item)->get();

                return view('itemstestrecords.index', compact('itemsTest', 'years', 'items'));
            }

            $itemsTest = ItemsTestRecord::where('ItemID', '=', $request->item)->whereYear('TestDate', '=', date('2016'))->get();


            return view('itemstestrecords.index', compact('itemsTest', 'years', 'items', 'selectedItem'));
        }

        if($request->has('year') && $request->has('item'))
        {
            if(Auth::user()->role === 'admin')
            {
                $itemsTest = ItemsTestRecord::where('ItemID', '=', $selectedItem)->whereYear('TestDate', '=', $selectedYear)->get();

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
        asort($items);

        $lab = Lab::pluck('labname', 'id');
        foreach($lab as $k => $v)
        {
            $labs[$k]=$v;
        }
        asort($labs);


        $factory = Factory::pluck('factname', 'wdt_ID');
        foreach($factory as $k => $v)
        {
            $factories[$k]=$v;
        }
        asort($factories);


        $standards = Standard::pluck('stdname');

        return view('itemstestrecords.manage', compact('items', 'labs', 'factories', 'standards', 'itemTest'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $labName = Lab::where('id', '=', $request->LabName)->first();

        // Create new Item
        $newItem = new Item();
        $newItem->itemid = $request->ItemID;
        $newItem->save();

        foreach($request->tests as $testKey => $testValue)
        {
            // Find Test Desc
            $testDesc = Standard::where('stdname', $testValue)->first();


            $test = new ItemsTestRecord();
            $test->ItemID = $request->ItemID;
            $test->TestLab = $request->LabName;
            $test->Active = -1;
            $test->Desc1 = $request->Desc1;
            $test->LabName = $labName->labname;
            $test->StdName = $testValue;
            $test->StdDesc = $testDesc->stddesc;
            $test->TestDate = $request->TestDate;
            $test->TestReptPdf = $request->TestReptPdf;
            $test->ReptNo = $request->ReptNo;
            $test->SubstrateLvl = $request->SubstrateLvl;
            $test->SurfaceLvl = $request->SurfaceLvl;
            $test->poNumber = $request->poNumber;
            $test->factId = $request->factname;
            $test->save();
        }

        return redirect()->route('items-test-records.index')->with('message', 'Item Test Record stored successfully!');
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
            $items[$a] = $a.' [ '.$i.' ]';
        }
        asort($items);

        $lab = Lab::pluck('labname', 'id');
        foreach($lab as $k => $v)
        {
            $labs[$k]=$v;
        }
        asort($labs);


        $factory = Factory::pluck('factname', 'wdt_ID');
        foreach($factory as $k => $v)
        {
            $factories[$k]=$v;
        }
        asort($factories);

        $standards = Standard::pluck('stdname');

        return view('itemstestrecords.manage', compact('itemTest', 'items', 'labs', 'factories', 'standards'));
    }

    /**
     * Show the form for cloning the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clone($id)
    {
        $itemTest = ItemsTestRecord::findOrFail($id);

        $item = Item::pluck('itemid', 'desc1');

        $items =[];

        foreach($item as $i => $a)
        {
            $items[$a] = $a.' [ '.$i.' ]';
        }
        asort($items);

        $lab = Lab::pluck('labname', 'id');
        foreach($lab as $k => $v)
        {
            $labs[$k]=$v;
        }
        asort($labs);


        $factory = Factory::pluck('factname', 'wdt_ID');
        foreach($factory as $k => $v)
        {
            $factories[$k]=$v;
        }
        asort($factories);

        $standards = Standard::pluck('stdname');

        return view('itemstestrecords.clone', compact('itemTest', 'items', 'labs', 'factories', 'standards'));
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
        $labName = Lab::where('id', '=', $request->LabName)->get();

        foreach($request->tests as $testKey => $testValue)
        {
            // Find Test Desc
            $testDesc = Standard::where('stdname', $testValue)->get();

            $test = ItemsTestRecord::findOrFail($id);
            $test->ItemID = $request->ItemID;
            $test->TestLab = $request->LabName;
            $test->Active = -1;
            $test->Desc1 = $request->Desc1;
            $test->LabName = $labName[0]->labname;
            $test->StdName = $testValue;
            $test->StdDesc = $testDesc[0]->stddesc;
            $test->TestDate = $request->TestDate;
            $test->TestReptPdf = $request->TestReptPdf;
            $test->ReptNo = $request->ReptNo;
            $test->SubstrateLvl = $request->SubstrateLvl;
            $test->SurfaceLvl = $request->SurfaceLvl;
            $test->factId = $request->factname;
            $test->poNumber = $request->poNumber;
            $test->save();
        }

        return redirect()->route('items-test-records.index')->with('message', 'Item Test Record updated successfully!');
    }

    /**
     * Archived Item Tests
     *
     * @return \Illuminate\Http\Response
     */
    public function archive()
    {
        $itemsTest = ItemsTestRecord::whereYear('TestDate', '<', date('2016'))->get();

        return view('itemstestrecords.archive', compact('itemsTest'));
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
        $years = [1 => 'All'];

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
