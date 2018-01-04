<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\User;

class LoginController extends Controller
{
    public function getLogin(){
        return View('auth.login');
    }

    public function postLogin(){
        $data = Input::all();
        $validator = Validator::make($data, User::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))){
            // dd(Auth::user()->role_id);
            if (Auth::user()->role_id == '1') {
                return Redirect::intended('admin');
            } else if (Auth::user()->role_id == '2') {
                return Redirect::intended('student/grades');
            } else if (Auth::user()->role_id == '3') {
                return Redirect::intended('teacher/subjects');
            }
        
        } else {
            return Redirect::back()->withErrors('These credentials do not match our records.')->withInput();
        }
        
        return Redirect::route('login');
    }

    public function getLogout(){
        Auth::logout();
        return Redirect::route('login');
    }
}
