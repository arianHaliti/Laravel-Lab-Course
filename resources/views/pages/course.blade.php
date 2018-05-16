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
                    
                    <div class="row p-2 border-bottom courses">
                

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
            
                @include('inc.question.right')
        </div>
      </div>
        </div>
     
@endsection()