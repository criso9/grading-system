<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Type extends Model
{
	protected $table = 'types';
	public $timestamps = true;

    public function subject()
    {
        return $this->hasOne('App\Subject');
    }
}
