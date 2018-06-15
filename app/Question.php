<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DB;
use App\Vote;
class Question extends Model
{
    protected $table = 'question';
    protected $primaryKey = 'question_id';
    

    public function getUser(){
        return $this->belongsTo('App\User');
    }
    public function createdBy($q_id){
        return Question::join('users','users.id','=','question.user_id')
        ->where('question.question_id',$q_id)
        ->get(['users.username','users.image']);
    }
    public function tags(){
        return $this->belongsToMany("App\Tag",'tag_questions','question_id','tag_id');
    }

    public function getTags($id_q){
        return Question::join('tag_questions','tag_questions.question_id','=','question.question_id')
        ->join('tags','tags.tag_id','=','tag_questions.tag_id')
        ->where('question.question_id',$id_q)->get();
    }
    public static function getByCategory($cat){
        return
        Question::where('question_active',0)
        ->join('question_categories','question_categories.question_id','=','question.question_id')->join('categories','categories.category_id','=','question_categories.category_id')
        ->where('categories.category_name','=',$cat)
        ->select('question.*','categories.category_name');
    }
    //SIMPLE SORT
    public static function latestSort(){
        return
        Question::where('question_active',0)->orderBy('question.created_at','desc');
        
    }

    public static function viewSort(){
        return
        Question::where('question_active',0)->orderBy('question_views','desc');
    }

    public static function voteSort(){
       return
        DB::table('question')
            ->leftjoin('votes', 'votes.content_id', '=', 'question.question_id')
            ->select('question.*', DB::raw('SUM(CASE WHEN votes.content_type = 0 THEN  votes.vote_type ELSE 0 END) as total_votes'))
            ->where('question.question_active',0)
            ->groupBy('question.question_id')
            ->orderBy('total_votes','desc');
    }

    public static function unansweredSort(){
        return
        DB::table('question')
        ->select('question.*',
            DB::raw(" ( SELECT count(*) from answers a 
            inner join question q on a.question_id = q.question_id
            where a.answer_active=0 and q.question_id=question.question_id ) as c"))
        ->leftjoin('answers','answers.question_id','=','question.question_id')  
        ->where('question.question_active',0)
        ->groupBy('question.question_id')
        ->having('c','=',0);
    }

    //SORT WITH TAGS 
    public static function voteSortTag($query,$tag){
        return 
        $query->join('tag_questions', 'question.question_id', '=', 'tag_questions.question_id')
        ->join('tags','tags.tag_id','=','tag_questions.tag_id')
        ->where('tag_name','like',$tag);
    }
    public static function unansweredSortTag($query,$tag){
        return
        $query->join('tag_questions', 'question.question_id', '=', 'tag_questions.question_id')
        ->join('tags','tags.tag_id','=','tag_questions.tag_id')
        ->where('tag_name','like',$tag);
    }
    public static function viewSortTag($tag){
        return
        Question::whereHas('tags',function($q) use($tag){
            $q->where('tag_name','like',$tag);
        })->where('question_active',0)->orderBy('question_views','desc');
    }
    public static function latestSortTag($tag){
        return
        Question::whereHas('tags',function($q) use($tag){
            $q->where('tag_name','like',$tag);
        })->where('question_active',0)->orderBy('question.created_at','desc');
    }
    //CATEGORY TAG SORT Takes a query and a category
    public static function getByCategoryTag($query, $cat){
        return
        $query
        ->join('question_categories','question_categories.question_id','=','question.question_id')->join('categories','categories.category_id','=','question_categories.category_id')
        ->where('categories.category_name','=',$cat)
        ->addSelect('categories.category_name');
    }
    public function getPoints($id){
       return Vote::where('content_id','=',$id)
        ->where('content_type','=',0)->sum('vote_type');
    }

}
