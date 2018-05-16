<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    
    protected $primaryKey = 'tag_id';
    public $timestamps = false;  
    
            public function questions(){
        return $this->belongsToMany("App\Question",'tag_questions','tag_id','question_id');
    }
}
