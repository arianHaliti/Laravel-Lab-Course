<!--question BOX-->
@include('inc.functions')

<?php 
use App\User;
use App\Answer;
use App\Tag;
use App\Vote;

$username = User::where('id',$q->user_id)->first(['users.username','users.image']);
$answers = Answer::where('answer_active',0)
            ->where('question_id',$q->question_id);
$sum = $answers->count();
//GET VOTES OF QUESTION
$voteQuest = Vote::where('content_id','=',$q->question_id)
        ->where('content_type','=',0)->sum('vote_type');

?>
<div class="row p-2 border-bottom myShadow">
			
				
    <div class="stats bg-light p-1 w-10 h-10 mr-2">
      
        <p class="float-left w-100 m-auto text-center up-do-arr up-arr"><i class="fa fa-caret-up text-muted" aria-hidden="true"></i></p>
        <p class="w-100 text-center m-auto float-left text-muted">{{$voteQuest}}</p>
    </div>
    <div class="stats bg-light p-1 w-10 mr-2">
        <p class="w-100 m-auto text-center"><i class="fas fa-comment-alt text-muted"></i></p>
        <p class="w-100 text-center m-auto text-muted">{{$sum}}</p>
    </div>
    <div class="stats bg-light p-1 w-10 mr-2">
        <p class="w-100 m-auto text-center"><i class="fas fa-eye text-muted"></i></p>
        <p class="w-100 text-center m-auto text-muted">{{$q->question_views}}</p>
    </div>
    <div class="stats  p-1 bg-light rounded-circle w-10 rounded">
        <a href="/profile/{{$q->user_id}}"><img src="/storage/user_logos/{{$username->image}}" class="rounded m-auto"></a>
        <p>{{$username->username}} 
    </div>
    <div class="q-content ml-2 p-2 border2 rounded">
           
     <h6 class="mb-2"><a href="/questions/{{$q->question_id}}">
        {{$q->question_title}}</a></h6>
        <p class="mb-2">{{substring(strip_tags($q->question_desc),80)}}</p>
        <nav aria-label="..." class=" myPagination">
            
<ul class="pagination tags pagination-sm mb-0">


    <?php 
        $q_id= $q->question_id;
        
        $tags = Tag::whereHas('questions', function($c) use($q_id) {
        $c->where('question.question_id', $q_id);   
            })->get();
        
     ?>
    @foreach($tags as $t)
    @if($data['cate']==0)
        <li class="page-item"><a class="page-link text-muted" href ="{{asset('questions/tag/'.urlencode($t->tag_name))}}">{{$t->tag_name}}</a></li>
    @else
        <li class="page-item"><a class="page-link text-muted" href ="{{asset('questions/category/'.urlencode($q->category_name).'/tag/'.urlencode($t->tag_name))}}">{{$t->tag_name}}</a></li>
    @endif
    @endforeach
    
</ul>
    
</nav>
    <div class="col-md-12 myBorderT mt-2"><p class="float-right f-14 mb-0">Created {{time_since(time()-strtotime($q->created_at)).' ago'}} , Edited {{time_since(time()-strtotime($q->updated_at)).' ago'}}</p></div>
    </div>
    


</div>
<!--/.QUESTION BOX-->