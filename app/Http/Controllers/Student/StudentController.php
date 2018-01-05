<?php

namespace App\Http\Controllers\Student;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Student;
use App\User;

class StudentController extends Controller
{

	public function panel()
	{
		return view('panel.student');
	}

	public function profile($id)
	{
		return view('auth.student.profile');
	}
	
	public function editProfile($id)
	{
		$user = User::where('id', '=', $id)->first();

		return view('auth.student.edit_profile', compact('user'));
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

        Session::flash('message', "Profile updated.");
        return Redirect::route('student.profile.show', ['user' => $id]); 
	}

    public function index()
	{
		$grades = Student::where('user_id', '=', Auth::user()->id)->with(['user', 'subject'])->get();
		
		return view('student.index', compact('grades'));
	}
}
