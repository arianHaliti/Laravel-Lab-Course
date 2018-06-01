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
    
}
