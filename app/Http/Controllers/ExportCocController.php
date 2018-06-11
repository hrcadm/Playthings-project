<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Factory;
use App\Models\Vendor;
use App\Models\Lab;
use Illuminate\Http\Request;
use App\Models\ItemsTestRecord;
use Barryvdh\DomPDF\Facade as PDF;

class ExportCocController extends Controller
{
    public function exportCocView()
    {
    	$items = Item::pluck('itemid');
        $items = $items->toArray();

        $items = array_combine($items, $items);

        if(\Auth::check())
        {
            return view('export-views.coc.select', compact('items'));
        }
    	return view('export-views.coc.guestSelect', compact('items'));
    }

    /**
     *  Handles Coc exports logic
     * @param  Request $request
     * @return download
     */
    public function exportCoc(Request $request)
    {
    	$itemId = $request->item;
    	$type = $request->type;

		return $this->exportCocToPdf($itemId);
    }

    /**
     *  EXPORT COC TO PDF
     * @param $itemId
     * @return PDF document
     */
    public function exportCocToPdf($itemId)
    {
        $itemTests = ItemsTestRecord::where('ItemID', $itemId)->get()->groupBy('TestLab');

        $testsToArray = $itemTests->toArray();

        $tests = [$testsToArray];

        $lab = [];

        $testData = [];


        foreach($tests as $key => $value)
        {
            foreach($value as $k => $v)
            {
                $lab = Lab::where('id', '=', $k)->get();

                $tests[$key][$k]['Lab'] = $lab;
            }
        }

        foreach($lab as $key => $value)
        {
            foreach($tests as $k => $v)
            {
                foreach($v as $tkey => $tvalue)
                {
                    $testData['TestLab'] = $tvalue[0]['TestLab'];
                    $testData['TestDate'] = $tvalue[0]['TestDate'];
                    $testData['ReptNo'] = $tvalue[0]['ReptNo'];

                    switch ($tvalue[0]['SubstrateLvl']) {
                        case 1:
                            $testData['SubstrateLvl'] = '<600 PPM';
                            break;
                        case 2:
                            $testData['SubstrateLvl'] = '<300 PPM';
                            break;
                        case 3:
                            $testData['SubstrateLvl'] = '<100 PPM';
                            break;

                        default:
                            $testData['SubstrateLvl'] = 'N/A';
                            break;
                    }

                    switch ($tvalue[0]['SurfaceLvl']) {
                        case 1:
                            $testData['SurfaceLvl'] = '<600 PPM';
                            break;
                        case 2:
                            $testData['SurfaceLvl'] = '<90 PPM';
                            break;

                        default:
                            $testData['SurfaceLvl'] = 'N/A';
                            break;
                    }
                }
            }
        }

        $item = Item::where('itemid', '=', $itemId)->first();

        if($itemTests->has('factId') == null)
        {
            $factory = null;
            $vendor = null;
        } else {
            $factory = Factory::where('factno', '=', $itemTests[0]->factId)->get();
            $vendor = Vendor::where('vendno', '=', $factory[0]->vendorno)->get();
        }


        $data = [
            'tests' => $tests,
            'item' => $item,
            'factory' => $factory,
            'vendor' => $vendor,
            'lab' => $lab,
            'testData' => $testData
        ];

        $pdf = PDF::loadView('export-views.coc.template', $data);

        return $pdf->download('CoC-'.$itemId.'.pdf');
    }
}