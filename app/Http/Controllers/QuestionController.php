<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Tag;
use App\TagQuestion;
use App\QuestionCategory;
use Illuminate\Support\Facades\DB;
class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=> ['index','show','indexCat']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pp = 5;
        if(isset($_GET['sort'])){
            if($_GET['sort']=='latest'){
                $questions = Question::where('question_active',0)->orderBy('created_at','desc')->paginate($pp);
                $questions->appends(['sort' => 'latest'])->links();
            }
            else if($_GET['sort']=='featured'){
                $questions = Question::where('question_active',0)->orderBy('created_at','desc')->paginate($pp);
                $questions->appends(['sort' => 'latest'])->links();
            }
            else if($_GET['sort']=='views'){
                $questions = Question::where('question_active',0)->orderBy('question_views','desc')->paginate($pp);
                $questions->appends(['sort' => 'views'])->links();
            }
            // QUERY FOR VOTE QUESTIONS
            else if ($_GET['sort']=='votes'){
                $questions = DB::table('question')
                ->leftjoin('votes', 'votes.content_id', '=', 'question.question_id')
                ->select('question.*', DB::raw('SUM(CASE WHEN votes.content_type = 0 THEN  votes.vote_type ELSE 0 END) as total_votes'))
                ->where('question.question_active',0)
                ->groupBy('question.question_id')
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
               
                ->leftjoin('answers','answers.question_id','=','question.question_id')  
                ->where('question.question_active',0)
                ->groupBy('question.question_id')
                ->having('c','=',0);
             

                //Bug me havign dhe paginate got to make manual paginate
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
                    $questions = $questions->setPath("http://labtest.lab/questions/");
                    $questions->appends(['sort' => 'unanswered'])->links();
                }
           
            }else{$questions=null;}
            $data = [
                'questions'=>$questions,
                'all'   =>  'All Questions',
                'cate' =>0
            ];
            return view('pages.index')->with('data',$data);
        }
        $questions = Question::where('question_active',0)->orderBy('created_at')->paginate($pp);
        $data = [
            'questions'=>$questions,
            'all'   => 'All Questions',
            'cate' =>0
        ];
        
        return view('pages.index')->with('data',$data);

        //PRINTS SAME AS PAGES.INDEX !
        //NDRRO CODIN NALT PER ME NDRYSHU /questions !
    }
    public function indexCat($cat)
    {
        $category = $cat;      
        //$q = Question::all();
        //$question = Question::orderBy('created_at', 'desc')->paginate(10);
        //$q = Question::orderBy('created_at','desc')->get();
        $pp = 5;
        if(isset($_GET['sort'])){
            if($_GET['sort']=='latest'){
                $questions = Question::where('question_active',0)
                ->join('question_categories','question_categories.question_id','=','question.question_id')->join('categories','categories.category_id','=','question_categories.category_id')
                ->where('categories.category_name','=',$cat)
                ->orderBy('question.created_at','desc')->paginate($pp);
                $questions->appends(['sort' => 'latest'])->links();
            }
            else if($_GET['sort']=='featured'){
                $questions = Question::where('question_active',0)
                ->join('question_categories','question_categories.question_id','=','question.question_id')->join('categories','categories.category_id','=','question_categories.category_id')
                ->where('categories.category_name','=',$cat)
                ->orderBy('question.created_at','desc')->paginate($pp);
                $questions->appends(['sort' => 'latest'])->links();
            }
            else if($_GET['sort']=='views'){
                $questions = Question::where('question_active',0)
                ->join('question_categories','question_categories.question_id','=','question.question_id')->join('categories','categories.category_id','=','question_categories.category_id')
                ->where('categories.category_name','=',$cat)
                ->orderBy('question_views','desc')->paginate($pp);
                $questions->appends(['sort' => 'views'])->links();
            }
            // QUERY FOR VOTE QUESTIONS
            else if ($_GET['sort']=='votes'){
                $questions = DB::table('question')
                ->leftjoin('votes', 'votes.content_id', '=', 'question.question_id')
                ->join('question_categories','question_categories.question_id','=','question.question_id')->join('categories','categories.category_id','=','question_categories.category_id')
                ->where('categories.category_name','=',$cat)
                ->select('question.*','categories.category_name', DB::raw('SUM(CASE WHEN votes.content_type = 0 THEN  votes.vote_type ELSE 0 END) as total_votes'))
                ->where('question.question_active',0)
                ->groupBy('question.question_id')
                ->orderBy('total_votes','desc')->paginate($pp);
                $questions->appends(['sort' => 'votes'])->links();
            }
            // QUERY FOR UNASWERED QUESTIONS
            else if ($_GET['sort']=='unanswered'){
                $questions = DB::table('question')
                ->join('question_categories','question_categories.question_id','=','question.question_id')->join('categories','categories.category_id','=','question_categories.category_id')
                ->where('categories.category_name','=',$cat)
                ->select('question.*','categories.category_name',
                     DB::raw(" ( SELECT count(*) from answers a 
                     inner join question q on a.question_id = q.question_id
                      where a.answer_active=0 and q.question_id=question.question_id ) as c"   ))
               
                ->leftjoin('answers','answers.question_id','=','question.question_id')  
                ->where('question.question_active',0)
                ->groupBy('question.question_id')
                ->having('c','=',0);
             

                //Bug me havign dhe paginate got to make manual paginate
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
                    $questions = $questions->setPath("http://labtest.lab/questions/category/".$cat);
                    $questions->appends(['sort' => 'unanswered'])->links();
                }
           
            }else{$questions=null;}
            $data = [
                'questions'=>$questions,
                'all'   => 'All '.$cat.' Questions',
                'cate' =>1
            ];
            return view('pages.index')->with("data",$data);
        }else{
            $questions = Question::where('question_active',0)
            ->join('question_categories','question_categories.question_id','=','question.question_id')->join('categories','categories.category_id','=','question_categories.category_id')
            ->where('categories.category_name','=',$cat)
            ->orderBy('question.created_at')->paginate(10);
        }
        $data = [
            'questions'=>$questions,
            'all'   => 'All '.$cat.' Questions',
            'cate' =>1
        ];
        return view('pages.index')->with('data',$data);

        //PRINTS SAME AS PAGES.INDEX !
        //NDRRO CODIN NALT PER ME NDRYSHU /questions !
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' =>'required',
            'body' => 'required',
            'tags' => 'required',
            'category'=> 'required'
        ]);

        //KRIJIMI I PYTJES
        $quest = new Question;

        $quest->question_title = $request->input('title');
        $quest->question_desc = $request->input('body');
        $quest->question_views = 0;
        $quest->question_active = 0;
        $quest->user_id = auth()->user()->id;
        $quest->save();

        //MERR ID E PYTJES TE KRIJUAR
        $last_id = $quest->question_id;
        
        $tags = $request->input('tags');
        $tags = explode(",",$tags);

        $new_tag =1;
		foreach($tags as $t){
            $search_t = Tag::where('tag_name','=',$t);
        
            if($search_t->first()==null){
                
                $new_tag = new Tag;
                $new_tag->tag_name = $t;

                $new_tag->save();
                $last_tag_id =$new_tag->tag_id;
            }else{
                $last_tag_id = $search_t->first()->tag_id;
            }
            $conn = new TagQuestion;
            $conn->question_id = $last_id;
            $conn->tag_id = $last_tag_id; 
            $conn->save();
            
            
        }
        $category = $request->input('category');
            
            $newLink = new QuestionCategory;
            $newLink->question_id = $last_id;
            $newLink->category_id = $category;
            $newLink->save(); 
        return redirect('/questions/'.$last_id)->with('success','Question Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        if(!is_numeric($id))
            abort(404);
            
       $question =  Question::find($id);
       
       if(count($question)==0)
            abort(404);
       
        return view('questions.show')->with('question',$question);
      //  return view('questions.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        if(auth()->user()->id !== $question->user_id){
            return redirect('/questions');
        }

        return view('questions.edit')->with('question',$question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' =>'required',
            'body' => 'required'
        ]);

        //KRIJIMI I PYTJES
        $quest = Question::find($id);

        $quest->question_title = $request->input('title');
        $quest->question_desc = $request->input('body');
        $quest->save();

        //MERR ID E PYTJES TE KRIJUAR
        $last_id = $quest->question_id;
        
        return redirect('/questions/'.$last_id)->with('success','Question Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quest = Question::find($id);
        if(auth()->user()->id !== $quest->user_id){
            return redirect('/questions');
            //OR PAGE NOT FOUND
        }
        $quest->question_active =1;

        $quest->save();

        return redirect('/questions')->with('success','Question Deleted');
    }
}
