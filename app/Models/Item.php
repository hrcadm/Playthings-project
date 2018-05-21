<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'vwitems';

    public $timestamps = false;

    protected $fillable = [
    	'cono', 'whse', 'itemid', 'desc1', 'desc2', 'prodcat', 'catalogyear', 'factoryno', 'ssmatimestamp'
    ];

    public function itemstestpassed()
    {
    	return $this->hasMany('App\Models\ItemsTestPassed', 'ItemID');
    }
}
