<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();

        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.manage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cono' => 'required',
            'whse' => 'required',
            'itemid' => 'required',
            'desc1' => 'required',
            'desc2' => 'required',
            'prodcat' => 'required',
            'catalogyear' => 'required',
            'factoryno' => 'required',
            'ssmatimestamp' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $item = Item::create($request->all());

        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($wdt_ID)
    {
        $item = item::where('wdt_ID', '=', $wdt_ID)->firstOrFail();

        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($wdt_ID)
    {
        $item = Item::where('wdt_ID', '=', $wdt_ID)->firstOrFail();

        return view('items.manage', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $validator = Validator::make($request->all(), [
            'cono' => 'required',
            'whse' => 'required',
            'itemid' => 'required',
            'desc1' => 'required',
            'desc2' => 'required',
            'prodcat' => 'required',
            'catalogyear' => 'required',
            'factoryno' => 'required',
            'ssmatimestamp' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $item = Item::where('wdt_ID', '=', $item->wdt_ID)
                    ->firstOrFail()
                    ->update($request->all());

        return redirect()->route('items.show', compact('item'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $wdt_ID)
    {
        $item = Item::destroy($wdt_ID);

        return redirect()->route('items.index')->with('message', 'Item deleted successfully!');
    }
}
