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

    
<div class="container p-0">
    <div class="row mt-0">
        <div class="col-md-9 p-0">
            <div class="col-md-12  mt-5">
                <div class="row p-2 transform1 border-top border-bottom mb-0">
                    <div class="col-md-6 p-0">
                        <h5 class="mb-0 mt text-muted">Edit Your Profile</h5>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-3 pr-2 pl-0">
                        <div class="col-md-12 border bg-light pb-2">
                            <h6 class="border-bottom py-2">How to Profile</h6>
                            <p class="f-16 ">Edit Instruction</p>
                            <p class="f-14">We prefer questions that can be answered, not just discussed.</p>
                            <p class="f-14">Quisque ac bibendum velit, a dapibus arcu. Etiam maximus, leo quis feugiat pulvinar, 
                            arcu orci efficitur arcu, in commodo urna mauris eu lorem.
                            Vivamus lectus ex, ultrices quis tortor ac, luctus maximus ante.</p>
                            <a href="#" class="f-14">For more visit the help center ></a>
                        </div>
                    </div>
                    <div class="col-md-9 px-2">
                    <?php 
                        $female = 0 ; $male = 0;
                        if(count($profile)==0){
                            $desc = "";$gender=0;
                        }else
                        {
                            $profile =$profile->first();
                            $desc=$profile->user_desc;$gender= $profile->gender;
                            if($gender ==0)
                                $male= 1;
                            else if($gender==1)
                                $female = 1;
                        }
                        
                    ?>
                    {!! Form::open([ 'id'=>'form','action' => ['ProfileController@update',Auth::user()->id] ,'method'=> 'POST','enctype'=>'multipart/form-data']) !!}
                        <div class ="form-group">
                            {{Form::label('username', 'Username')}}
                            {{Form::text('username',Auth::user()->username,['class' => 'form-control','placeholder' => 'Username'])}}
                        </div>
                        <div class ="form-group">
                            {{Form::label('name', 'Your First Name')}}
                            {{Form::text('name',Auth::user()->name,['class' => 'form-control','placeholder' => 'FirstName'])}}
                        </div>
                        <div class ="form-group">
                            {{Form::label('lastname', 'Your Last Name')}}
                            {{Form::text('surname',Auth::user()->surname,['class' => 'form-control','placeholder' => 'LastName'])}}
                        </div>
                        <div class ="form-group">
                            {{Form::label('email', 'Your Email')}}
                            {{Form::text('email',Auth::user()->email,['class' => 'form-control','placeholder' => 'Email'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('desc', 'A short Story about yourself')}}
                            {{Form::textarea('desc',$desc,['class'=>'form-control','placeholder'=>'Life Description'])}}
                        </div>
                        <div class="form-group">
                        Your Logo : {{Form::file('image')}}
                        <br>
                        {{ Form::radio('sex', 0,$male)}}Male  
                        <br> 
                        {{ Form::radio('sex', 1,$female) }}Female
                        </div>
                        {{Form::hidden('_method','PUT')}}
                        
                        {{Form::submit('Update',['class'=>'btn btn-primary'])}}
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