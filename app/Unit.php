<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    protected $table = 'unit';

    public function jabatan()
    {
    	return $this->hasMany('\App\Jabatan');
    }
}
