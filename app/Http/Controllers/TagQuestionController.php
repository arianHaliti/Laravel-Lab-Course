<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Tag;
class TagQuestionController extends Controller
{
    public function tag($tag){
        $t = Tag::where('tag_name','=',$tag)->get();
        $questions = Question::whereHas('tags',function($q) use($tag){
            $q->where('tag_name','like',$tag);
        })->where('question_active',0)->orderBy('created_at')->paginate(10);
        
       
        //return count($tags);
       return view('pages.index')->with('questions',$questions);
    }
}
