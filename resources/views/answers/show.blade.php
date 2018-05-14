<div class="row p-2 border-bottom mt-5">
    <div class="col-md-12">
        <h5>{{$sum}} {{$sum == 1 ? 'ANSWER' : 'ANSWERS'}}</h5>
    </div>
</div>
<!--answer BOX-->
@foreach($answers as $ans)
        
<div class="row p-2  border-bottom">

    <div class="stats  stats-full-post bg-light ml-2 p-1 w-10 mr-2 ml-auto">
        <p class="w-100 m-auto text-center h-100"><i class="fas fa-check m-auto text-center h-100"></i></p>
    </div>
    <div class="stats stats-full-post bg-light p-1 w-10 h-10 mr-2">

        <p class="w-100 m-auto text-center"><i class="fas fa-sort-up"></i></p>

        <p class="w-100 m-auto text-center"><i class="fas fa-sort-down"></i></p>
        <p class="w-100 text-center m-auto">33</p>
    </div>
    <div class="stats bg-light p-1 w-10 rounded-circle">
        <img src="/storage/image/photo.jpg" class="rounded m-auto">
    </div>

    <div class="q-content ml-2 p-2 border">
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

@if(!Auth::guest() && Auth::user()->id ==$ans->user_id)
    <a href= "/answers/{{$ans->answer_id}}/edit" class ="btn btn-default">Edit</a>

    {!! Form::open(['action' => ['QuestionController@destroy' , $ans->answer_id] ,'method'=> 'POST']) !!}

    {{Form::hidden('_method','DELETE')}}
    {{Form::submit('DELETE',['class'=>'btn btn-danger'])}}
    {!! Form::close() !!}
@endif
@endforeach