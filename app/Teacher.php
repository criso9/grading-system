<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Teacher extends Model
{
    public $timestamps = true;

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function subject(){
    	return $this->belongsTo('App\Subject');
    }
}
