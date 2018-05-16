

@extends('layouts.app')

@section('content')

	
<script>
    (function($) {
        if (!$.curCSS) {
        $.curCSS = $.css;
    }})(jQuery);
</script>	
 <script src="{{asset ('js/jquery-ui.min.js')}}" type="text/javascript" charset="utf-8"></script>
 <script src="{{asset ('js/tag-it.js')}}" type="text/javascript" charset="utf-8"></script>
 
 <link href="{{asset('css/jquery.tagit.css')}}" rel="stylesheet" type="text/css">
 <link href="{{asset ('css/tagit.ui-zendesk.css')}}" rel="stylesheet" type="text/css">	


 <style>
        input.error {
            border: 1px solid red;
        }
        
        label.error {
            font-weight: normal;
            color: red;
        }
</style>
        
    <h1>Ask a Question</h1>
    {!! Form::open(['id'=>'form','action' => 'QuestionController@store' , 'method'=> 'POST']) !!}
        <div class ="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title','',['class' => 'form-control','placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body','',['id' => 'article-ckeditor','class'=>'form-control','placeholder'=>'Enter the body'])}}
        </div>
        <div>   
            {{Form::label('tags','Tags (3 - 5)')}}
            {{Form::text('tags','',['class'=>'form-control','id'=>'mySingleFieldTags','placeholder' => 'Tags'])}}               
        </div>
        {{Form::submit('Ask',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}   


<script>

jQuery.validator.addMethod("tagC", function(value, element) {
  return  $("#mySingleFieldTags").val().split(",").length >=3;

}, "Please enter at least 3 - 5 tags");



jQuery.validator.addMethod("bodyC", function(value, element) {
    var html=CKEDITOR.instances['article-ckeditor'].getSnapshot();
    var dom=document.createElement("DIV");
    dom.innerHTML=html;
    var plain_text=(dom.textContent || dom.innerText);

    
    if(plain_text.length <=20 ){
        return false;
    }else{
        return true;
    }

}, "Please Elaborate your question (At least 20 chars) ");


$("#form").validate({
    ignore: [],
    
    rules: {
        "title": {
            required: true,
            minlength: 5
        }, 
        tags:{
            tagC: true
        },
        body:{
            bodyC:true
        }
        
    },
    messages: {
        "title": {
            required: "Please, enter your question"
        },
        body:{
            required:"Please enter Text",
            minlength:"Please enter 10 characters"
        }
    },
    submitHandler: function (form) { 
        form.submit();
    }
});


$(document).ready(function () {
        
    $("#mySingleFieldTags").tagit({});
    $("#mySingleFieldTags").tagit({
        tagLimit: 5 
    });
});
</script>
@endsection