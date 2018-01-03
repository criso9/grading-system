<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Student extends Model
{

	protected $table = 'students';
	public $timestamps = true;

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function subject(){
    	return $this->belongsTo('App\Subject');
    }

     public function grade()
    {
        return $this->hasMany('App\Grade');
    }

    public static $rules = [
        'quiz' => 'required',
        'unit_test' => 'required',
        'term_test' => 'required',
        'laboratory' => 'required',
        'final_grade' => 'required',
    ];

    protected $fillable = ['quiz', 'unit_test', 'term_test', 'laboratory', 'final_grade'];
}
