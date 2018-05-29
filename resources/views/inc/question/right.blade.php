<?php 
    use App\Tag;
    use App\Question;
    use App\Answer;
    use App\User;
    $tags= Tag::join('tag_questions','tag_questions.tag_id','=','tags.tag_id')
            ->orderBy('count','desc')
            ->limit(3)
            ->groupBy('tag_questions.tag_id')
            ->get(['tags.tag_name', 
                DB::raw('COUNT(tag_questions.tag_id) AS count')
            ]);
    $question = Question::where('question_active',0)->count();
    $answers = Answer::where('answer_active',0)->count();
    $soleved = Answer::join('correct_answers','correct_answers.answer_id','=','answers.answer_id')
                ->count();
    $users = User::all()->count();
?>
<div class="col-md-3 mt-2">
        <div class="row px-2 mt-4">
        <div class="col-md-12 px-2 py-2 mt-2 transform1">
            
        <a href="/questions/create"><button type="button" class="btn mt-1 btn-outline-primary w-100 cr-button bg-light  text-dark" >Create a question</button></a>
        </div>
       
            <div class="col-md-12 px-2 mt-3">
                <h5 class="border-bottom border-top mb-0 p-2 transform1 text-muted">Overall stats</h5>
            <ul>
                    <li> {{$question}} Questions asked</li>
                    <li> {{$answers}} Answeres given </li>
                    <li> {{$soleved}} Questions solved </li>
                    <li> {{$users}} Active Users </li>
               
            </ul>
            </div>
            
            <div class="col-md-12 px-2 mt-3">
                <h5 class="border-bottom border-top mb-0 p-2 transform1 text-muted">Most used tags</h5>
            <ul>
                @foreach($tags as $t)
                    <li><a href="#">{{$t->tag_name}} </a> <small>x {{$t->count}}</small></li>
                @endforeach

            </ul>
            </div>
        </div>
    </div>