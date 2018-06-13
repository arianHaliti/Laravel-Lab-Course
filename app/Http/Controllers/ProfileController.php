<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Auth;
use Storage;
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
    public function specificUsers (Request $request){
        $query=  $request->input;

        $users = User::where('users.username','like',$request->input.'%')->paginate(5);
        
        return view('pages.user')->with('users',$users);
    }
    public function index (){
        
        $users = User::where('user_active','=',0)->paginate(5);
        return view('pages.user')->with('users',$users);
    }


    public function edit($id)
    {
        $user = User::find($id);
        $profile = $user->hasProfile($user->id);
        if(auth()->user()->id !== $user->id){
            return redirect('/home');
        }

        return view('profile.edit')->with('profile',$profile);
    }
    public function update(Request $request,$id){
        $this->validate($request, [
            'username' => 'required|string|max:255|unique:users,username,'.Auth::user()->id,
            'name' => 'required|regex:/^[a-zA-Z]+$/u|max:255',
            'surname' => 'required|regex:/^[a-zA-Z]+$/u|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.Auth::user()->id,
            'image' => 'image|nullable|max:1999',
            'desc' => 'nullable|max:1000',
            'sex' => 'required'
        ]);
        
        
        $user = User::find($id);
        $profile = $user->hasProfile($user->id);
        
     


        if(count($profile)==0){
            //CHECK IF HE FILLED THE FORM
            if($request->hasFile('image') || $request->desc != "" || $request->sex !=""){
                
                //CREATE PROFILE
                $profile  = new Profile;
                $profile->user_id = Auth::user()->id;
                $profile->gender = $request->sex;
                $profile->user_desc = $request->desc;
                $profile->save();
            }
        }
        //EDIT PROFILE
        else{
            $profile= Profile::find($user->id);
            $profile->gender = $request->sex;
            $profile->user_desc = $request->desc;
            $profile->save();
        }

        if($request->hasFile('image')){
            
            //E MERR FILENAME ME EXTENSION
            $imageExt = $request->file('image')->getClientOriginalName();
            // E MERR EMRIN  E FILE
            $imageName = pathinfo($imageExt, PATHINFO_FILENAME);
            // E MERR VETEM EXTENSION TE FILE
            $extension = $request->file('image')->getClientOriginalExtension();
            // ADD TIME PER MU KAN UNIK EMRI I IMAGES
            $imageNameStore = $imageName.'_'.time().'.'.$extension;
            // UPLOAD IMAGE
            $path = $request->file('image')->storeAs('public/user_logos',$imageNameStore);
           
            
            if($user->image != 'user.png') {
                Storage::delete('public/user_logos/' . $user->image);
            }
            $user->image = $imageNameStore;

        }
        
        
        //KRIJIMI I PYTJES
        
        
        $user->username = $request->username;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->save();

        

        //MERR ID E PYTJES TE KRIJUAR
        
        
       
        return redirect('/profile/'.Auth::user()->id)->with('success','Profile Updated');  
    }
}
