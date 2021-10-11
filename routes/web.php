<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\QuestionController;

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



Route::group(['middleware'=>'auth'],function(){
    Route::get('dashboard','App\Http\Controllers\Maincontroller@dashboard')->name('dashboard');
     Route::get('quiz/show/{slug}','App\Http\Controllers\Admin\QuizController@show')->name('quiz.show');
    Route::get('quiz/detay/{slug}','App\Http\Controllers\Maincontroller@quiz_detail')->name('quiz.detail');
    Route::get('quiz/{slug}','App\Http\Controllers\Maincontroller@quiz')->name('quiz.join');
    Route::post('quiz/{slug}/result','App\Http\Controllers\Maincontroller@result')->name('quiz.result');
});

Route::get('/admin/quizzes/delete/{id}','App\Http\Controllers\Admin\QuizController@destroy')->middleware('isAdmin')->middleware('auth')->name('quizzes.sil');
Route::get('/admin/questions/{quiz_id}/delete/{question_id}','App\Http\Controllers\Admin\QuestionController@destroy')->middleware('isAdmin')->middleware('auth')->name('questions.sil');


//middleware gruplama işlemi aşağıdaki gibi yapılır ve resource controller aşağıdaki gibidir
Route::group(['middleware'=>['auth','isAdmin'],'prefix'=>'admin'],function(){
    Route::resource('quizzes',QuizController::class);
     Route::resource('quiz/{quiz_id}/questions',QuestionController::class);
});
