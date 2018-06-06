<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use Illuminate\Http\Request;
use Validator;

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
        $validator = Validator::make($request->all(), [
            'factno' => 'required',
            'vendorno' => 'required',
            'factname' => 'required',
            'factaddr1' => 'required',
            'factaddr2' => 'required',
            'factcity' => 'required',
            'factdistrict' => 'required',
            'factstate' => 'required',
            'factcountry' => 'required',
            'factpostalcd' => 'required',
            'factphone' => 'required',
            'factfax' => 'required',
            'factemail' => 'required',
            'factwebsite' => 'required',
            'ssmatimestamp' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
        $validator = Validator::make($request->all(), [
            'factno' => 'required',
            'vendorno' => 'required',
            'factname' => 'required',
            'factaddr1' => 'required',
            'factaddr2' => 'required',
            'factcity' => 'required',
            'factdistrict' => 'required',
            'factstate' => 'required',
            'factcountry' => 'required',
            'factpostalcd' => 'required',
            'factphone' => 'required',
            'factfax' => 'required',
            'factemail' => 'required',
            'factwebsite' => 'required',
            'ssmatimestamp' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $updateFactory = Factory::where('wdt_ID', '=', $wdt_ID)
                            ->firstOrFail()
                            ->update($request->all());

        $factory = Factory::findOrFail($wdt_ID);

        return redirect()->route('factories.show', compact('factory'));
    }

    /**
     *  Delete Factory
     *
     * @param  Request $request
     * @param  $wdt_ID
     * @return Response
     */
    public function destroy(Request $request, $wdt_ID)
    {
        $deleteFactory = Factory::destroy($wdt_ID);

        return redirect()->back()->with('message', 'Factory deleted successfully!');
    }
}
