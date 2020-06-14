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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/questionnaires/create','QuestionnaireController@create');
Route::get('/questionnaires/search','QuestionnaireController@search');
Route::post('/questionnaires','QuestionnaireController@store');
Route::get('/questionnaires/{questionnaire}','QuestionnaireController@show');
Route::delete('/questionnaires/{questionnaire}/{question}','QuestionnaireController@destroy');

Route::post('/questionnaires/{questionnaire}/questions/{question}/edit','QuestionController@edit');
Route::get('/questionnaires/{questionnaire}/questions/create','QuestionController@create');
Route::patch('/questionnaires/{questionnaire}/questions/{question}','QuestionController@update');
Route::delete('/questionnaires/{questionnaire}/questions/{question}','QuestionController@destroy');
Route::post('/questionnaires/{questionnaire}/questions','QuestionController@store');

Route::get('/surveys/{questionnaire}','SurveyController@show');
Route::post('/surveys/{questionnaire}-{slug}','SurveyController@store');