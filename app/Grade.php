<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Grade extends Model
{
    public function student(){
    	return $this->belongsTo('App\Student');
    }

    public static $rules = [
    	'student_id' => 'required',
        // 'quiz' => 'required',
        // 't_quiz' => 'required',
        // 'unit_test' => 'required',
        // 't_unit_test' => 'required',
        // 'term_test' => 'required',
        // 't_term_test' => 'required',
        // 'laboratory' => 'required',
        // 't_laboratory' => 'required',
    ];

    protected $fillable = ['student_id', 'quiz', 't_quiz', 'unit_test', 't_unit_test', 'term_test', 't_term_test', 'laboratory', 't_laboratory'];

}
