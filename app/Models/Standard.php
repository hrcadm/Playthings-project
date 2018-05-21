<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    protected $table = 'vwstandards';

    public $timestamps = false;

    protected $fillable = [
    	'sortsequence', 'stdname', 'stddesc'
    ];
}
