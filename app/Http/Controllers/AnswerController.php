<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
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
        //
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

        
        $last_id = Input::get('q_id');
        
        return redirect('/questions/'.$last_id)->with('success','Answer created');
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        
        return redirect('/questions/'.$last_id)->with('success','Answer Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
