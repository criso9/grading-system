<?php

namespace App\Http\Controllers\Student;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Student;

class StudentController extends Controller
{
    public function index()
	{
		
		$grades = Student::where('user_id', '=', Auth::user()->id)->with(['user', 'subject'])->get();
		
		return view('student.index', compact('grades'));
	}
}
