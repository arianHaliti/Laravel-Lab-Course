<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Followers;

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
    public function searchUsers(Request $request){ 
        
        //$q = $request->query
        $user = User::where('users.username','like',$request->query_value.'%')->get();
        
        if(count($user)==0){
            $response = array(
                'status' => 'nothing'
            );
            return response()->json($response);

        }
        $users = [];
        foreach($user as $u){
            $us = [];
            $us.array_push($us,$u->id,$u->username);
            $users.array_push($users,$u->id,$u->username);
        }
        $response = array(
            'status' => 'success',
            'user' => $users,
        );
        return response()->json($response);
        

    }

    public function follow(Request $request){
        $f = Followers::where('follower_id','=',$request->follower_id)
                ->where('user_id','=',auth()->user()->id)       
        ->get()
        ->first();

        if(count($f) !=0){
            $f->delete();
            $response = array (
                'status' => 'removed',
            );
            return response()->json($response);
        }
        $new_f = new Followers;
        $new_f->user_id=auth()->user()->id;
        $new_f->follower_id = $request->follower_id;
        $new_f ->save();

        $response = array(
            'status' => 'success',
        );
        return response()->json($response);
           
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

    public function admin(){
        return view('admin.admin');
    }
    public function adminUser(){
        return view('admin.admin-user');
    }
    public function team(){
        return view('about.team');
    }

    public function adminQuestion(){
        return view('admin.admin-question');
    }

    public function adminAnswer(){
        return view('admin.admin-answers');
    }
    
    public function adminReport(){
        return view('admin.admin-report');
    }
}
