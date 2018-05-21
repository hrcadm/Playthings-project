<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $table = 'vwlabs';

    public $timestamps = false;

    protected $fillable = [
    	'labname', 'labaddr1', 'labaddr2', 'labcity', 'labdistrict', 'labstate', 'labcountry', 'labpostalcode', 'labphone', 'labfax', 'labemail', 'labwebsite'
    ];
}
