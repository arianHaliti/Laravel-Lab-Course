<?php 
    use App\Answer;
    $answers = Answer::where('answer_active',0)
            ->where('question_id',$question->question_id)->get();
    $sum = $answers->count();
?>

@extends('layouts.app')

@section('content')
    
<div class="row mt-4 ">
		
    <div class="col-md-9 p-0">
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

    <div class="row p-2 transform1 border-top border-bottom mb-0">
                        <div class="col-md-6 p-0">
                            <h5 class="mb-0 mt text-muted">Add An Answer</h5>
                        </div>
                        <div class="col-md-6">
                            
         
            
    
            
         
             
           
            
        
        
                        </div>
</div>
<div class="row mt-4">
        <div class="col-md-3 pr-2 pl-0">
            <div class="col-md-12 border bg-light pb-2">
                <h6 class="border-bottom py-2">Add An Answer</h6>
                <p class="f-16 ">How to add an answer?</p>
                <p class="f-14">We prefer answers that can solve the problem, not just discussed.</p>
                <p class="f-14">Quisque ac bibendum velit, a dapibus arcu. Etiam maximus, leo quis feugiat pulvinar, 
                    arcu orci efficitur arcu, in commodo urna mauris eu lorem.
                     Vivamus lectus ex, ultrices quis tortor ac, luctus maximus ante.</p>
                
                    <a href="#" class="f-14">For more visit the help center ></a>
             </div>
        </div>
        <div class="col-md-9 px-2">
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
        </div>
</div>
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