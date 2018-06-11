<?php 
    use App\Tag;
    use App\Course;
    use App\Lesson;
    use App\User;
    $tags= Tag::join('tag_courses','tag_courses.tag_id','=','tags.tag_id')
            ->orderBy('count','desc')
            ->limit(10)
            ->groupBy('tag_courses.tag_id')
            ->get(['tags.tag_name', 
                DB::raw('COUNT(tag_courses.tag_id) AS count')
            ]);
    $courses = Course::where('course_active',0)->count();
    $lessons = Lesson::where('lesson_active',0)->count();
    $users = User::all()->count();
?>
<div class="col-md-3 mt-2">
        <div class="row px-2 mt-4">
                <div class="col-md-12 px-2 py-2 mt-2 transform1">
            
                        <a href="/courses/create"><button type="button" class="btn mt-1 btn-outline-primary w-100 cr-button bg-light  text-dark" >Add a Lesson</button></a>
                        </div>
                <div class="col-md-12 px-2 mt-2">
                        <img src="{{asset('storage/course_covers/'.$course->image)}}" class="c-img p-1 border rounded">
                    </div>


        
       
            
            
            <div class="col-md-12 px-2 mt-3">
                <h6 class="border-bottom border-top mb-0 p-2 transform1 text-muted">Course Tags</h6>
            <ul class="tags pagination-sm mb-0 mt-3 w-100 float-left pl-0">
                @foreach($tags as $t)
                
                    <li class="page-item float-left pr-2 mb-2"><a href="#" class="page-link float-left">{{$t->tag_name}} </a> <small class="float-left mt-1 ml-1">x {{$t->count}}</small></li>
                @endforeach

            </ul>
            </div>
        </div>
    </div>