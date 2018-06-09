@extends('layouts.app')
@section('content')
@include('inc.functions')
     <!--CONTAINER-->
  <div class="container p-0">
        <div class="row mt-0">
            
            <div class="col-md-9 p-0">
            
                <div class="col-md-12  mt-5">
                
                        <div class="row p-2 border-top border-bottom mb-0">
                                <div class="col-md-4 p-0 transform1">
                                  <h5 class="mb-0 mt-1 text-muted">Courses</h5>
                                </div>
                                <div class="col-md-8">
                                    
                 
                    
            
                    
                   <nav class="navbar navbar3 cat-nav sort-nav navbar-expand-lg navbar-white p-0 float-right">
                      <ul class="navbar-nav mr-auto " style="width:200px;">
                       
                        <li class="nav-item dropdown border bg-light rounded p-1 w-100">
                          
                            <a id="navbarDropdown" class="nav-link dropdown-toggle color-dark p-2 w-100 float-left" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Category <span class="caret w-100 float-right"></span>
                            </a>
          
                            <div class="dropdown-menu w-100" aria-labelledby="navbarDropdown">
                                <a class="nav-link border-bottom p-2 py-4 text-muted"  href="/questions/category/general">General
                                  <span class="sr-only">(current)</span>
                                </a>
                                <a class="nav-link  border-bottom p-2 text-muted" href="/questions/category/food">Food
                                  <span class="sr-only">(current)</span>
                                </a>
                            </div>
                        </li>
                        
                       
                      </ul>
                      </nav>
                     
                   
                    
                
                
                                </div>
                            
                             </div>


                    <div class="row p-2 transform1  border-bottom mb-0">
                        <div class="col-md-6 p-0">
                           
                        </div>
                        <div class="col-md-6">
                            
         
            
    
            
           <nav class="navbar navbar3 sort-nav navbar-expand-lg navbar-white float-right p-0">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted activeC" href="#">Recent
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
                    
                    <div class="row p-0 border-bottom courses">
                

                        <?php  use App\Course;

                        $courses = Course::orderBy('created_at')->paginate(5);
                        ?>
                        @if(count($courses))
                            @foreach($courses as $c)
                            
                                @include('inc.course-box')                      
                           @endforeach
                           
                        @endif
                        </div>
                
                        {{$courses->links()}}
                
               
                </div>
                
                
            </div>
            
                @include('courses.right')
        </div>
      </div>
        
     
@endsection()