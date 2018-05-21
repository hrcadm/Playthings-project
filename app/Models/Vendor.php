<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vwvendors';

    public $timestamps = false;

    protected $fillable = [
    	'cono', 'vendno', 'vendname', 'vendtype', 'addr1', 'addr2', 'city', 'state', 'zipcd', 'phoneno', 'apcustno', 'ssmatimestamp'
    ];

    public function factory()
    {
    	return $this->hasMany('App\Models\Factory', 'factno');
    }
}
