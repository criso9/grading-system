<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Student;

class EmailController extends Controller
{

    public function send(Request $request, $studId){
    
    	$userId = Student::where('id', '=', $studId)->first();
		$student = User::where('id', '=', $userId->user_id)->first();

		$grades = Student::where('user_id', '=', $userId->user_id)->where('final_grade', '>', '0')->with(['user', 'subject'])->get();

        Mail::send('emails.send', ['student' => $student, 'grades' => $grades], function ($message) use ($student)
        {
            $message->from('gradingsystem.nm@gmail.com', 'Administrator');
            $message->to($student->email);

        });

        Session::flash('message', "Email Sent!");
        return Redirect::route('teacher.subjects.index');
	}


}
