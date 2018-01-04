<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Teacher;
use App\User;
use App\Subject;

class AdminTeacherController extends Controller
{
    public function index()
	{
		$teachers = User::where('role_id', '=', '3')->orderBy('name', 'asc')->paginate(10);

		return view('admin.teachers.index', compact('teachers'));
	}

	public function show($id)
	{
		$teachers = Teacher::where('user_id', '=', $id)->with(['user','subject'])->get();
		$teacher = User::where('id', '=', $id)->first();

		$enrolledSubjects = Teacher::select('subject_id')->where('user_id', '=', $id)->get();
		$subjectList = Subject::whereNotIn('id', $enrolledSubjects)->get();

		return view('admin.teachers.show', compact('teachers', 'teacher', 'subjectList', 'id'));
	}

	public function create($id)
	{
		// $subjects = Teacher::select('subject_id')->where('user_id', '=', $id)->get();
		$subjects = Teacher::select('subject_id')->get();
		return view('admin.teachers.create', compact('subjects', 'id'));
	}

	public function store(Request $request)
	{
		
		// $validator = Validator::make($data = Input::all(), Subject::$rules);
		// if ($validator->fails())
		// {
		// 	return Redirect::back()->withErrors($validator)->withInput();
		// }

		$teacher = new Teacher;

        $teacher->user_id = $request->user_id;
        $teacher->subject_id = $request->subject_id;

        $teacher->save();

        return Redirect::route('admin.teachers.show', ['teacher' => $request->user_id]); 
	} 

	public function destroy($id)
	{
		$teacher = Teacher::findOrFail($id);

		$teacherId = Teacher::where('id', '=', $id)->first();

		$teacher->delete();

		return Redirect::route('admin.teachers.show', ['teacher' => $teacherId->user_id]); 
	}
}
