<?php

namespace App\Http\Controllers;

use App\Models\Standard;
use Illuminate\Http\Request;
use Validator;

class StandardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $standards = Standard::all();

        return view('standards.index', compact('standards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('standards.manage');
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
            'stdname' => 'required',
            'stddesc' => 'required',
            'sortsequence' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $standard = Standard::create($request->all());

        return redirect()->route('standards.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Standard  $standard
     * @return \Illuminate\Http\Response
     */
    public function edit($wdt_ID)
    {
        $standard = Standard::where('wdt_ID', '=', $wdt_ID)->firstOrFail();

        return view('standards.manage', compact('standard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Standard  $standard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $wdt_ID)
    {
        $validator = Validator::make($request->all(), [
            'stdname' => 'required',
            'stddesc' => 'required',
            'sortsequence' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $standard = Standard::where('wdt_ID', '=', $wdt_ID)
                            ->firstOrFail()
                            ->update($request->all());

        return redirect()->route('standards.index');
    }

    /**
     *  Delete Standard
     *
     * @param  Request $request
     * @param  $wdt_ID
     * @return Response
     */
    public function destroy(Request $request, $wdt_ID)
    {
        $deleteStandard = Standard::destroy($wdt_ID);

        return redirect()->back()->with('message', 'Standard deleted successfully!');
    }
}
