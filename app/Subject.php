<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
	protected $table = 'subjects';
	public $timestamps = true;

    public function student()
    {
        return $this->hasMany('App\Student');
    }

    public function teacher()
    {
        return $this->hasMany('App\Teacher');
    }

    public function type(){
        return $this->belongsTo('App\Type');
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
