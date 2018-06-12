<?php $lesson = $c->firstLesson($c->course_id);
      $lessons = $c->lessons($c->course_id)->count();
      $user = $c->createdBy($c->course_id);
      $tags = $c->tags($c->course_id)->get();
?>
<div class="col-md-4 p-0 p-2 mt-2 mb-2 ">
  
    @foreach($tags as $t)
   
        <a href="#" class="p-0 border bg-light position-absolute mt-1 ml-1 f-14 rounded px-2 rgba-white">{{$t->tag_name}}</a>
  
    @endforeach
  
    <a href="/course/{{$c->course_id}}/{{$c->course_title}}"><img src="{{asset('storage/course_covers/'.$c->image)}}" class="w-100"></a>

    <div class="col-md-12 border-left mt-2 float-left border-top-0 px-2 mb-0">
        
        <a href="/course/{{$c->course_id}}/{{$c->course_title}}" class="px-0 py-0 float-left">{{$c->course_title}}</a>

        <p class="f-14 float-left mt-1 mb-2 c-desc">{{substring(strip_tags($c->course_description),350)}}</p>


    <div class="col-md-12 border-top border-bottom p-0 float-left mb-2">
        <p class="f-12 float-left mt-1 mb-1 font-weight-bold font-italic text-muted">{{$lessons}} lessons </p>
        <p class="f-12 float-right mt-1 mb-1 font-weight-bold font-italic ml-2"> <span class="f-12 pr-1 border-right text-muted">  <i class="fas fa-sort-up pt-0 f-14 pt-1"></i></span><span class="f-12 pl-1 text-muted"> {{$c->course_views}} <i class="fas fa-eye"></i></span></p>
    </div>
    <div class="col-md-12 float-left p-0"><img src="/storage/user_logos/{{$user->image}}" class="user-pic float-left rounded-circle mr-1"><p class="f-12 float-left mt-1 mb-1">{{$user->username}}, {{$c->created_at->format('d/m/y')}}</p></div>
</div>
</div>
