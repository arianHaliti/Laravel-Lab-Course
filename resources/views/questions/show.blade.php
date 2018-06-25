<?php 
    use App\Answer;
    use App\Vote;
    use App\CorrectAnswer;
    $answers =app('App\Http\Controllers\AnswerController')->show($question->question_id);
    $user = $question->createdBy($question->question_id)->first();
    $sum = $answers->count();
//GETS THE USERS VOTE FOR THE QUESTION TO SHOW ON THE ARROWS
    if(!Auth::guest()){
        $v= Vote::where('content_id','=',$question->question_id)
        ->where('content_type','=',0)
        ->where('user_id','=',Auth::user()->id)
        ->get()
        ->first();
     
    }
   
?>

@extends('layouts.app')

@section('content')

<style>
        input.error {
            border: 1px solid red;
        }
        
        label.error {
            font-weight: normal;
            color: red;
        }
</style>
<div class="row mt-4 ">
		
    <div class="col-md-9 p-0">
        <div class="col-md-12 border-bottom-0 ">

            <div class="row p-2 border-top border-bottom mb-0">
                <div class="col-md-4 p-0 transform1">
                  <h5 class="mb-0 mt-1 text-muted"> All Questions</h5>
                </div>
                <div class="col-md-8"></div>
            </div>
        <!--question BOX-->
        <div class="row p-2 border-bottom">
        
            
                <div class="stats stats-full-post bg-light p-1 w-10 h-10 mr-2">
                    

                    @if(Auth::guest() || count($v)==0 || $v->vote_type==0)
                    <a id = "upvote" href="#" class="float-left w-100 m-auto text-center up-do-arr q_vote" name="up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                 
                    <a id = "downvote" href="#" class="float-left w-100 m-auto text-center up-do-arr q_vote"  name ="down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                    
                    @else
                        @if($v->vote_type == 1)
                             
                            <a id = "upvote" href="#" class="float-left w-100 m-auto text-center up-do-arr q_vote  correct-color" name="up"><i  class="fa fa-caret-up " aria-hidden="true"></i></a>
                            <a  id = "downvote" href="#" data-toggle="tooltip" title="Disabled tooltip" class="float-left w-100 m-auto text-center up-do-arr q_vote"  name ="down"><i  class="fa fa-caret-down" aria-hidden="true"></i></a>
                        @elseif ($v->vote_type==-1)
                            <a id = "upvote" href="#" class="float-left w-100 m-auto text-center up-do-arr q_vote" name="up"><i  class="fa fa-caret-up" aria-hidden="true"></i></a>
                            
                            <a id = "downvote" href="#" class="float-left w-100 m-auto text-center up-do-arr q_vote correct-color"  name ="down"><i  class="fa fa-caret-down " aria-hidden="true"></i></a>
                        @endif
                    @endif   
                    
                    <script>$('#downvote').tooltip('show')</script>
                    <p class="w-100 text-center m-auto float-left"id="q_total"></p>
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
                   
                    <img  src='/storage/user_logos/{{$user->image}}' class="rounded m-auto">
                </div>
                <div class="q-content q2-content ml-2 p-2 mb-4 ml-auto rounded">   
                        <div class="col-md-12 edit-del float-left">
                            <div class="float-right edit-del-nav">
                        @if(!Auth::guest() && Auth::user()->id ==$question->user_id)
            <a href= "/questions/{{$question->question_id}}/edit" class ="btn btn-outline-primary btn-sm edit-btn border-top-0">Edit</a>

            {!! Form::open(['action' => ['QuestionController@destroy' , $question->question_id] ,'method'=> 'POST']) !!}
            
            {{Form::hidden('_method','DELETE')}}
            {{Form::submit('Delete',['class'=>'btn btn-outline-danger btn-sm del-btn'])}}
            {!! Form::close() !!}
        @endif
                        </div>
</div>
                <h6 class="p-0 mb-0 color-muted"><a href="#" >
                    {{$question->question_title}}</a></h6>

                   
                    </div>
                <div class="q-content q-content-desc q2-content ml-2 p-2 border  ml-auto rounded">
                 
                    {!!$question->question_desc!!}

                    
                    
                </div>

           
            
        </div>
       
        <!--/.QUESTION BOX-->       
       
        <!--/.ANSWER BOX-->  
            @include('answers.show')
    
        <!--/.answer BOX-->
  
        </div>
        {{$answers->links()}}     
    <div class="row p-2 transform1 border-top border-bottom mb-0 mt-5">
        <div class="col-md-6 p-0">
            <h5 class="mb-0 mt text-muted">Add An Answer</h5>
        </div>
        <div class="col-md-6"></div>
    </div>
    @include('answers.create')
    </div>

    
    @include('inc.question.right')
    
</div>
<script>
   $.validator.addMethod("desc", function(value, element) {
    var html=CKEDITOR.instances['article-ckeditor'].getSnapshot();
    var dom=document.createElement("DIV");
    dom.innerHTML=html;
    var plain_text=(dom.textContent || dom.innerText);

    
    if(plain_text.length <=20 ){
        return false;
    }else{
        return true;
    }

}, "Please Elaborate your Answer (At least 20 chars) ");

$("#form").validate({
    ignore: [],
    
    rules: {
        body:{
            desc:true
        }
        
    },
    messages: {
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
<script src="{{ URL::asset('js/vote.js')}}" type="text/javascript" charset="utf-8"></script>
<script>
    voteAjax({!! json_encode($question->question_id) !!},{!! json_encode(Auth::check()) !!},0,"#q_total",".q_vote","#upvote","#downvote");    
</script>
@endsection