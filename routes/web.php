<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

// Registration
Route::get('/register', function () {
    return view('auth.register');
});

Route::get('login', array('as' => 'login', 'uses' => 'Auth\LoginController@getLogin'));
Route::post('login', array('as' => 'login.post','uses' => 'Auth\LoginController@postLogin'));
Route::post('logout', array('as' => 'logout', 'uses' => 'Auth\LoginController@getLogout'));
Route::post('/register', array('as' => 'register.post','uses' => 'Auth\RegisterController@store'));

// Admin panel
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    // enroll students to subjects
    Route::resource('students', 'Admin\AdminStudentController', ['as' => 'admin']);
    Route::get('/students/{student}/create', array('as' => 'admin.students.create','uses' => 'Admin\AdminStudentController@create'));

    // assign subjects to teachers
    Route::resource('teachers', 'Admin\AdminTeacherController', ['as' => 'admin']);
    Route::get('/teachers/{teacher}/create', array('as' => 'admin.teachers.create','uses' => 'Admin\AdminTeacherController@create'));
    // Route::delete('/teachers/{teacher}/{subject}', array('as' => 'admin.teachers.destroy','uses' => 'Admin\AdminTeacherController@destroy'));
});

// Teacher panel
Route::group(['prefix' => 'teacher', 'middleware' => 'teacher'], function () {
    // teacher panel
    Route::get('', array('as' => 'teacher.index','uses' => 'Teacher\TeacherController@panel'));

    Route::get('profile/{user}', array('as' => 'teacher.profile.show','uses' => 'Teacher\TeacherController@profile'));
    Route::get('profile/{user}/edit', array('as' => 'teacher.profile.edit','uses' => 'Teacher\TeacherController@editProfile'));
    Route::put('profile/{user}', array('as' => 'teacher.profile.update','uses' => 'Teacher\TeacherController@updateProfile'));

    // subjects
    Route::resource('subjects', 'Teacher\TeacherController', ['as' => 'teacher']);

    Route::get('subjects/{subject}/{student}/edit', array('as' => 'teacher.subjects.edit.grade','uses' => 'Teacher\TeacherController@editGrade'));

    Route::put('subjects/{subject}/{student}', array('as' => 'teacher.subjects.update.grade','uses' => 'Teacher\TeacherController@updateGrade'));

    Route::get('subjects/{subject}/{student}', array('as' => 'teacher.subjects.show.grade','uses' => 'Teacher\TeacherController@showGrade'));

    Route::get('subjects/{subject}/{student}/create', array('as' => 'teacher.subjects.create.grade','uses' => 'Teacher\TeacherController@createGrade'));

    Route::post('subjects/{subject}/{student}', array('as' => 'teacher.subjects.store.grade','uses' => 'Teacher\TeacherController@storeGrade'));

    Route::delete('subjects/{subject}/{student}', array('as' => 'teacher.subjects.destroy.grade','uses' => 'Teacher\TeacherController@destroyGrade'));

    Route::put('subjects/{subject}/{student}/compute', array('as' => 'teacher.subjects.compute','uses' => 'Teacher\TeacherController@compute'));

});

// Student panel
Route::group(['prefix' => 'student', 'middleware' => 'student'], function () {
    Route::resource('grades', 'Student\StudentController', ['as' => 'student']);

    Route::get('profile/{user}', array('as' => 'student.profile.show','uses' => 'Student\StudentController@profile'));
    Route::get('profile/{user}/edit', array('as' => 'student.profile.edit','uses' => 'Student\StudentController@editProfile'));
    Route::put('profile/{user}', array('as' => 'student.profile.update','uses' => 'Student\StudentController@updateProfile'));
});