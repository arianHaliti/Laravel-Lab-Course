<?php use App\Category;?>

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
        <div class="container p-0">
        <div class="row mt-0">
            
            <div class="col-md-9 p-0">
            
                <div class="col-md-12  mt-5">
                
                    <div class="row p-2 transform1 border-top border-bottom mb-0">
                        <div class="col-md-6 p-0">
                            <h5 class="mb-0 mt text-muted">Add A Lesson</h5>
                        </div>
                        <div class="col-md-6">
        
                        </div>
                    
                     </div>
    <div class="row mt-4">
        <div class="col-md-3 pr-2 pl-0">
            <div class="col-md-12 border bg-light pb-2">
                <h6 class="border-bottom py-2">How to Add A Lesson</h6>
                <p class="f-16 ">arcu. Etiam maximus, leo quiarcu. Etiam maximus?</p>
                <p class="f-14">Warcu. Etiam maximus, leo quised.</p>
                <p class="f-14">Quisque ac bibendum velit, a dapibus arcu. Etiam maximus, leo quis feugiat pulvinar, 
                    arcu orci efficitur arcu, in commodo urna mauris eu lorem.
                     Vivamus lectus ex, ultrices quis tortor ac, luctus maximus ante.</p>
                
                    <a href="#" class="f-14">For more visit the help center ></a>
             </div>
        </div>
        
        <div class="col-md-9 px-2">
        {!! Form::open(['id'=>'form','action' => 'LessonController@store' , 'method'=> 'POST']) !!}
            <div class ="form-group">
                {{Form::hidden('c_id',$c_id)}}
                {{Form::text('title','',['class' => 'form-control q-title-input','placeholder' => 'Title'])}}
            </div>
            <div class="form-group">
                {{Form::textarea('body','',['id' => 'article-ckeditor','class'=>'form-control','placeholder'=>'Enter the body'])}}
            </div>
           
            
            {{Form::submit('Add',['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}   

</div>
    </div>
</div>
            </div>
        </div>
    </div>
<script>

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
@endsection