<?php

namespace App\Http\Controllers;

use App\Models\Standard;
use Illuminate\Http\Request;

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
        $standard = Standard::create($request->all());

        return redirect()->route('standards.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Standard  $standard
     * @return \Illuminate\Http\Response
     */
    public function show($wdt_ID)
    {
        $standard = Standard::where('wdt_ID', '=', $wdt_ID)->firstOrFail();

        return view('standards.show', compact('standard'));
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
        $standard = Standard::where('wdt_ID', '=', $wdt_ID)
                            ->firstOrFail()
                            ->update($request->all());

        return redirect()->route('standards.show', compact('standard'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Standard  $standard
     * @return \Illuminate\Http\Response
     */
    public function destroy($wdt_ID)
    {
        //
    }
}
