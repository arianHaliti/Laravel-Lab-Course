<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Tag;
use Carbon;
use Illuminate\Support\Facades\DB;
class TagQuestionController extends Controller
{
    public function tag($tag){
        // pp tregon numrin e  pytjeve per faqe 
        $pp =1;

        // QUERY FOR LATEST QUESTIONS
        $t = Tag::where('tag_name','=',$tag)->get();
        $questions = Question::whereHas('tags',function($q) use($tag){
            $q->where('tag_name','like',$tag);
        })->where('question_active',0)->orderBy('created_at')->paginate($pp);
      
        // QUERY FOR VIEWS QUESTIONS
        if(isset($_GET['sort'])){
            if($_GET['sort']=='latest'){
                $questions = Question::whereHas('tags',function($q) use($tag){
                    $q->where('tag_name','like',$tag);
                })->where('question_active',0)->orderBy('created_at')->paginate($pp);
                $questions->appends(['sort' => 'views'])->links();
            }
            //CHANGE LATER !!
            if($_GET['sort']=='featured'){
                $questions = Question::whereHas('tags',function($q) use($tag){
                    $q->where('tag_name','like',$tag);
                })->where('question_active',0)->orderBy('created_at')->paginate($pp);
                $questions->appends(['sort' => 'views'])->links();
            }
            if($_GET['sort']=='views'){
                $questions = Question::whereHas('tags',function($q) use($tag){
                    $q->where('tag_name','like',$tag);
                })->where('question_active',0)->orderBy('question_views','desc')->paginate($pp);
                $questions->appends(['sort' => 'views'])->links();
            }
            // QUERY FOR VOTE QUESTIONS
            else if ($_GET['sort']=='votes'){
                $questions = DB::table('question')
                ->join('tag_questions', 'question.question_id', '=', 'tag_questions.question_id')
                ->join('tags','tags.tag_id','=','tag_questions.tag_id')
                ->leftjoin('votes', 'votes.content_id', '=', 'question.question_id')
                ->select('question.*', DB::raw('SUM(CASE WHEN votes.content_type = 0 THEN  votes.vote_type ELSE 0 END) as total_votes'),'tags.tag_name')
                ->where('tag_name','like',$tag)
                
                ->where('question.question_active',0)
                ->groupBy('tag_questions.question_id')
                ->orderBy('total_votes','desc')->paginate($pp);
                $questions->appends(['sort' => 'votes'])->links();
            }
            // QUERY FOR UNASWERED QUESTIONS
            else if ($_GET['sort']=='unanswered'){
                $questions = DB::table('question')
                ->select('question.*',
                     DB::raw(" ( SELECT count(*) from answers a 
                     inner join question q on a.question_id = q.question_id
                      where a.answer_active=0 and q.question_id=question.question_id ) as c"   ))
                ->join('tag_questions', 'question.question_id', '=', 'tag_questions.question_id')
                ->join('tags','tags.tag_id','=','tag_questions.tag_id')
                ->leftjoin('answers','answers.question_id','=','question.question_id')  
                ->where('question.question_active',0)
                ->where('tag_name','like',$tag)
                ->groupBy('question.question_id')
                ->having('c','=',0);
             

                //Bug me havign dhe paginate got to make manual paginate
                $questions = $this->paginate($questions,$pp,$tag,"http://labtest.lab/questions/tag/".$tag);
               
           
            }
        }
        $data = [
            'questions'=>$questions,
            'all'   => 'Questions with tag of '.$tag,
            'cate' => 0
        ];
       return view('pages.index')->with('data',$data);
    }
    public function tagCategory($cat,$tag){
        // pp tregon numrin e  pytjeve per faqe 
        $pp =1;

        // QUERY FOR LATEST QUESTIONS
        $t = Tag::where('tag_name','=',$tag)->get();
        $questions = Question::whereHas('tags',function($q) use($tag){
            $q->where('tag_name','like',$tag);
        })
        ->join('question_categories','question_categories.question_id','=','question.question_id')->join('categories','categories.category_id','=','question_categories.category_id')
        ->where('categories.category_name','=',$cat)
        ->where('question_active',0)->orderBy('question.created_at')->paginate($pp);
      
        // QUERY FOR VIEWS QUESTIONS
        if(isset($_GET['sort'])){
            if($_GET['sort']=='latest'){
                $questions = Question::whereHas('tags',function($q) use($tag){
                    $q->where('tag_name','like',$tag);
                })
                ->join('question_categories','question_categories.question_id','=','question.question_id')->join('categories','categories.category_id','=','question_categories.category_id')
                ->where('categories.category_name','=',$cat)
                ->where('question_active',0)->orderBy('question.created_at')->paginate($pp);
                $questions->appends(['sort' => 'views'])->links();
            }
            //CHANGE LATER !!
            if($_GET['sort']=='featured'){
                $questions = Question::whereHas('tags',function($q) use($tag){
                    $q->where('tag_name','like',$tag);
                })
                ->join('question_categories','question_categories.question_id','=','question.question_id')->join('categories','categories.category_id','=','question_categories.category_id')
                ->where('categories.category_name','=',$cat)
                ->where('question_active',0)->orderBy('question.created_at')->paginate($pp);
                $questions->appends(['sort' => 'views'])->links();
            }
            if($_GET['sort']=='views'){
                $questions = Question::whereHas('tags',function($q) use($tag){
                    $q->where('tag_name','like',$tag);
                })
                ->join('question_categories','question_categories.question_id','=','question.question_id')->join('categories','categories.category_id','=','question_categories.category_id')
                ->where('categories.category_name','=',$cat)
                ->where('question_active',0)->orderBy('question_views','desc')->paginate($pp);
                $questions->appends(['sort' => 'views'])->links();
            }
            // QUERY FOR VOTE QUESTIONS
            else if ($_GET['sort']=='votes'){
                $questions = DB::table('question')
                ->join('tag_questions', 'question.question_id', '=', 'tag_questions.question_id')
                ->join('tags','tags.tag_id','=','tag_questions.tag_id')
                ->join('question_categories','question_categories.question_id','=','question.question_id')->join('categories','categories.category_id','=','question_categories.category_id')
                ->where('categories.category_name','=',$cat)
                ->leftjoin('votes', 'votes.content_id', '=', 'question.question_id')
                ->select('question.*','categories.category_name', DB::raw('SUM(CASE WHEN votes.content_type = 0 THEN  votes.vote_type ELSE 0 END) as total_votes'),'tags.tag_name')
                ->where('tag_name','like',$tag)
                
                ->where('question.question_active',0)
                ->groupBy('tag_questions.question_id')
                ->orderBy('total_votes','desc')->paginate($pp);
                $questions->appends(['sort' => 'votes'])->links();
            }
            // QUERY FOR UNASWERED QUESTIONS
            else if ($_GET['sort']=='unanswered'){
                $questions = DB::table('question')
                ->select('question.*','categories.category_name',
                     DB::raw(" ( SELECT count(*) from answers a 
                     inner join question q on a.question_id = q.question_id
                      where a.answer_active=0 and q.question_id=question.question_id ) as c"   ))
                ->join('question_categories','question_categories.question_id','=','question.question_id')->join('categories','categories.category_id','=','question_categories.category_id')
                ->where('categories.category_name','=',$cat)
                ->join('tag_questions', 'question.question_id', '=', 'tag_questions.question_id')
                ->join('tags','tags.tag_id','=','tag_questions.tag_id')
                ->leftjoin('answers','answers.question_id','=','question.question_id')  
                ->where('question.question_active',0)
                ->where('tag_name','like',$tag)
                ->groupBy('question.question_id')
                ->having('c','=',0);
             

                //Bug me havign dhe paginate got to make manual paginate

                $questions = $this->paginate($questions,$pp,$tag,"http://labtest.lab/questions/category/".$cat."/tag/".$tag);
               
           
            }
        }
        //return count($tags);
        $data = [
            'questions'=>$questions,
            'all'   => 'Questions with tag of '.$tag.' and category of '.$cat,
            'cate' => 1
        ];
       return view('pages.index')->with('data',$data);
    }

    public function tagCat($cat){
        $myTime = Carbon\Carbon::now();
                        
            $tags = Tag::join('tag_questions','tag_questions.tag_id','=','tags.tag_id')
            ->join('question','question.question_id','=','tag_questions.question_id')
            ->join('question_categories','question_categories.question_id','=','question.question_id')->join('categories','categories.category_id','=','question_categories.category_id')
            ->where('categories.category_name','=',$cat)
            ->orderBy('tag_count','desc')
            ->groupBy('tag_id','tag_name')
            ->get(['tags.tag_id','tags.tag_name',
            DB::raw('count(tag_questions.question_id) as tag_count'),
            DB::raw('SUM(if(question.created_at > '.'\''.$myTime->subDays(1).'\''.', 1, 0)) AS daily'),
            DB::raw('SUM(if(question.created_at > '.'\''.$myTime->subDays(30).'\''.', 1, 0)) AS monthly , categories.category_name')
            ]);
            $data = [
                'tags'=>$tags,
                'all'   => 'All '.$cat. ' Tags',
                'cate' => 1
            ];
        return view('pages.tag')->with('data',$data);
    }
    public function tags(){
        $myTime = Carbon\Carbon::now();
                        
            $tags = Tag::join('tag_questions','tag_questions.tag_id','=','tags.tag_id')
            ->join('question','question.question_id','=','tag_questions.question_id')
            ->orderBy('tag_count','desc')
            ->groupBy('tag_id','tag_name')
            ->get(['tags.tag_id','tags.tag_name',
            DB::raw('count(tag_questions.question_id) as tag_count'),
            DB::raw('SUM(if(question.created_at > '.'\''.$myTime->subDays(1).'\''.', 1, 0)) AS daily'),
            DB::raw('SUM(if(question.created_at > '.'\''.$myTime->subDays(30).'\''.', 1, 0)) AS monthly')
            ]);
            $data = [
                'tags'=>$tags,
                'all'   => 'All  Tags',
                'cate' => 0
            ];
        return view('pages.tag')->with('data',$data);
    }
    function paginate ($questions,$pp ,$tags,$url) {
        $perPage = $pp;
                
        $curPage = \Illuminate\Pagination\Paginator::resolveCurrentPage();

        $itemQuery = clone $questions;

        $items = $itemQuery->forPage($curPage, $perPage)->get();
        if(count($items)==0){
            $questions =[];
        }
        else{
            $totalResult = $questions->addSelect(DB::raw('count(*) as count'))->get();
            $totalItems = $totalResult->count();
            
            $questions = new \Illuminate\Pagination\LengthAwarePaginator($items->all(), $totalItems, $perPage);
            $questions = $questions->setPath($url);
            $questions->appends(['sort' => 'unanswered'])->links();
        }
        return $questions;
    }
}
