@extends('layouts.app')

@section('content')
    <h1>Ask a Questions</h1>
    {!! Form::open(['action' => 'QuestionController@store' , 'method'=> 'POST']) !!}
        <div class ="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title','',['class' => 'form-control','placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body','',['id' => 'article-ckeditor','class'=>'form-control','placeholder'=>'Enter the body'])}}
        </div>
        {{Form::submit('Ask',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}   
@endsection