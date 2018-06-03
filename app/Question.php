<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'question';
    protected $primaryKey = 'question_id';
    

    public function getUser(){
        return $this->belongsTo('App\User');
    }
    public function tags(){
        return $this->belongsToMany("App\Tag",'tag_questions','question_id','tag_id');
    }

    public function getTags($id_q){
        return Question::join('tag_questions','tag_questions.question_id','=','question.question_id')
        ->join('tags','tags.tag_id','=','tag_questions.tag_id')
        ->where('question.question_id',$id_q)->get();
    }
}
