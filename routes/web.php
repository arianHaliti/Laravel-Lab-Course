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

Route::get('/contact', [
    'uses' => 'contactMessageController@create'
]);

Route::post('/contact', [
    'uses' => 'contactMessageController@store',
    'as' => 'contact.store'
]);

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

Route::get('/', 'PagesController@index');

Route::get('/profile','PagesController@profile'); 


Route::get('/tag','PagesController@tag');
Route::get('/users/{id}/{name}', function ($id,$name) {
    return "this user id is :".$id." hes name is ".$name;
    
});
Route::get('/full-post','PagesController@fullPost');

Route::get('/about','PagesController@about');
Route::get('/user','PagesController@user');

Route::resource('questions','QuestionController');
Route::resource('courses','CourseController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::resource('answers','AnswerController');

Route::post('/answers/create','AnswerController@store');
Route::put('/answers/{id}','AnswerController@update');
Route::get('/answers/{id}/edit','AnswerController@edit');
Route::delete('/answers/{id}','AnswerController@destroy')->middleware('auth');

// ROUTE FOR QUESTION TAGS 
// EX : questions/tag/javascript 
Route::get('questions/tag/{tag}','TagQuestionController@tag');

//ROUTES FOR VOTE
Route::post('/downvote','VoteController@downvote')->middleware('auth');
Route::post('/vote','VoteController@vote')->middleware('auth');
Route::post('/showvote','VoteController@showvote');


//ROUTE FOR CORRECT ANSWER
Route::post('/correct','VoteController@correct')->middleware('auth');
