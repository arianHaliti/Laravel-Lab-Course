<?php 
    use App\Tag;
    use App\Answer;
    use App\Question;

    //Referes at User Model function answerVotes
    $sumA =$u->answerVotes($u->id);
    //Referes at User Model function votes 
    $sumQ =$u->votes($u->id);

    $sumVotes = $sumA[0]->summ +$sumQ[0]->summ;


    $tags= Tag::join('tag_questions','tag_questions.tag_id','=','tags.tag_id')
                ->join('question','question.question_id','=','tag_questions.question_id')
                ->where('question.user_id','=',$u->id)
                ->groupBy('tags.tag_name')
                ->orderBy('count','desc')
                ->limit(3)
                ->get(['tags.tag_name',
                    DB::raw('IFNULL(COUNT(tags.tag_name),0) AS count')
                ]);

?>
<div class="col-md-4 p-2 px-3 mt-2 mb-2 user-box">
    <div class="row px-2 ">
   <div class="col-md-2 p-0" >
    <a href="profile/{{$u->id}}"><img src="/storage/user_logos/{{$u->image}}" class="w-10 rounded-circle"></a>
    </div>
    <div class="col-md-10 px-2 border-right">
        <h6 class="w-100 mb-0">{{$u->username}}</h6>
        <p class="mb-0"><small>{{$u->name}} {{$u->surname}}</small></p>
        <p class="mb-0">Points : {{$sumVotes}}</p>
        <ul class="pagination tags pagination-sm mb-0">
            @if(count($tags)==0)
                No tags Used
            @endif
            @foreach($tags as $t)
                <li class="page-item"><a class="page-link" href="questions/tag/{{urlencode($t->tag_name)}}">{{$t->tag_name}}</a></li>
            @endforeach
        </ul>   
    </div>
    </div>
</div>


