<?php
use App\Http\Middleware\checkAdmin;
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
])->middleware('auth');

Route::post('/contact', [
    'uses' => 'contactMessageController@store',
    'as' => 'contact.store'
])->middleware('auth');

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

Route::get('/dashboard', 'HomeController@index');

Route::get('/', 'HomeController@home');

//Route For Profile
            
Route::get('/profile/{id}','ProfileController@profile');
Route::get('/profile/{id}/edit','ProfileController@edit');
Route::put('/profile/update/{id}','ProfileController@update')->middleware('auth');
Route::post('/follow','ProfileController@follow')->middleware('auth');
Route::post('/searchUsers','ProfileController@searchUsers');
Route::post('/specificUsers','ProfileController@specificUsers');

Route::get('/tag','TagQuestionController@tags');

Route::get('/full-post','PagesController@fullPost');

Route::get('/about','PagesController@about');
Route::get('/user','ProfileController@index');

Route::resource('questions','QuestionController', [
    'only' => ['index','update','edit','destroy','show', 'create', 'store']
]);
Route::get('questions/category/{name}','QuestionController@indexCat');
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
Route::get('questions/category/{name}/tag/{tag}','TagQuestionController@tagCategory');
Route::get('/tag/category/{name}','TagQuestionController@tagCat');

//ROUTES FOR VOTE
Route::post('/downvote','VoteController@downvote')->middleware('auth');
Route::post('/vote','VoteController@vote')->middleware('auth');
Route::post('/showvote','VoteController@showvote');

//ADMIN ROUTES
Route::get('/admin','PagesController@admin')->middleware(CheckAdmin::class);
Route::get('/admin/user','PagesController@adminuser')->middleware(CheckAdmin::class);;
Route::get('/admin/question','PagesController@adminquestion')->middleware(CheckAdmin::class);;
Route::get('/admin/answer','PagesController@adminanswer')->middleware(CheckAdmin::class);;
Route::get('/admin/report','PagesController@adminreport')->middleware(CheckAdmin::class);;
Route::get('/admin/user/{id}/edit','AdminController@userEdit')->middleware(CheckAdmin::class);;
Route::put('/admin/user/{id}','AdminController@userUpdate')->middleware(CheckAdmin::class);;
Route::post('/deactivate','AdminController@deactivateUser')->middleware(CheckAdmin::class);
//COURSE ROUTES
Route::get('/course/{id}/{name}','CourseController@show');
Route::get('/course/{id}/{name}/{l_id}','CourseController@showLesson');
// LESSON ROUTES
Route::get('courses/lesson/create/{id}','LessonController@create')->middleware('auth');
Route::post('courses/lesson/store','LessonController@store')->middleware('auth');
//ROUTE FOR CORRECT ANSWER
Route::post('/correct','VoteController@correct')->middleware('auth');
// ROUTE FOR NOTIFICATION
Route::post('/notification','PagesController@notification')->middleware('auth');

//ROUTE FOR TEAM
Route::get('/team','PagesController@team');

//ROUTE FOR ABOUT US
Route::get('/about','PagesController@about');

