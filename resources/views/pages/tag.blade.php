@extends('layouts.app')

@section('content')
<!--CONTAINER-->
<div class="container p-0">
        <div class="row mt-0">
            
            <div class="col-md-9 p-0">
            
                <div class="col-md-12  mt-5">
                
                    <div class="row p-2 transform1 border-top border-bottom mb-0">
                        <div class="col-md-6 p-0">
                            <h5 class="mb-0 mt text-muted">All Tags</h5>
                        </div>
                        <div class="col-md-6">
                            
         
            
    
            
           <nav class="navbar navbar3 sort-nav navbar-expand-lg navbar-white float-right p-0">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted" href="#">Name
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
                 <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted" href="#">Popular
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
                
               
              </ul>
              </nav>
             
           
                            
        
                        
                        </div>
                    
                    </div>
                    <?php use App\Tag;
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
                    ?>

                    <div class="row p-2 border-bottom tags">
                        @foreach($tags as $t)
                        <div class="col-md-3 p-0 pr-3 mt-2 mb-2">
                            <a href="questions/tag/{{$t->tag_name}}" class="px-2 py-1 rounded border float-left">{{$t->tag_name}}</a><p class="float-left f-12 mt-1 px-2">x {{$t->tag_count}}</p>
                            <p class="f-12 float-left border-left mt-1 pl-2">{{$t->daily}} today,{{$t->monthly}} this month.</p>
                        </div>
                        @endforeach
                            
                    </div>
                
                
                
                
                </div>
                
                
            </div>
            <div class="col-md-3 mt-2">
                <div class="row px-2 mt-4">
                
                    <div class="col-md-12 px-2 mt-3">
                        <h5 class="border-bottom border-top mb-0 p-2 transform1 text-muted">Overall stats</h5>
                      <ul>
                        <li><a href="#">100000</a></li>
                        <li><a href="#">css</a></li>
                        <li><a href="#">java</a></li>
                      </ul>
                    </div>
                    
                    <div class="col-md-12 px-2 mt-3">
                        <h5 class="border-bottom border-top mb-0 p-2 transform1 text-muted">Most used tags</h5>
                      <ul>
                        <li><a href="#">html</a></li>
                        <li><a href="#">css</a></li>
                        <li><a href="#">java</a></li>
                      </ul>
                    </div>
                </div>
            </div>
            
        </div>
      </div>
        </div>
      <!--/container-->
@endsection()