<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $primaryKey = 'answer_id';

    public function votes($id,$auth_id){
        return Vote::where('content_id','=',$id)
        ->where('content_type','=',1)
        ->where('user_id','=',$auth_id)
        ->get()
        ->first();
        
    }
    public function createdBy($id){
        return Answer::join('users','users.id','=','answers.user_id')
        ->where('answers.answer_id',$id)
        ->get(['users.username','users.image']);
    }
}
