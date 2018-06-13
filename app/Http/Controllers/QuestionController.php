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
                $questions = Question::latestSort()->paginate($pp);
                $questions->appends(['sort' => 'latest'])->links();
            }
            else if($_GET['sort']=='featured'){
                $questions = Question::where('question_active',0)->orderBy('created_at','desc')->paginate($pp);
                $questions->appends(['sort' => 'latest'])->links();
            }
            else if($_GET['sort']=='views'){
                $questions = Question::viewSort()->paginate($pp);
                $questions->appends(['sort' => 'views'])->links();
            }
            // QUERY FOR VOTE QUESTIONS
            else if ($_GET['sort']=='votes'){
                $questions = Question::voteSort()->paginate($pp);
                $questions->appends(['sort' => 'votes'])->links();
            }
            // QUERY FOR UNASWERED QUESTIONS
            else if ($_GET['sort']=='unanswered'){
                $questions = Question::unansweredSort();

                //Bug me havign dhe paginate got to make manual paginate
                $questions = $this->paginate($questions,$pp,"http://lab.lab/questions/");
                
           
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
                $questions = Question::getByCategoryTag(Question::latestSort(),$cat)
                ->addSelect('question.*')
                ->paginate($pp);
                $questions->appends(['sort' => 'latest'])->links();
            }
            else if($_GET['sort']=='featured'){
                $questions =null;
                $questions->appends(['sort' => 'latest'])->links();
            }
            else if($_GET['sort']=='views'){
                $questions = Question::getByCategoryTag(Question::viewSort(),$cat)
                ->addSelect('question.*')
                ->paginate($pp);
                $questions->appends(['sort' => 'views'])->links();
            }
            // QUERY FOR VOTE QUESTIONS
            else if ($_GET['sort']=='votes'){
                
                $questions =  Question::getByCategoryTag(Question::voteSort(),$cat)                
                ->paginate($pp);
                $questions->appends(['sort' => 'votes'])->links();
            }
            // QUERY FOR UNASWERED QUESTIONS
            else if ($_GET['sort']=='unanswered'){
                $questions = Question::getByCategoryTag(Question::unansweredSort(),$cat);
                

                //Bug me havign dhe paginate got to make manual paginate
                $questions = $this->paginate($questions,$pp,"http://lab.lab/questions/category/".$cat);
               
           
            }else{$questions=null;}
            $data = [
                'questions'=>$questions,
                'all'   => 'All '.$cat.' Questions',
                'cate' =>1
            ];
            return view('pages.index')->with("data",$data);
        }else{
            $questions = Question::getByCategory($cat)
            ->orderBy('question.created_at')->paginate($pp);
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
            'title' =>'required|max:255',
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
            $search_t = Tag::where('tag_name','=',strtolower($t));
        
            if($search_t->first()==null){
                
                $new_tag = new Tag;
                $new_tag->tag_name = strtolower($t);
                $new_tag->createdBy = auth()->user()->id;
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
            'title' =>'required|max:255',
            'body' => 'required',
            'tags' => 'required'
        ]);

        //KRIJIMI I PYTJES
        $quest = Question::find($id);
        if(auth()->user()->id !== $quest->user_id){
            return redirect('/questions');
        }
        $quest->question_title = $request->input('title');
        $quest->question_desc = $request->input('body');
        $quest->save();

        //MERR ID E PYTJES TE KRIJUAR
        $last_id = $quest->question_id;
        
        $tags = $request->input('tags');
        $tags = explode(",",$tags);
        
        $new_tag =1;
                
       
       
            
        TagQuestion::where('question_id','=', $last_id)
        ->delete();
    
		foreach($tags as $t){
            $search_t = Tag::where('tag_name','=',strtolower($t));
        
            if($search_t->first()==null){
                $new_tag = new Tag;
                $new_tag->tag_name = strtolower($t);
                $new_tag->createdBy = auth()->user()->id;
                $new_tag->save();
                $last_tag_id =$new_tag->tag_id;
            }else{
                $last_tag_id = $search_t->first()->tag_id;
            }
            $link = TagQuestion::where('question_id', '=', $last_id)
                            ->where('tag_id', '=', $last_tag_id);
            if($link->doesntExist()){

                $conn = new TagQuestion;
                $conn->question_id = $last_id;
                $conn->tag_id = $last_tag_id; 
                $conn->save();
            }
            
        }
        
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
    function paginate ($questions,$pp,$url) {
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
