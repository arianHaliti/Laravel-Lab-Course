<?php 
    use App\Tag;
    use App\Answer;
    use App\Question;

    $sumA = Answer::where('answers.answer_active','=',0)
                ->join('votes','votes.content_id','=','answers.answer_id')
                ->where('answers.user_id','=',$u->id)
                ->where('votes.content_type','=',1)
                ->get([
                    DB::raw('IFNULL(SUM(votes.vote_type),0) AS summ')
                ]);
    $sumQ = Question::where('question.question_active','=',0)
                ->join('votes','votes.content_id','=','question.question_id')
                ->where('question.user_id','=',$u->id)
                ->where('votes.content_type','=',0)
                ->get([
                    DB::raw('IFNULL(SUM(votes.vote_type),0) AS summ')
                ]);
    $sumVotes = $sumA[0]->summ +$sumQ[0]->summ;


    $tags= Tag::join('tag_questions','tag_questions.tag_id','=','tags.tag_id')
                ->join('question','question.question_id','=','tag_questions.question_id')
                ->where('question.user_id','=',$u->id)
                ->groupBy('tags.tag_name')
                ->orderBy('cunt','desc')
                ->limit(3)
                ->get(['tags.tag_name',
                    DB::raw('IFNULL(COUNT(tags.tag_name),0) AS cunt')
                ]);

?>
<div class="col-md-4 p-0 p-2 mt-2 mb-2 user-box ">
    <div class="row px-2">
   <div class="col-md-2 p-0">
    <a href="#"><img src="/storage/image/photo.jpg" class="w-10 rounded-circle"></a>
    </div>
    <div class="col-md-10 px-2 border-right">
        <h6 class="w-100">{{$u->name}}</h6>
        <p class="mb-0">Ferizaj,Kosovo</p>
        <p class="mb-0">Points : {{$sumVotes}}</p>
        <ul class="pagination tags pagination-sm mb-0">
            @if(count($tags)==0)
                <li class="page-item">None</li>
            @endif
            @foreach($tags as $t)
                <li class="page-item"><a class="page-link" href="questions/tag/{{urlencode($t->tag_name)}}">{{$t->tag_name}}</a></li>
            @endforeach
        </ul>   
    </div>
    </div>
</div>


