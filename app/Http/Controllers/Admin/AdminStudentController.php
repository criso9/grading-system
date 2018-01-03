<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Student;
use App\User;
use App\Subject;

class AdminStudentController extends Controller
{
   	public function index()
	{
		$students = User::where('role_id', '=', '2')->orderBy('name', 'asc')->paginate(10);

		return view('admin.students.index', compact('students'));
	}

	public function show($id)
	{
		// $student = Student::findOrFail($id);
		// $categories = \App\Models\Category::with('articles')->get();
		//$students = Subject::with('student')->get();
		$students = Student::where('user_id', '=', $id)->with(['user','subject'])->get();
		$student = User::where('id', '=', $id)->first();

		$enrolledSubjects = Student::select('subject_id')->where('user_id', '=', $id)->get();
		$subjectList = Subject::whereNotIn('id', $enrolledSubjects)->get();
		
		return view('admin.students.show', compact('students', 'student', 'subjectList'));
	}

	public function create($id)
	{
		$subjects = Student::select('subject_id')->where('user_id', '=', $id)->get();
		return view('admin.students.create', compact('subjects', 'id'));
	}

	public function store(Request $request)
	{
		
		// $validator = Validator::make($data = Input::all(), Subject::$rules);
		// if ($validator->fails())
		// {
		// 	return Redirect::back()->withErrors($validator)->withInput();
		// }

		$student = new Student;

        $student->user_id = $request->user_id;
        $student->subject_id = $request->subject_id;

        $student->save();

        return Redirect::route('admin.students.show', ['student' => $request->user_id]); 
	} 

	// public function update(Request $request, $id)
	// {
	// 	$student = Student::findOrFail($id);
	// 	$validator = Validator::make($request = Input::all(), Subject::$rules);

	// 	if ($validator->fails())
	// 		{
	// 			return Redirect::back()->withErrors($validator)->withInput();
	// 		}

	// 		$student->update($request);
	// 		return redirect()->route('admin.students.index')->with('message', 'Item updated successfully.');
	// }
}
