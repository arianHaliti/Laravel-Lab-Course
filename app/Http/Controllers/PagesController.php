<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{  
    public function index () {
        $title = "This is Laravel ! ";
        return view('pages.index')->with('title_h1',$title);
    }
    public function about () {
        $data = array (
            'title' => 'This is about Ous !',
            'more' => ['cake','milk','cookies','edit']
        );
        return view('pages.about')->with($data);
    }
    public function profile () {
        
        return view('pages.profile');
    }

    public function fullPost(){
        return view('pages.full-post');
    }
    public function course(){
        return view('pages.course');
    }

    public function tag(){
        return view('pages.tag');
    }
}
