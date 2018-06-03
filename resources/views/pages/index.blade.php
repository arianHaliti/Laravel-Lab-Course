<?php
                  
use App\Question;
  $quest= $data['questions'] ;


?>
@extends('layouts.app')

@section('content')
@include('inc.functions')
<div class="container p-0">
        <div class="row mt-0">
            
            <div class="col-md-9 p-0">
            
                <div class="col-md-12  mt-5">
                
                    <div class="row p-2 transform1 border-top border-bottom mb-0">
                        <div class="col-md-4 p-0">
                          <h5 class="mb-0 mt text-muted"> {{$data['all']}}</h5>
                        </div>
                        <div class="col-md-8">
                            
         
            
    
            
           <nav class="navbar navbar3 sort-nav navbar-expand-lg navbar-white p-0">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted" href="{{Request::url()}}?sort=latest">Latest
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Category <span class="caret"></span>
                    </a>
  
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="nav-link border-bottom" style="color:black !important;" href="/questions/category/general">General
                          <span class="sr-only">(current)</span>
                        </a>
                        <a class="nav-link text-dark border-bottom" href="/questions/category/food">Food
                          <span class="sr-only">(current)</span>
                        </a>
                    </div>
                </li>
                <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted" href="{{Request::url()}}?sort=votes">Votes
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
                <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted" href="{{Request::url()}}?sort=featured">Featured
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
                <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted" href="{{Request::url()}}?sort=views">Views
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
                 <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted" href="{{Request::url()}}?sort=unanswered">Unanswered
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
               
              </ul>
              </nav>
             
           
            
        
        
                        </div>
                    
                     </div>


               

            
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