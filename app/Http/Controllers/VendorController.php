<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use Validator;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::all();

        return view('vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendors.manage');
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
            'vendno' => 'required',
            'vendname' => 'required',
            'vendtype' => 'required',
            'addr1' => 'required',
            'add2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcd' => 'required',
            'phoneno' => 'required',
            'apcustno' => 'required',
            'ssmatimestamp' => 'required'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $vendor = Vendor::create($request->all());

        return redirect()->route('vendors.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($wdt_ID)
    {
        $vendor = Vendor::where('wdt_ID', '=', $wdt_ID)->firstOrFail();

        return view('vendors.manage', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $wdt_ID)
    {
        $validator = Validator::make($request->all(), [
            'cono' => 'required',
            'vendno' => 'required',
            'vendname' => 'required',
            'vendtype' => 'required',
            'addr1' => 'required',
            'add2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcd' => 'required',
            'phoneno' => 'required',
            'apcustno' => 'required',
            'ssmatimestamp' => 'required'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $vendor = Vendor::where('wdt_ID', '=', $wdt_ID)
                        ->firstOrFail()
                        ->update($request->all());

        return redirect()->route('vendors.index');
    }

    /**
     *  Delete Vendor
     *
     * @param  Request $request
     * @param  $wdt_ID
     * @return Response
     */
    public function destroy(Request $request, $wdt_ID)
    {
        $deleteVendor = Vendor::destroy($wdt_ID);

        return redirect()->back()->with('message', 'Vendor deleted successfully!');
    }
}
