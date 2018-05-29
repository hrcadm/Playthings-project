<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemsTestRecord extends Model
{
    protected $table = 'vwrptitemtestspassed';

    public $timestamps = false;

    protected $fillable = [
    	'ItemID', 'TestLab', 'Active', 'Desc1', 'LabName', 'StdName', 'StdDesc', 'TestDate', 'TestReptPdf', 'ReptNo', 'SubstrateLvl', 'SurfaceLvl'
    ];

    public function item()
    {
    	return $this->hasMany('App\Models\Item', 'itemid');
    }

    public function getTestDateAttribute($date)
	{
	    $newDate = date('Y-m-d', strtotime($date));

	    return $newDate;
	}
}
