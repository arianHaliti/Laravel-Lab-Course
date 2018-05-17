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


Route::get('/', 'PagesController@index');

Route::get('/profile','PagesController@profile'); 


Route::get('/tag','PagesController@tag');
Route::get('/users/{id}/{name}', function ($id,$name) {
    return "this user id is :".$id." hes name is ".$name;
    
});
Route::get('/full-post','PagesController@fullPost');

Route::get('/about','PagesController@about');

Route::resource('questions','QuestionController');
Route::resource('courses','CourseController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::resource('answers','AnswerController');

Route::post('/answers/create','AnswerController@store');
Route::put('/answers/{id}','AnswerController@update');
Route::get('/answers/{id}/edit','AnswerController@edit');


// ROUTE FOR QUESTION TAGS 
// EX : questions/tag/javascript 
Route::get('questions/tag/{tag}','TagQuestionController@tag');