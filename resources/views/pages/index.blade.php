@extends('layouts.app')

@section('content')
<div class="container p-0">
        <div class="row mt-0">
            
            <div class="col-md-9 p-0">
            
                <div class="col-md-12  mt-5">
                
                    <div class="row p-2 transform1 border-top border-bottom mb-0">
                        <div class="col-md-6 p-0">
                            <h5 class="mb-0 mt text-muted">All Questions</h5>
                        </div>
                        <div class="col-md-6">
                            
         
            
    
            
           <nav class="navbar navbar3 sort-nav navbar-expand-lg navbar-white p-0">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted" href="#">Latest
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
                 <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted" href="#">Votes
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
                <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted" href="#">Featured
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
                <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted" href="#">Views
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
                 <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted" href="#">Unanswered
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
               
              </ul>
              </nav>
             
           
            
        
        
                        </div>
                    
                     </div>


                <?php

                  use App\Question;
                  $quest = Question::where('question_active',0)->orderBy('created_at')->paginate(10);
                
                  
                ?>
                @if(count($quest))
                  @foreach($quest as $q)   
                    @include('inc.question.question-box')
                  @endforeach
                  {{$quest->links()}}
                @endif
                      </div>
                      
                      
                  </div>
                @include('inc.question.right')
                
            </div>
        </div>
            </div>
           

  
@endsection