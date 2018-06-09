@extends('layouts.app')

@section('content')

<?php 
use App\Course;
	$course = $data['course'];
	$lesson = $data['lesson'];

	$lessons = $course->lessons($course->course_id);
	$user = $course->createdBy($course->course_id);

	$countLessons = $lessons->count();
 //$courses= Course::orderBy('created_at')->paginate(10);


?>

<div class="container p-0 mt-0">
  <div class="row mt-0">
	<div class="col-md-1 mt-5">
		 <img src="/storage/image/cover.jpg" class="rounded-circle p-2 profile-img p-img3 border border-primary">
	</div>
	<div class="col-md-5 mt-5">
		<h5 class="mb-0">{{$user->username}} <button class="btn btn-sm p-0 px-2 btn-outline-primary bg-light transform1">follow</button></h5>
		
		<p class="mb-0">Created at {{$course->created_at->format('m/d/Y')}}</p>
	</div>
	<div class="col-md-1 p-0 mt-5">
		
			<h1 class="c-logo"><i class="fab fa-leanpub"></i></h1>
	
</div>
	<div class="col-md-5 float-right">
		
			<div class="stats stats-full-post bg-light p-1 w-10 h-10 mr-2 mt-5 float-right">
                    

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
	</div>
  </div>
  <div class="row mt-0 border-top border-bottom mt-5">
	<div class="col-md-6 py-1  transform1 ">
	<h4> {{$course->course_title}}</h4>
	</div>
	<div class="col-md-6 py-1 transform1 ">
	<ul class="float-right mt-1 mb-0 les-vid-ul">
	<li class="float-left mr-2"></li>
	<li class="float-left mr-2">{{$countLessons}} Lessons </li>
	
	
	</ul>
	</div>
  </div>
        <div class="row mt-0">
            
            <div class="lesons-links mt-5 border p-0 px-2 bg-light">
			<h5 class="border-bottom transform1 py-2">Lessons</h5>
            <ul class="navbar-nav mr-auto">
			@if(count($lessons)!=0)
			@foreach($lessons as $l)
				
				<li class="nav-item active pl-0 py-0 border-bottom"><a href="/course/{{$l->lesson_id}}/{{$course->course_title}}/{{$l->lesson_title}}" class="nav-link py-2">{{$l->lesson_title}}</a></li>  
			@endforeach
			@else
			<h6>No Lessons for this Course</h6>
			@endif
			@if(!Auth::guest() && Auth::user()->id ==$course->user_id)
				<li class="nav-item active pl-0 py-0 border-bottom"><a href="#" class="nav-link py-2">Add another Lesson !</a></li>    
            @endif

                </ul>

        </div>

        <div class="p-2 q-content l-content mt-5 ml-3 mr-1 border rounded">
			<h4 class="transform1 border-bottom pb-2">{{$lesson->lesson_title}}</h4>
			<p>{{$lesson->lesson_desc}}</p>
        </div>
						
		
		@include('courses.right')
                    

        </div>

</div>
</div>
@endsection