@extends('layouts.app')

@section('content')
<div class="container p-0 mt-3">
        <div class="row mt-0">
            
            @include('admin.left')

        <div class="col-md-10 mt-0 ">
        <ul class="links1 pl-0">
                    <li><a href="#" class="text-muted">Dashboard</a></li>
                    
                </ul>
            <div class="container">
                
            <div class="row p-0 bg-light">
                <div class="col-md-3 border p-2">
                    <div class="row p-2 pr-3">
                    <div class="col-md-5">
                    <h1 class="mt-2 text-center text-muted"><i class="fas fa-users"></i></h1>
                    </div>
                    <div class="col-md-7">
                    <h2 class="text-right">10000</h2>
                    <p class="text-right mb-0">Users</p>
                    </div>

                </div>
                <div class="col-md-12 border-top border-bottom py-0 px-0 float-left">
                    <a href="admin/user" class="f-14 p-2 w-100 float-left">View All <i class="fas fa-arrow-circle-right float-right mt-1"></i></a>
                </div>
                </div>
                <div class="col-md-3 border border-left-0 p-2">
                    <div class="row p-2 pr-3">
                    <div class="col-md-5">
                    <h1 class="mt-2 text-center text-muted"><i class="fas fa-question-circle"></i></h1>
                    </div>
                    <div class="col-md-7">
                    <h2 class="text-right">2612</h2>
                    <p class="text-right mb-0">Questions</p>
                    </div>
                </div>
                <div class="col-md-12 border-top border-bottom py-0 px-0 float-left">
                    <a href="admin/question" class="f-14 p-2 w-100 float-left">View All <i class="fas fa-arrow-circle-right float-right mt-1"></i></a>
                </div>
                </div>
                <div class="col-md-3 border border-left-0 p-2">
                    <div class="row p-2 pr-3">
                    <div class="col-md-5">
                    <h1 class="mt-2 text-center text-muted"><i class="fas fa-reply-all"></i></h1>
                    </div>
                    <div class="col-md-7">
                    <h2 class="text-right">26</h2>
                    <p class="text-right mb-0">Answers</p>
                    </div>
                </div>
                <div class="col-md-12 border-top border-bottom py-0 px-0 float-left">
                    <a href="admin/answer" class="f-14 p-2 w-100 float-left">View All <i class="fas fa-arrow-circle-right float-right mt-1"></i></a>
                </div>
                </div>
                <div class="col-md-3 border border-left-0 p-2">
                    <div class="row p-2 pr-3">
                    <div class="col-md-5">
                    <h1 class="mt-2 text-center text-muted"><i class="fab fa-leanpub"></i></h1>
                    </div>
                    <div class="col-md-7">
                    <h2 class="text-right">26</h2>
                    <p class="text-right mb-0">Tutorials</p>
                    </div>
                </div>
                <div class="col-md-12 border-top border-bottom py-0 px-0 float-left">
                    <a href="admin/course" class="f-14 p-2 w-100 float-left">View All <i class="fas fa-arrow-circle-right float-right mt-1"></i></a>
                </div>
                </div>
            </div>
<div class="row border px-0 py-0 mt-4">
    <div class="col-md-12 p-2  border-top border-bottom mb-0 mt-2">
                <div class="row ">
                        <div class="col-md-5 p-0">
                            <h5 class="mb-0 mt ml-3 text-muted">Messages</h5>
                        </div>
                        <div class="col-md-2 p-0">
                        <div class="input-group input-group-sm mySearch mySearch1 mr-4 border-0 w-100 rounded float-left">

<input type="text" placeholder="Search..." id="search1" class="form-control text-light px-2 bg-light border  search1" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
<div class="input-group-append">
<button class="btn btn-light border px-3" type="button"><i class="fas fa-search"></i></button>
</div>
</div>
                        </div>
                        <div class="col-md-5">
                            
         
            
    
            
           <nav class="navbar navbar3 sort-nav navbar-expand-lg navbar-white float-right p-0 mt-1">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted" href="#">Recent
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
                 <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted" href="#">Non replied
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
                
               
              </ul>
              </nav>
</div>
</div>
</div>

<table class="table mt-2">
   <tr>
       <th>Name</th>
       <th>Message</th>
       <th>Name</th>
</tr>
<tr>
       <td>Yllzon Sejdiu</td>
       <td>Nice Page</td>
       <td>Name</td>
</tr>
<tr>
       <td>Yllzon Sejdiu</td>
       <td>asdasd asdasd</td>
       <td>Name</td>
</tr>
  </table>
</div>
            </div>
                    
            
           
                            
        
                        
                        </div>
                    

        </div>

</div>
</div>
@endsection