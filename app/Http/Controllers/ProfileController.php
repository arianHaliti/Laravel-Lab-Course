<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Followers;

class ProfileController extends Controller
{
    public function follow(Request $request){
        if(auth()->user()->id ==null)
            abort(404);
        if(auth()->user()->id == $request->follower_id)
            return null;
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

    public function profile ($id) {
        
        $user = User::find($id);
        if($user->user_active!=0 || count($user)==0)
            abort(404);
        return view('pages.profile')->with('user',$user);
    }

    public function searchUsers(Request $request){ 
        
        //$q = $request->query
        $user = User::where('users.username','like',$request->query_value.'%')->limit(4)->get();
        
        if(count($user)==0){
            $response = array(
                'status' => 'nothing'
            );
            return response()->json($response);

        }
        $users = [];

        foreach($user as $u){
            $us = [];

            $us = array("id"=> $u->id,"username"=> $u->username);

            array_push($users,$us);

        }
        
        $response = array(
            'status' => 'success',
            'user' => $users,
        );
        return response()->json($response);
        

    }
}
