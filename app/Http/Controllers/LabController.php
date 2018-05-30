<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use Illuminate\Http\Request;

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
        $lab = Lab::where('wdt_ID', '=', $wdt_ID)
                    ->firstOrFail()
                    ->update($request->all());

        return redirect()->route('labs.show', compact('lab'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function destroy($wdt_ID)
    {
        $lab = Lab::where('wdt_ID', '=', $wdt_ID)->firstOrFail();
        $lab->delete();

        return redirect()->route('labs.index');
    }
}
