<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
    public function profile ($id) {
        
        $user = User::find($id);
        if($user->user_active!=0 || count($user)==0)
            abort(404);
        return view('pages.profile')->with('user',$user);
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

    public function user(){
        return view('pages.user');
    }
}
