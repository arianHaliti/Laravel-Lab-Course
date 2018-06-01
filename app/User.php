<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use App\Question;
use App\Answer;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','surname','username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getQuestions(){
        return $this->hasMany("App\Question");
    } 
    public function votes($id){
        return Question::where('question.question_active','=',0)
        ->join('votes','votes.content_id','=','question.question_id')
        ->where('question.user_id','=',$id)
        ->where('votes.content_type','=',0)
        ->get([
            DB::raw('IFNULL(SUM(votes.vote_type),0) AS summ')
        ]);
    }
    public function answerVotes($id){
        return Answer::where('answers.answer_active','=',0)
            ->join('votes','votes.content_id','=','answers.answer_id')
            ->where('answers.user_id','=',$id)
            ->where('votes.content_type','=',1)
            ->get([
                DB::raw('IFNULL(SUM(votes.vote_type),0) AS summ')
            ]);
    }
}

