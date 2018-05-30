<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use Illuminate\Http\Request;

class FactoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factories = Factory::all();

        return view('factories.index', compact('factories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('factories.manage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $factory = Factory::create($request->all());

        return redirect()->route('factories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Factory  $factory
     * @return \Illuminate\Http\Response
     */
    public function show($wdt_ID)
    {
        $factory = Factory::where('wdt_ID', '=', $wdt_ID)->firstOrFail();

        return view('factories.show', compact('factory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Factory  $factory
     * @return \Illuminate\Http\Response
     */
    public function edit($wdt_ID)
    {
        $factory = Factory::where('wdt_ID', '=', $wdt_ID)->firstOrFail();

        return view('factories.manage', compact('factory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Factory  $factory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $wdt_ID)
    {
        $updateFactory = Factory::where('wdt_ID', '=', $wdt_ID)
                            ->firstOrFail()
                            ->update($request->all());

        $factory = Factory::findOrFail($wdt_ID);



        return redirect()->route('factories.show', compact('factory'));
    }
}
