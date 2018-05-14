<?php 
    use App\Answer;
    $answers = Answer::where('answer_active',0)
            ->where('question_id',$question->question_id)->get();
    $sum = $answers->count();
?>

@extends('layouts.app')

@section('content')
    
<div class="row mt-4 ">
		
    <div class="col-md-9">
        <div class="col-md-12 border-bottom-0 ">
        
        <!--question BOX-->
        <div class="row p-2 border-bottom">
        
            
                <div class="stats stats-full-post bg-light p-1 w-10 h-10 mr-2">
                    
                    <p class="w-100 m-auto text-center"><i class="fas fa-sort-up"></i></p>
                    
                    <p class="w-100 m-auto text-center"><i class="fas fa-sort-down"></i></p>
                    <p class="w-100 text-center m-auto">99.4k</p>
                </div>
                <div class="stats stats-full-post bg-light p-1 w-10 mr-2">
                    <p class="w-100 m-auto text-center"><i class="fas fa-comment-alt"></i></p>
                    <p class="w-100 text-center m-auto">{{$sum}}</p>
                </div>
                <div class="stats  stats-full-post bg-light p-1 w-10 mr-2">
                    <p class="w-100 m-auto text-center"><i class="fas fa-eye"></i></p>
                    <p class="w-100 text-center m-auto">{{$question->question_views}}</p>
                </div>
                <div class="stats bg-light p-1 w-10 rounded-circle">
                    <img  src='/storage/image/photo.jpg' class="rounded m-auto">
                </div>
                <div class="q-content ml-2 p-2 mb-4 ml-auto">
                <h6 class="p-0 mb-0 color-muted"><a href="#" >
                    {{$question->question_title}}</a></h6>
                    </div>
                <div class="q-content q-content-desc ml-2 p-2 border  ml-auto">
                 
                    {!!$question->question_desc!!}
                </div>

            
            
        </div>
        @if(!Auth::guest() && Auth::user()->id ==$question->user_id)
            <a href= "/questions/{{$question->question_id}}/edit" class ="btn btn-default">Edit</a>

            {!! Form::open(['action' => ['QuestionController@destroy' , $question->question_id] ,'method'=> 'POST']) !!}
            
            {{Form::hidden('_method','DELETE')}}
            {{Form::submit('DELETE',['class'=>'btn btn-danger'])}}
            {!! Form::close() !!}
        @endif
        <!--/.QUESTION BOX-->
        
       
        <!--/.ANSWER BOX-->
        
            @include('answers.show')
            <!--answer BOX-->
       
        <!--/.answer BOX-->
        
        
        
        
        
        
        </div>

    
        <h1>Have an Answer ?</h1>
     
    @guest
        <h3>You need an account to add an answers</h3>
        <a href='/register'>Register Here</a>
    @else        
        {!! Form::open(['action' => 'AnswerController@store' , 'method'=> 'POST']) !!}
            
            <div class="form-group">
                {{Form::label('body',' ')}}
                {{Form::textarea('body','',['id' => 'article-ckeditor','class'=>'form-control','placeholder'=>'Enter the body'])}}
            </div>  
            {{Form::hidden('q_id',$question->question_id)}}
            {{Form::submit('Answer',['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}   
    @endguest
    </div>
    
    
    <div class="col-md-3 ">
        <div class="row px-2">
            <div class="col-md-12 border p-2 bg-white">
              row
            </div>
        </div>
    </div>
    
</div>

@endsection