<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    //
    protected $table = 'jabatan';

    public function unit()
    {
    	return $this->belongsTo('\App\Unit', 'unit_id', 'id');
    }
}
