@extends('layouts.app')

@section('content')
@include('inc.functions')
<?php 
	use App\User;
	use App\Course;
	use App\Question;
	use App\Answer;
	$user = auth()->user();
?>

<div class="container p-0 mt-0">
	
	<div class="row mt-0">
		<div class="lesons-links mt-5">
			<div class="w-100 border p-0 px-2 bg-light rounded">
			<div class="col-md-12">
				<div class="container col-md-9 mt-4">
				<img src="/storage/user_logos/{{$user->image}}" class="rounded-circle bg-light p-2 profile-img2 border border-primary">
			</div>
		</div>
				
						
				
					<h6 class="text-center transform1 w-100 mt-2 mb-0">{{$user->name.' '.$user->surnmae}}</h6>
					<p class="text-center transform1 w-100 text-muted mb-0 mt0-0 f-14"> {{'@'.$user->username}}</p>
			
		
					<ul class="pl-0 stat1-ul mt-4">
		
				<li class="nav-item active pl-0 py-2 border-bottom border-top ">
					
				<h4 class="nav-link text-center m-0 p-0">{{$user->votes($user->id)[0]->summ + $user->answerVotes($user->id)[0]->summ}}</h4>
					<p class="text-center w-100 mt-0 mb-0 f-14">Points</p>
				
				</li>    
				<li class="nav-item active pl-0 py-2 border-bottom">
					
						<h4 class="nav-link text-center m-0 p-0">{{$user->followers($user->id)->count()}}</h4>
						<p class="text-center w-100 mt-0 mb-0 f-14">Followers</p>
					
					</li>    
					<li class="nav-item active pl-0 py-2 border-bottom ">
					
							<h4 class="nav-link text-center m-0 p-0">{{$user->following($user->id)->count()}}</h4>
							<p class="text-center w-100 mt-0 mb-0 f-14">Following</p>
						
						</li>    

					</ul>
		</div>
	</div>
		
        <div class="p-2 q-content l-content f-content mt-5 ml-3 mr-1 rounded">
				<h4 class="transform1 border-bottom pb-2">People you follow</h4>

				<!--BOX-->
			@foreach($data as $d)
			<?php $creator = User::find($d->user_id);
				$headText;$text;
				if($d->type ==1){
					$headText = "asked";
					$text = " this question";
					$class= "text-primary";
					$quest = Question::find($d->question_id);
					$title = $quest->question_title;
					$body = $quest->question_desc;
					$href = "questions/".$d->question_id;
					$points = $quest->getPoints($quest->question_id);
				}elseif($d->type==2){	
					$headText = "answered";
					$text = " this question";
					$class= "text-success";
					$ans = Answer::find($d->question_id);
					$quest = Question::find($ans->question_id);
					$title = $quest->question_title;
					$body = $ans->answer_desc;
					$href = "questions/".$quest->question_id;
					$points = $ans->getPoints($ans->answer_id);
				}elseif($d->type==3){
					$headText = "created";
					$text = " a course";
					$class= "text-primary";
					$course =Course::find($d->question_id);
					$body = $course->course_description;
					$title = $course->course_title;
					$href = "course/".$course->course_id.'/'.$course->course_title;
					$points = ' - ';
				}
			?>
				<div class="q-content w-100 py-2 border2 rounded mb-2 bg-white">
					<div class="container">
						<div class="row border-bottom p-0 px-2 ">
							<div class="col-md-9 p-0">
								<img src="/storage/user_logos/{{$creator->image}}" class="profile-pic2 rounded-circle float-left mr-1 mb-2">
								<p class="mb-1 mt-1"><span class="font-weight-bold">{{$creator->username}}</span><span class="transform1"> <a href="{{$href}}"><span class="{{$class}}">{{$headText}}</span></a>{{$text}}</span></p>
							</div>
							<div class="col-md-3 p-0">
								<p class="mb-1 float-right mt-1">about {{time_since(time()-strtotime($d->ca))}} ago</p>
							</div>
						</div>
					</div>
					<a href="#"><div class="col-md-12 p-2 border-bottom border-top bg-light  mt-2">
						<h6 class="mb-2 pb-2 mt-2"><a href="{{$href}}">
						{{$title}}</a></h6>
						<p class="text-muted">{{strip_tags($body)}}</p>
						<div class="col-md-12 p-0 border-top">
							<ul class="ml-0 pl-0 home-stats m-0 p-0">
								<li class="border-right f-14 px-2 text-muted">{{$points}} <i class="fas fa-caret-up"></i></li>
								<li class="border-right f-14 px-2 text-muted">1000 <i class="fas fa-caret-up"></i></li>
							</ul>
						</div>
					</div></a>
				</div>
			@endforeach
		</div>
	</div>
</div>
</div>
@endsection