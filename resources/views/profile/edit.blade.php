@extends('layouts.app')

@section('content')
<?php 
    $tag = $question->getTags($question->question_id);
    $tags =[];
    foreach($tag as $t){
        array_push($tags,$t->tag_name);
    }
    
?>
	
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
                    {!! Form::open([ 'id'=>'form','action' => ['QuestionController@update' , $question->question_id] ,'method'=> 'POST']) !!}
                        <div class ="form-group">
                            {{Form::text('title',$question->question_title,['class' => 'form-control','placeholder' => 'Title'])}}
                        </div>
                        <div class="form-group">
                        
                            {{Form::textarea('body',$question->question_desc,['id' => 'article-ckeditor','class'=>'form-control','placeholder'=>'Enter the body'])}}
                        </div>
                        <div>   
                            {{Form::label('tags','Tags (1 - 5)')}}
                            {{Form::text('tags','',['class'=>'form-control','id'=>'mySingleFieldTags','placeholder' => 'Tags'])}}               
                        </div>
                        {{Form::hidden('_method','PUT')}}
                        
                        {{Form::submit('Ask',['class'=>'btn btn-primary'])}}
                    {!! Form::close() !!}   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
jQuery.validator.addMethod("tagC", function(value, element) {
    if($("#mySingleFieldTags").val().trim()=="")
        return  false;
    return  $("#mySingleFieldTags").val().split(",").length <6;

}, "Please enter at least 1 - 5 tags");


jQuery.validator.addMethod("lengthTag", function(value, element) {
    var bool =true;
    $("#mySingleFieldTags").val().split(",").forEach(function(element) {
        if(element.length >15){
            bool = false;
        }
    });

    return bool;
    

}, "Tags should have not more than 15 letters");

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
            tagC: true,
            lengthTag :true 
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
$( document ).ready(function() {
    var tags ={!! json_encode($tags) !!};
    tags.forEach(function(element){
        $("#mySingleFieldTags").tagit("createTag", element);
    });
    
});
</script>
 <style>
        input.error {
            border: 1px solid red;
        }
        
        label.error {
            font-weight: normal;
            color: red;
        }
</style>
@endsection