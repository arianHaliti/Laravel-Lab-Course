
<div class="row p-2 border-bottom border-top mt-5 transform1">
    <div class="col-md-12">
        <h5 class="mb-0 text-muted">{{$sum}} {{$sum == 1 ? 'ANSWER' : 'ANSWERS'}}</h5>
    </div>
</div>
<!--answer BOX-->
<?php $c=0;?>
@foreach($answers as $ans)
<?php  $c++;?>        
<div class="row p-2  border-bottom">

    <div class="stats  stats-full-post bg-light ml-2 p-1 w-10 mr-2 ml-auto">
        <p class="w-100 m-auto text-center h-100"><i class="fas fa-check m-auto text-center h-100"></i></p>
    </div>
    <div class="stats stats-full-post bg-light p-1 w-10 h-10 mr-2">

          <a href="#" class="float-left w-100 m-auto text-center up-do-arr {{'a_vote'.$c}}" name="up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>

         <a href="#" class="float-left w-100 m-auto text-center up-do-arr {{'a_vote'.$c}}" name ="down" ><i class="fa fa-caret-down" aria-hidden="true"></i></a>
         <p class="w-100 text-center m-auto float-left" id="{{'a_total'.$c}}" >33</p>
    </div>
    <div class="stats bg-light p-1 w-10 rounded-circle">
        <img src="/storage/image/photo.jpg" class="rounded m-auto">
    </div>

    <div class="q-content ml-2 p-2 border">
    <div class="col-md-12 edit-del float-left">
                            <div class="float-right edit-del-nav">
        @if(!Auth::guest() && Auth::user()->id ==$ans->user_id)
    <a href= "/answers/{{$ans->answer_id}}/edit" class ="btn btn-outline-primary btn-sm edit-btn border-top-0">Edit</a>

    {!! Form::open(['action' => ['AnswerController@destroy' , $ans->answer_id] ,'method'=> 'POST']) !!}
        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('Delete',['class'=>'btn btn-outline-danger btn-sm  del-btn'])}}
    {!! Form::close() !!}
@endif
    </div>
</div>
        {!!$ans->answer_desc!!}
        
</div>
    <!--COMMENTS-->
    <div class="c-content bg-light ml-2 p-2 myBorder border border-top-0  ml-auto">
    <img src="/storage/image/photo.jpg" class="rounded-circle ml-auto float-left mr-2">
    <p class="p-0 mb-0">
        first change</p>
        </div>
        <div class="c-content bg-light ml-2 p-2 myBorder border border-top-0 ml-auto">
    <img src="/storage/image/photo.jpg" class="rounded-circle ml-auto float-left mr-2">
    <p class="p-0 mb-0">
        Some other Comment</p>
        </div>
        <div class="c-content bg-light ml-2 p-2 myBorder border border-top-0 ml-auto">
    <img src="/storage/image/photo.jpg" class="rounded-circle ml-auto float-left mr-2">
    <p class="p-0 mb-0">
        You are rights.</p>
        </div>
    <!--/.COMMENTS-->


</div>
<script src="{{asset ('js/vote.js')}}" type="text/javascript" charset="utf-8"></script>

<script>                 
    var a_total = "#a_total<?php echo $c?>";
    var a_vote =".a_vote<?php echo $c?>";   
    voteAjax({!! json_encode($ans->answer_id) !!},{!! json_encode(Auth::check()) !!},1,a_total,a_vote);
</script>

@endforeach