<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Question;
use App\Answer;
use App\Course;
use \DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('home')->with('questions',$user->getQuestions->where('question_active',0));
    }
    public function home(){

        $user = User::find(auth()->user()->id);
/*
        $answers = Answer::join('followers','followers.follower_id','=','answers.user_id')
        ->where('followers.user_id',$user->id)
        ->get(['answers.question_id','answers.answer_desc','answers.created_at as ca']);

        $courses = Course::join('followers','followers.follower_id','=','courses.user_id')
        ->where('followers.user_id',$user->id)
        ->get(['courses.course_id','courses.course_title','courses.created_at as ca']);
*/
        /*$questions = Question::join('followers','question.user_id','=','followers.follower_id')
        ->where('followers.user_id',$user->id)
        ->orderBy('ca')
        ->get(['question.question_id','question.question_title','question.created_at as ca']);
        
        
        $courses = Course::join('followers','courses.user_id','=','followers.follower_id')
        ->where('followers.user_id',$user->id)
        ->orderBy('ca')
        ->get(['courses.course_id','courses.course_title','courses.created_at as ca']);
        
        */
       $data= (DB::select('
        SELECT q.user_id, q.question_id ,q.question_title, q.created_at as ca , 1 as type
        from Question q inner join followers f on q.user_id = f.follower_id
        where f.user_id ='.$user->id.'
        UNION
        SELECT a.user_id, a.answer_id ,a.answer_desc, a.created_at as ca , 2 as type
        from Answers a inner join followers f on a.user_id = f.follower_id
        where f.user_id ='.$user->id.'
        union 
        SELECT c.user_id,c.course_id,c.course_title, c.created_at as ca , 3 as type
        from Courses c inner join followers f on c.user_id = f.follower_id
        where f.user_id ='.$user->id.'
        
        order by ca desc')); 
        $answers = Answer::join('followers','answers.user_id','=','followers.follower_id')
        ->where('followers.user_id',$user->id)
        ->orderBy('ca')
        ->get(['answers.question_id','answers.answer_desc','answers.created_at as ca']);
      
        // $data = $questions->union($courses)->union($answers)
        // ->get('created_at as ca');
        //return ($data);
        return view('pages.home')->with('data',$data);
    }
}
