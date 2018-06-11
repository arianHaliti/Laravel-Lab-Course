<?php $tags = $data['tags']; ?>
@extends('layouts.app')

@section('content')
<!--CONTAINER-->
<div class="container p-0">
        <div class="row mt-0">
            
            <div class="col-md-9 p-0">
            
                <div class="col-md-12  mt-5">
                

                        <div class="row p-2 border-top border-bottom mb-0">
                                <div class="col-md-4 p-0 transform1">
                                  <h5 class="mb-0 mt-1 text-muted">{{$data['all']}}</h5>
                                </div>
                                <div class="col-md-8">
                                    
                 
                    
            
                                        <nav class="navbar navbar3 cat-nav sort-nav navbar-expand-lg navbar-white p-0 float-right">
                                                <ul class="navbar-nav mr-auto" style="width:200px;">
                                                  
                                                  <li class="nav-item dropdown  border bg-light rounded p-1 w-100">
                                                                  
                                                      <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"  v-pre>
                                                          Category <span class="caret"></span>
                                                      </a>
                                      
                                                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                          <a class="nav-link text-dark border-bottom" href="/tag/category/general">General
                                                              <span class="sr-only">(current)</span>
                                                          </a>
                                                          <a class="nav-link text-dark border-bottom" href="/tag/category/food">Food
                                                              <span class="sr-only">(current)</span>
                                                          </a>
                                                           
                                                      </div>
                                                  </li>
                                                 
                                                </ul>
                                                </nav>
                     
                   
                    
                
                
                                </div>
                            
                             </div>


                    <div class="row p-2 transform1 border-bottom mb-0">
                        <div class="col-md-6 p-0">
                            
                        </div>
                        <div class="col-md-6">
                            
         
            
    
            
           <nav class="navbar navbar3 sort-nav navbar-expand-lg navbar-white float-right p-0">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active pl-0 activeC">
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
              
                    <div class="row p-2 border-bottom tags">
                        @foreach($tags as $t)
                        <div class="col-md-3 p-0 pr-3 mt-2 mb-2">
                            @if($data['cate']==1)
                            <a href="/questions/category/{{$t->category_name}}/tag/{{urlencode($t->tag_name)}}" class="px-2 py-1 rounded border float-left">{{$t->tag_name}}</a><p class="float-left f-12 mt-1 px-2">x {{$t->tag_count}}</p>
                        @else
                            <a href="questions/tag/{{urlencode($t->tag_name)}}" class="px-2 py-1 rounded border float-left">{{$t->tag_name}}</a><p class="float-left f-12 mt-1 px-2">x {{$t->tag_count}}</p>
                        @endif
                        <p class="f-12 float-left border-left mt-1 pl-2 w-100">{{$t->daily}} today,{{$t->monthly}} this month.</p>
                        </div>
                        @endforeach
                            
                    </div>
                
                
                
                
                </div>
                
                
            </div>
       @include('inc.question.right')
            
        </div>
      </div>
        </div>
      <!--/container-->
@endsection()