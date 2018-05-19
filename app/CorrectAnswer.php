<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CorrectAnswer extends Model
{
    protected $primaryKey = 'correct_id';
    public $timestamps = false;
    public function answer(){
        return $this->belongsTo("App\Answer");
    }
}
