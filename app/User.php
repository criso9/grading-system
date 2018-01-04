<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public static $reg_rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/|confirmed',
    ];

    public static $v_reg_rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

    public static $profile_rules = [
        'name' => 'required',
        'email' => 'required|email',
    ];

    public function student()
    {
        return $this->hasOne('App\Student');
    }

    public function teacher()
    {
        return $this->hasOne('App\Teacher');
    }

    public function checkRoles()
    {
        if($this->role_id == 1)
        { 
            return "admin"; 
        }
        else if($this->role_id == 2)
        {
            return "student";
        }
        else if($this->role_id == 3)
        {
            return "teacher";
        }
        else 
        { 
            return false; 
        }
    }
}
