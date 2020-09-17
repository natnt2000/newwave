<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::group(['namespace' => 'FrontEnd'], function () {
    Route::get('/profile', 'StudentController@profile')->name('student.profile');
    Route::match(['PUT', 'PATCH'], '/profile', 'StudentController@update_profile')->name('student.update_profile');
    Route::get('/change_password', 'StudentController@change_password')->name('student.change_password');
    Route::match(['PUT', 'PATCH'], '/save_new_password', 'StudentController@save_new_password')->name('student.save_new_password');
    Route::get('/subject_list', 'StudentController@subject_list')->name('student.subject_list');
    Route::get('/getSubjectsNotLearned', 'StudentController@getSubjectsNotLearned');
    Route::post('/storeNewSubjects', 'StudentController@storeNewSubjects')->name('student.storeNewSubjects');
    Route::get('lang/{locale}', 'StudentController@lang');
});

Route::group(['namespace' => 'BackEnd', 'prefix' => 'admin', 'middleware' => 'admin'], function () {

    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::resource('faculties', 'FacultyController')->except(['show']);
    Route::resource('subjects', 'SubjectController')->except(['show']);
    Route::resource('students', 'StudentController')->except(['show']);

    Route::get('/students/getInfo/{student}', 'StudentController@getInfo')->name('students.getInfo');
    Route::match(['PUT', 'PATCH'], '/students/updateInfo/{student}', 'StudentController@updateStudentInfo')->name('students.info.update');

    Route::get('/students/{student}/subjectList', 'StudentController@subjectList')->name('students.subjectList');
    Route::get('/students/{student}/addNewSubject', 'StudentController@addNewSubject')->name('students.addNewSubject');
    Route::post('/students/{student}/storeScore', 'StudentController@storeScore')->name('students.storeScore');

    Route::match(['PUT', 'PATCH'], '/students/updateScore/{student}', 'StudentController@updateScore')->name('students.updateScore');
    Route::delete('/students/{student_id}/removeSubject/{subject_id}', 'StudentController@removeSubject')->name('students.removeSubject');

    Route::get('/students/send_mail', 'StudentController@send_mail')->name('students.send_mail');
});

Auth::routes();

Route::get('/login/google', 'Auth\LoginController@redirectToProvider');
Route::get('/login/google/callback', 'Auth\LoginController@handleProviderCallback');
