<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vote;
use App\Notification;
use App\CorrectAnswer;
use App\Question;
use App\Answer;
class VoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=> ['showvote']]);
    }
    public function vote(Request $request){
        if($request->t<0 || $request->t>2)
            return null;
        //KQYR NESE KA VOTU NAJ HER
        $status =0;
        $v = Vote::where('content_id','=',$request->id)
            ->where('content_type','=',$request->t)
            ->where('user_id','=',auth()->user()->id)
            ->get()
            ->first();
        
        $count= count($v);
        
        
        //CREATE VOTE IF NEVER VOTED !
        if(count($v)==0){
            $new_v = new Vote;
            $new_v->vote_type = 1;
            $new_v->content_type=$request->t;
            $new_v->content_id=$request->id;
            $new_v->user_id = auth()->user()->id;

            $new_v ->save();
            $this->createNote($request->t,$request->id,$new_v->vote_id);
            $status =1;
        }
        //UPDATE VOTE FROM 1 TO 0 !
        else if ($v->vote_type==1){
            $vote = $v;
            $vote->vote_type =0;
            $vote->save();

            $status =0;
        }
        //UPDATE VOTE FROM -1 TO 0 !
        else{
            $vote =$v;
            $vote->vote_type=1;
            $vote->save();
            $status =1;
        }
        $count = Vote::where('content_id','=',$request->id)
            ->where('content_type','=',$request->t)->sum('vote_type');
    
        $response = array(
            'status' => $status,
            'sumVote'=> $count,
        );
        return response()->json($response); 
     }


     public function downvote(Request $request){
        if($request->t<0 || $request->t>2)
            return null;
        $status =0;
        //KQYR NESE KA VOTU NAJ HER
        $v = Vote::where('content_id','=',$request->id)
            ->where('content_type','=',$request->t)
            ->where('user_id','=',auth()->user()->id)
            ->get()
            ->first();
            
        $count= count($v);
        
        
        //CREATE VOTE IF NEVER VOTED !
        if(count($v)==0){
            $new_v = new Vote;
            $new_v->vote_type = -1;
            $new_v->content_type=$request->t;
            $new_v->content_id=$request->id;
            $new_v->user_id = auth()->user()->id;

            $new_v ->save();
            $status =-1;
            $this->createNote($request->t,$request->id);
            
        }
        //UPDATE VOTE FROM -1 TO 0 !
        else if ($v->vote_type==-1){
            $vote = $v;
            $vote->vote_type =0;
            $vote->save();
            $status =0;
        }
        //UPDATE VOTE FROM 1 TO -1 !
        else{
            $vote =$v;
            $vote->vote_type=-1;
            $vote->save();
            $status =-1;
        }
        $count = Vote::where('content_id','=',$request->id)
            ->where('content_type','=',$request->t)->sum('vote_type');
    
        $response = array(
            'status' => $status,
            'sumVote'=> $count,
        );
        return response()->json($response); 
     }

     public function showvote(Request $request){
        $count = Vote::where('content_id','=',$request->id)
        ->where('content_type','=',$request->t)->sum('vote_type');

        $response = array(
            'status' => 'success',
            'sumVote'=> $count,
        );
        return response()->json($response); 
     }
     public function correct(Request $request){
        $c = CorrectAnswer::where('answer_id','=',$request->id)
        ->get()
        ->first();
        
        $question = Question::find($request->q_id);
        if( auth()->user()->id != $question->user_id)
            return null;
        

        if(count($c) !=0){
            $c->delete();
            if($c->answer_id == $request->id){
                
                $response = array (
                    'status' => 'removed',
                );
                return response()->json($response);
            }
            
        }
        $new_c = new CorrectAnswer;
        $new_c->answer_id = $request->id;
        $new_c ->save();

        $response = array(
            'status' => 'success',
        );
        return response()->json($response);
     }

     private function createNote($type,$id,$v_id){
        if($type == 0){
            $user = Question::find($id);
            $user = $user->user_id;
        }else if ($type == 1){
            $user = Answer::find($id);
            $user =$user->user_id;
        }
        $note = new Notification;
        $note->user_id = $user;
        $note->note_type =1;
        $note->note_id = $v_id;
        $note->read=0;
        $note->save();
     } 
}
