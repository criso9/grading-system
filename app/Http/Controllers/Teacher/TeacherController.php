<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Subject;
use App\Teacher;
use App\Student;
use App\Grade;
use App\Conversion;
use App\User;

class TeacherController extends Controller
{
	public function panel()
	{
		return view('panel.teacher');
	}

	public function profile($id)
	{
		$subjId = Teacher::select('subject_id')->where('user_id', '=', Auth::user()->id);
		$subjects = Subject::whereIn('id', $subjId)->get();

		return view('auth.teacher.profile', compact('subjects'));
	}
	
	public function editProfile($id)
	{
		$subjId = Teacher::select('subject_id')->where('user_id', '=', Auth::user()->id);
		$subjects = Subject::whereIn('id', $subjId)->get();

		$user = User::where('id', '=', $id)->first();

		return view('auth.teacher.edit_profile', compact('subjects', 'user'));
	}

	public function updateProfile(Request $request, $id)
	{

		$user = User::findOrFail($id);
		$userInfo = User::where('id', '=', $id)->first();

		$validator = Validator::make($request = Input::all(), User::$profile_rules);
		
		if ($validator->fails())
			{
				return Redirect::back()->withErrors($validator)->withInput();
			}
	
		$user->role_id = $userInfo->role_id;
		$user->name = $request['name'];
		$user->email = $request['email'];

		// if($request['avatar'] == ''){
		// 	$user->avatar = $userInfo->avatar;
		// } else {
		// }
		$user->avatar = $userInfo->avatar;

		if($request['password'] == ''){
			$user->password = $userInfo->password;
		} else {
			$user->password = bcrypt($request['password']);
		}
        
        $user->update();
        // $user->update($request);

        return Redirect::route('teacher.profile.show', ['user' => $id]); 
	}

    public function index()
	{
		$subjId = Teacher::select('subject_id')->where('user_id', '=', Auth::user()->id);
		$subjects = Subject::whereIn('id', $subjId)->get();
		
		return view('teacher.index', compact('subjects'));
	}

	public function show($id)
	{
		//$subject = Student::select('user_id')->where('subject_id', '=', $id)->get();
		$students = Student::where('subject_id', '=', $id)->with(['user', 'subject'])->get();
		$subject = Subject::where('id', '=', $id)->first();

		$subjId = Teacher::select('subject_id')->where('user_id', '=', Auth::user()->id);
		$subjects_handled = Subject::whereIn('id', $subjId)->get();
		
		return view('teacher.show', compact('students', 'subject', 'subjects_handled'));
	}

	public function showGrade($subjId, $userId)
	{
		$student = Student::where('user_id', '=', $userId)->where('subject_id', '=', $subjId)->with(['user', 'subject'])->first();
		$subject = Subject::where('id', '=', $subjId)->with('type')->first();

		$stud_id = Student::select('id')->where('user_id', '=', $userId)->where('subject_id', '=', $subjId)->first();
		$grades = Grade::where('student_id', '=', $stud_id->id)->get();

		$subjId = Teacher::select('subject_id')->where('user_id', '=', Auth::user()->id);
		$subjects_handled = Subject::whereIn('id', $subjId)->get();

		return view('teacher.grades.show', compact('student', 'subject', 'grades', 'subjects_handled'));
	}

	public function createGrade($subjId, $userId)
	{
		$student = Student::where('user_id', '=', $userId)->where('subject_id', '=', $subjId)->first();
		$subject = Subject::where('id', '=', $subjId)->with(['type'])->first();

		$subjId = Teacher::select('subject_id')->where('user_id', '=', Auth::user()->id);
		$subjects_handled = Subject::whereIn('id', $subjId)->get();

		return view('teacher.grades.create', compact('student', 'subject', 'subjects_handled'));
	}

	public function storeGrade(Request $request, $subjId, $userId)
	{
		$validator = Validator::make($data = Input::all(), Grade::$rules);
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$grade = new Grade;

        $grade->student_id = $request->student_id;
        $grade->quiz = $request->quiz;
        $grade->t_quiz = $request->t_quiz;
        $grade->unit_test = $request->unit_test;
        $grade->t_unit_test = $request->t_unit_test;
        $grade->term_test = $request->term_test;
        $grade->t_term_test = $request->t_term_test;
        $grade->laboratory = $request->laboratory;
        $grade->t_laboratory = $request->t_laboratory;

        $grade->save();

		// Grade::create($request);
        return Redirect::route('teacher.subjects.show.grade', ['subject' => $subjId, 'student' => $userId]); 
	} 

	public function editGrade($subjId, $gradeId)
	{
		$subject = Subject::where('id', '=', $subjId)->with('type')->first();
		$grade = Grade::where('id', '=', $gradeId)->first();

		$student = Student::where('id', '=', $grade->student_id)->first();

		$subjId = Teacher::select('subject_id')->where('user_id', '=', Auth::user()->id);
		$subjects_handle = Subject::whereIn('id', $subjId)->get();

		return view('teacher.grades.edit', compact('subject', 'grade', 'student', 'subjects_handle'));
	}

	public function updateGrade(Request $request, $subjId, $gradeId)
	{

		$grade = Grade::findOrFail($gradeId);

		$validator = Validator::make($request = Input::all(), Grade::$rules);
		//$subject = Subject::where('id', '=', $subjId)->with('type')->first();

		if ($validator->fails())
			{
				return Redirect::back()->withErrors($validator)->withInput();
			}
	
		$grades = Grade::where('id', '=', $gradeId)->first();
		$student = Student::select('user_id')->where('id', '=', $grades->student_id)->first();	

        $grade->update($request);
        return Redirect::route('teacher.subjects.show.grade', ['subject' => $subjId, 'student' => $student->user_id]); 
	}

	public function destroyGrade($subjId, $gradeId)
	{
		$grade = Grade::findOrFail($gradeId);

		$grades = Grade::where('id', '=', $gradeId)->first();
		$student = Student::select('user_id')->where('id', '=', $grades->student_id)->first();

		$grade->delete();

		return Redirect::route('teacher.subjects.show.grade', ['subject' => $subjId, 'student' => $student->user_id]); 
	}

	public function compute(Request $request, $subjId, $studId)
	{
	try {
		$student = Student::findOrFail($studId);

		// $total = Grade::select('SUM(quiz) AS quiz', 'SUM(t_quiz) AS t_quiz', 'SUM(unit_test) AS unit_test', 'SUM(t_unit_test) AS t_unit_test', 'SUM(term_test) AS term_test', 'SUM(t_term_test) AS t_term_test', 'SUM(laboratory) AS laboratory', 'SUM(t_laboratory) AS t_laboratory')->where('student_id', '=', $studId)->first();

		$total = Grade::select(\DB::raw('SUM(quiz) AS quiz'), \DB::raw('SUM(t_quiz) AS t_quiz'), \DB::raw('SUM(unit_test) AS unit_test'), \DB::raw('SUM(t_unit_test) AS t_unit_test'), \DB::raw('SUM(term_test) AS term_test'), \DB::raw('SUM(t_term_test) AS t_term_test'), \DB::raw('SUM(laboratory) AS laboratory'), \DB::raw('SUM(t_laboratory) AS t_laboratory'))->where('student_id', '=', $studId)->first();

		$weight = Subject::where('id', '=', $subjId)->with('type')->first();

		if($weight->type->type == 'Lecture'){
			$p_quiz = number_format(($total->quiz / $total->t_quiz) * $weight->type->quiz, 2);
			$p_unit_test = number_format(($total->unit_test / $total->t_unit_test) * $weight->type->unit_test, 2);
			$p_term_test = number_format(($total->term_test / $total->t_term_test) * $weight->type->term_test, 2);

			$p_total = number_format($p_quiz + $p_unit_test + $p_term_test);
		}else if($weight->type->type == 'Laboratory'){
			$p_term_test = number_format(($total->term_test / $total->t_term_test) * $weight->type->term_test, 2);
			$p_laboratory = number_format(($total->laboratory / $total->t_laboratory) * $weight->type->laboratory, 2);

			$p_total = number_format($p_term_test + $p_laboratory);
		}else if($weight->type->type == 'Lecture/Laboratory'){
			$p_quiz = number_format(($total->quiz / $total->t_quiz) * $weight->type->quiz, 2);
			$p_unit_test = number_format(($total->unit_test / $total->t_unit_test) * $weight->type->unit_test, 2);
			$p_term_test = number_format(($total->term_test / $total->t_term_test) * $weight->type->term_test, 2);
			$p_laboratory = number_format(($total->laboratory / $total->t_laboratory) * $weight->type->laboratory, 2);

			$p_total = number_format($p_quiz + $p_unit_test + $p_term_test + $p_laboratory);
		}

		// $convert = Conversion::select('final_grade')->whereBetween("'74'", ['raw_grade_from', 'raw_grade_to'])->first();
		$convert = Conversion::select('final_grade')->where('raw_grade_from', '<=', $p_total)->where('raw_grade_to', '>=', $p_total)->first();

		// dd($convert->final_grade);

		if ($convert->final_grade == '5') {
			$remarks = 'Failed';
		} else {
			$remarks = 'Passed';
		}

		$student->final_grade = $convert->final_grade;
		$student->remarks = $remarks;
		$student->update();
	}
		catch (\Exception $e) {
		    return Redirect::back()->withErrors($e->getMessage());
		    //return redirect()->route('teacher.subjects.show.grade', ['subject' => $subjId, 'student' => $studId]);
	}

		return redirect()->route('teacher.subjects.show', ['subject' => $subjId]);
	}

	public function edit($id)
	{
		$subject = Subject::where('id', '=', $id)->with('type')->first();

		$subjId = Teacher::select('subject_id')->where('user_id', '=', Auth::user()->id);
		$subjects_handle = Subject::whereIn('id', $subjId)->get();

		return view('teacher.edit', compact('subject', 'subjects_handle'));
	}

	public function update(Request $request, $id)
	{
		$subject = Subject::findOrFail($id);
		// $validator = Validator::make($data = Input::all(), Subject::$rules);

		// if ($validator->fails())
		// 	{
		// 		return Redirect::back()->withErrors($validator)->withInput();
		// 	}
			
        $subject->quiz = $request->quiz;
        $subject->unit_test = $request->unit_test;
        $subject->term_test = $request->term_test;
        $subject->laboratory = $request->laboratory;

        $subject->update();
        return redirect()->route('teacher.index');
	}
}
