<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factory extends Model
{
    protected $table = 'vwfactories';

    public $timestamps = false;

    protected $fillable = [
    	'factno', 'vendorno', 'factname', 'factaddr1', 'factaddr2', 'factcity', 'factdistrict', 'factstate', 'factcountry', 'factpostalcd', 'factphone', 'factfax', 'factemail', 'factwebsite', 'ssmatimestamp'
    ];


    public function vendor()
    {
    	return $this->hasMany('App\Models\Vendor', 'vendorno');
    }
}
