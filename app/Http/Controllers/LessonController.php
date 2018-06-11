<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use App\Course;
class LessonController extends Controller
{
    public function show($id)
    {
        return $id;
        if(!is_numeric($id))
            abort(404);

        $course =  Course::find($id);

        if(count($course)==0)
          abort(404);

        return view('courses.showC')->with('course',$course);

    }
    public function create($id){
        
        $course = Course::find($id);
        if(auth()->user()->id != $course->user_id)
            return view('pages.course');
        $c_id = $id;
        
        return view('lessons.create')->with('c_id',$c_id);
    }
    public function store(Request $request) {
        $this->validate($request, [
            'title' =>'required|max:255',
            'body' => 'required'
        ]);

        //KRIJIMI I PYTJES
        $check = Course::find($request->c_id);
            
        if($check->user_id != auth()->user()->id){
            abort(404);
        }
        $lesson = new Lesson;
        
        $lesson->lesson_title = $request->input('title');
        $lesson->course_id = $request->c_id;
        $lesson->lesson_desc = $request->input('body');
        $lesson->lesson_views = 0;
        $lesson->save();
       
        return redirect('/course/'.$check->course_id.'/'.$check->course_title.'/'.$lesson->lesson_id)->with('success','Answer Updated');

    }
}
