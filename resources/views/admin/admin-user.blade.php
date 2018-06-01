@extends('layouts.app')

@section('content')


<div class="container p-0 mt-3">
        <div class="row mt-0">
            
            <div class="col-md-2 border-right p-0 bg-light">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active pl-0 py-0 border-bottom"><a href="#" class="nav-link py-2"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>  
            <li class="nav-item active pl-0 py-0 border-bottom"><a href="#" class="nav-link py-2">Users</a></li>  
            <li class="nav-item active pl-0 py-0 border-bottom"><a href="#" class="nav-link py-2">Questions</a></li>  
            <li class="nav-item active pl-0 py-0 border-bottom"><a href="#" class="nav-link py-2">Answers</a></li>  
            <li class="nav-item active pl-0 py-0 border-bottom"><a href="#" class="nav-link py-2">Reports</a></li>  
            <li class="nav-item active pl-0 py-0 border-bottom"><a href="#" class="nav-link py-2">Roles and Permissions</a></li>  
            <li class="nav-item active pl-0 py-0 border-bottom"><a href="#" class="nav-link py-2">Settings</a></li>  
                    
                   

                </ul>

        </div>

        <div class="col-md-10">
        <ul class="links1 pl-0">
                    <li><a href="/admin" class="text-muted">Dashboard</a></li>
                    <li><a href="#" class="text-muted">Users</a></li>
                    
                </ul>
            <div class="container">
            
<div class="row border px-0 py-0 mt-0">
    <div class="col-md-12 p-2  border-top border-bottom mb-0 mt-2">
                <div class="row">
                        <div class="col-md-5 p-0">
                            <h5 class="mb-0 mt ml-3 mt-1 text-muted">Users</h5>
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
                  <a class="nav-link px-5 text-muted" href="#">Recent
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
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
use App\User;


 $users= User::orderBy('created_at')->paginate(5);


?>

               
               
           
<table class="table mt-2">

   <tr>
       <th>Id</th>
       <th>Name</th>
       <th>Last Name</th>
       <th>Username</th>
       <th>Email</th>
       <th>Created</th>
       <th>Edit</th>
       <th>Active</th>
</tr>

@foreach($users as $u)
@if($u->user_active=='0')
  <tr class="">
  @else
  <tr class="bg-light">
  @endif

       <td>{{$u->id}}</td>
       <td>{{$u->name}}</td>
       <td>{{$u->surname}}</td>
       <td>{{$u->username}}</td>
       <td>{{$u->email}}</td>
       <td>{{$u->created_at}}</td>
       <td><button class="btn btn-sm btn-outline-secondary">edit</button></td>
       @if($u->user_active=='0')
       <td>{{$u->user_active}} <button class="btn btn-sm btn-success"></button><button class="btn btn-sm ml-2 btn-outline-danger">deactivate</button></td>
       @else
       <td>{{$u->user_active}} <button class="btn btn-sm btn-danger"></button><button class="btn btn-sm ml-2 btn-outline-success">activate</button></td>
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