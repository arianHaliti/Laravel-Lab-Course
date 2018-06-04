<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    //
    public function userEdit($id)
    {
        $user = User::find($id);
        if(auth()->user()->user_p !== 1){
            return redirect('/questions');
        }

        return view('admin.admin-user.edit')->with('user',$user);
    }


    

    public function userUpdate(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, [
            
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            
            'name' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255'.$user->id,
            'surname' => 'required|string|regex:/^[a-zA-Z]+$/u|max:255'.$user->id
        ]);

        //KRIJIMI I PYTJES

        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->save();

        //MERR ID E PYTJES TE KRIJUAR
        $last_id = $user->id;
        
        return redirect('/admin/user')->with('success','User Updated');
    }


    public function deactivateUser(Request $request){

        $user=User::find($request->id);
        if(count($user) > 0){
            if($user->user_active == 0){
                $user->user_active=1;

                $user->save();

                $response = array(
                    'status'=>'Deactivated',
                );
                return response()->json($response);
            }
            else{
                $user->user_active=0;

                $user->save();

                $response = array(
                    'status'=>'Activated',
                );
                return response()->json($response);
            }
        }
      return null;
    }
}
