@extends('layouts.app')

@section('content')
<div class="container p-0">
        <div class="row mt-0">
            
            <div class="col-md-9 p-0">
            
                <div class="col-md-12  mt-5">
                
                    <div class="row p-2 transform1 border-top border-bottom mb-0">
                        <div class="col-md-6 p-0">
                            <h5 class="mb-0 mt text-muted">Edit this questions</h5>
                        </div>
                        <div class="col-md-6">
                            
         
            
    
            
         
             
           
            
        
        
                        </div>
                    
                     </div>
    <div class="row mt-4">
        <div class="col-md-3 pr-2 pl-0">
            <div class="col-md-12 border bg-light pb-2">
                <h6 class="border-bottom py-2">How to Edit</h6>
                <p class="f-16 ">Edit Instruction</p>
                <p class="f-14">We prefer questions that can be answered, not just discussed.</p>
                <p class="f-14">Quisque ac bibendum velit, a dapibus arcu. Etiam maximus, leo quis feugiat pulvinar, 
                    arcu orci efficitur arcu, in commodo urna mauris eu lorem.
                     Vivamus lectus ex, ultrices quis tortor ac, luctus maximus ante.</p>
                
                    <a href="#" class="f-14">For more visit the help center ></a>
             </div>
        </div>
        <div class="col-md-9 px-2">
    {!! Form::open(['action' => ['QuestionController@update' , $question->question_id] ,'method'=> 'POST']) !!}
        <div class ="form-group">
           
            {{Form::text('title',$question->question_title,['class' => 'form-control','placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
           
            {{Form::textarea('body',$question->question_desc,['id' => 'article-ckeditor','class'=>'form-control','placeholder'=>'Enter the body'])}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Ask',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}   
    </div>
    </div>

@endsection