<!--question BOX-->
<?php 
use App\Answer;
use App\Tag;
$answers = Answer::where('answer_active',0)
            ->where('question_id',$q->question_id);
$sum = $answers->count();

?>
<div class="row p-2 border-bottom myShadow">
			
				
    <div class="stats bg-light p-1 w-10 h-10 mr-2">
        <p class="w-100 m-auto text-center"><i class="fas fa-sort-up"></i></p>
        <p class="w-100 text-center m-auto">99.4k</p>
    </div>
    <div class="stats bg-light p-1 w-10 mr-2">
        <p class="w-100 m-auto text-center"><i class="fas fa-comment-alt"></i></p>
        <p class="w-100 text-center m-auto">{{$sum}}</p>
    </div>
    <div class="stats bg-light p-1 w-10 mr-2">
        <p class="w-100 m-auto text-center"><i class="fas fa-eye"></i></p>
        <p class="w-100 text-center m-auto">{{$q->question_views}}</p>
    </div>
    <div class="stats bg-light p-1 w-10 rounded-circle">
        <a href="/profile"><img src="storage/image/photo.jpg" class="rounded m-auto"></a>
    </div>
    <div class="q-content ml-2 p-2 border2 rounded">
     <h6 class="mb-2"><a href="/questions/{{$q->question_id}}">
        {{$q->question_title}}</a></h6>
        <p class="mb-2">{{$q->question_desc}}</p>
        <nav aria-label="..." class=" myPagination">
<ul class="pagination tags pagination-sm mb-0">


    <?php 
        $q_id= $q['question_id'];
        
        $tags = Tag::whereHas('questions', function($c) use($q_id) {
        $c->where('question.question_id', $q_id);   
            })->get();
        
     ?>
    @foreach($tags as $t)
    <li class="page-item"><a class="page-link" href="#">{{$t->tag_name}}</a></li>
    @endforeach
</ul>
</nav>
    </div>
    


</div>
<!--/.QUESTION BOX-->