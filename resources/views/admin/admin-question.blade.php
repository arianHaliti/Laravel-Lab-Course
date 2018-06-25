@extends('layouts.app')

@section('content')

<div class="container p-0 mt-3">
        <div class="row mt-0">
            
          @include('admin.left')

        <div class="col-md-10">
        <ul class="links1 pl-0">
                    <li><a href="/admin" class="text-muted">Dashboard</a></li>
                    <li>/</li>
                    <li><a href="#" class="text-muted">Questions</a></li>
                    
                </ul>
            <div class="container">
            
<div class="row border px-0 py-0 mt-0">
    <div class="col-md-12 p-2  border-top border-bottom mb-0 mt-2">
                <div class="row">
                        <div class="col-md-5 p-0">
                            <h5 class="mb-0 mt ml-3  text-muted">Questions</h5>
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
                            
         
    
            
           <nav class="navbar navbar3 sort-nav navbar-expand-lg navbar-white float-right p-0">
              <ul class="navbar-nav mr-auto mt-1">
                <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted" href="#">Recent
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
                 <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted" href="#">A-Z
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
                
               
              </ul>
              </nav>
</div>
</div>
</div>
<?php 
use App\Question;


 $questions= Question::orderBy('created_at')->paginate(10);


?>

<table class="table mt-2">
   <tr>
       <th>Q_Id</th>
       <th>U_ID</th>
       <th>Title</th>
       <th>Desc</th>
       <th>Views</th>
       <th>Created</th>
       <th>Updated</th>
       <th>Edit</th>
       <th>Active</th>
</tr>

@foreach($questions as $q)
@if($q->question_active=='0')
  <tr class="">
  @else
  <tr class="bg-light">
  @endif
       <td>{{$q->question_id}}</td>
       <td>{{$q->user_id}}</td>
       <td>{{$q->question_title}}</td>
       <td>{{$q->question_desc}}</td>
       <td>{{$q->question_views}}</td>
       <td>{{$q->created_at}}</td>
       <td>{{$q->updated_at}}</td>
       <td><button class="btn btn-sm btn-outline-secondary">edit</button></td>
       @if($q->question_active=='0')
       <td class="">{{$q->question_active}} <button class="btn btn-sm btn-success"></button><button class="btn btn-sm ml-2 btn-outline-danger">deactivate</button></td>
       @else
       <td class="">{{$q->question_active}} <button class="btn btn-sm btn-danger"></button><button class="btn btn-sm ml-2 btn-outline-success">activate</button></td>
       @endif
</tr>
@endforeach

  </table>
</div>
            </div>
                    
            
           
                            
        
                        
                        </div>
                    

        </div>

</div>
</div>

@endsection()