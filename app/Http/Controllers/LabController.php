<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use Illuminate\Http\Request;
use Validator;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labs = Lab::all();

        return view('labs.index', compact('labs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('labs.manage');
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
            'labname' => 'required',
            'labaddr1' => 'required',
            'labaddr2' => 'required',
            'labcity' => 'required',
            'labdistrict' => 'required',
            'labstate' => 'required',
            'labcountry' => 'required',
            'labpostalcode' => 'required',
            'labphone' => 'required',
            'labfax' => 'required',
            'labemail' => 'required',
            'labwebsite' => 'required'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $lab = Lab::create($request->all());

        return redirect()->route('labs.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function edit($wdt_ID)
    {
        $lab = Lab::where('wdt_ID', '=', $wdt_ID)->firstOrFail();

        return view('labs.manage', compact('lab'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $wdt_ID)
    {
        $validator = Validator::make($request->all(), [
            'labname' => 'required',
            'labaddr1' => 'required',
            'labaddr2' => 'required',
            'labcity' => 'required',
            'labdistrict' => 'required',
            'labstate' => 'required',
            'labcountry' => 'required',
            'labpostalcode' => 'required',
            'labphone' => 'required',
            'labfax' => 'required',
            'labemail' => 'required',
            'labwebsite' => 'required'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $updateLab = Lab::where('wdt_ID', '=', $wdt_ID)
                    ->firstOrFail()
                    ->update($request->all());

        return redirect()->route('labs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function destroy($wdt_ID)
    {
        $lab = Lab::destroy($wdt_ID);

        return redirect()->route('labs.index')->with('message', 'Lab deleted successfully!');
    }
}
