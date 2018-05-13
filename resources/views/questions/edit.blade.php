@extends('layouts.app')

@section('content')
    <h1>Edit a Questions</h1>
    {!! Form::open(['action' => ['QuestionController@update' , $question->question_id] ,'method'=> 'POST']) !!}
        <div class ="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title',$question->question_title,['class' => 'form-control','placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body',$question->question_desc,['id' => 'article-ckeditor','class'=>'form-control','placeholder'=>'Enter the body'])}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Ask',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}   
@endsection