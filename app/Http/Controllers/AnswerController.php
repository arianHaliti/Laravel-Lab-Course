<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Notification;
use App\Question;
use DB; 
use Illuminate\Support\Facades\Input;
class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        //KRIJIMI I PERGJIGJES
        $ans = new Answer;


        $ans->answer_desc = $request->input('body');
        $ans->question_id = Input::get('q_id');
        $ans->answer_active = 0;
        $ans->user_id = auth()->user()->id;
        $ans->save();

        $note = new Notification;
        $user = Question::find(Input::get('q_id'));
        $note->user_id = $user->user_id;
        $note->note_type =0;
        $note->note_id = $ans->answer_id;
        $note->read=0;
        $note->save();


        $last_id = Input::get('q_id');
        
        return redirect('/questions/'.$last_id)->with('success','Answer created' );
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($question_id)
    {
        // $pp = answers for a page !
        $pp = 5;
        if(isset($_GET['sort'])){
            if($_GET['sort']=='votes'){
                $answers = Answer::leftjoin('correct_answers','correct_answers.answer_id', '=', 'answers.answer_id')
                ->leftjoin('votes','votes.content_id','=','answers.answer_id')
                ->select ('answers.*','answer_desc','correct_id', DB::raw('SUM(CASE WHEN votes.content_type = 1 THEN  votes.vote_type ELSE 0 END) as total_votes'))
                ->where('answer_active',0)
                ->groupBy('answers.answer_id')
                ->where('question_id',$question_id)
                ->orderBy('total_votes','desc')
                ->paginate($pp);
                $answers->appends(['sort' => 'votes'])->links();
            }else 
            {
                $answers = Answer::leftjoin('correct_answers','correct_answers.answer_id', '=', 'answers.answer_id')
                ->where('answer_active',0)
                ->select('answers.answer_id','answer_desc','user_id','correct_id')
                ->where('question_id',$question_id)
                ->paginate($pp);
            }
        }else{
            $answers = Answer::leftjoin('correct_answers','correct_answers.answer_id', '=', 'answers.answer_id')
            ->where('answer_active',0)
            ->select('answers.answer_id','answer_desc','user_id','correct_id')
            ->where('question_id',$question_id)
            ->paginate($pp);
           
     
            
        }
        return $answers;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ans = Answer::find($id);

        //KQYR NESE USERI KA ID E NJEJT ME PERGJIGJEN
        if(auth()->user()->id !== $ans->user_id){
            return redirect('/questions');
        }

        return view('answers.edit')->with('ans',$ans);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        //KRIJIMI I PYTJES
        $ans = Answer::find($id);

        
        $ans->answer_desc = $request->input('body');
        $ans->save();

        //MERR ID E PYTJES TE KRIJUAR
        $last_id = $ans->question_id;
        
        return redirect('/questions/'.$last_id)->with('success','Lesson Added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ans = Answer::find($id);

        if(auth()->user()->id !== $ans->user_id){
            return redirect('/questions');
            //OR PAGE NOT FOUND
        }
        $ans->answer_active =1;

        $ans->save();

        return redirect('/questions/'.$ans->question_id)->with('success','Answer Deleted');
    }
}
