<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
