<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Followers;
use App\Notification;

class PagesController extends Controller
{  

    public function fullPost(){
        return view('pages.full-post');
    }
    public function course(){
        return view('pages.course');
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
    public function about(){
        return view('pages.about');
    }

    public function notification(Request $request){
        
        $notes = Notification::where('user_id',auth()->user()->id)
        ->update(['read'=>1]);

        $response = array (
            'status' => 'read',
        );
        return response()->json($response);
    }
}
