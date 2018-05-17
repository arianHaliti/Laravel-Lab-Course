@extends('layouts.app')

@section('content')
    <h1>Edit an Answer</h1>
    {!! Form::open(['action' => ['AnswerController@update' , $ans->answer_id] ,'method'=> 'POST']) !!}
        
        <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body',$ans->answer_desc,['id' => 'article-ckeditor','class'=>'form-control','placeholder'=>'Enter the body'])}}
        </div>

        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Answer',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}   
@endsection