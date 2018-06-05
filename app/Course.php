<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $primaryKey = 'course_id';
    
    public function lessons($id){
        return Course::join('lessons','lessons.course_id','=','courses.course_id')
                ->where('courses.course_id',$id)->get();
    }
    public function createdBy($id){
        return Course::join('users','users.id','=','courses.user_id')
        ->where('courses.course_id',$id)->get(['users.username'])->first();
    }
    public function firstLesson($id){
        return Course::join('lessons','lessons.course_id','=','courses.course_id')
        ->where('courses.course_id',$id)->get(['lessons.lesson_title','lessons.lesson_id'])->first();
    }
 
}
