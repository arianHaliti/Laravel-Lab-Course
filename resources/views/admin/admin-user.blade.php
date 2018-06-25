@extends('layouts.app')

@section('content')


<div class="container p-0 mt-3">
        <div class="row mt-0">
            
          @include('admin.left')

        <div class="col-md-10">
        <ul class="links1 pl-0">
                    <li><a href="/admin" class="text-muted">Dashboard</a></li>
                    <li>/</li>
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

$c=0;
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
 <?php
    $c++;
 ?>
@if($u->user_active=='0')
  <tr class="">
  @else
  <tr class="bg-light">
  @endif

       <td class="u-id">{{$u->id}}</td>
       <td>{{$u->name}}</td>
       <td>{{$u->surname}}</td>
       <td>{{$u->username}}</td>
       <td>{{$u->email}}</td>
       <td>{{$u->created_at}}</td>
      <td><a href="user/{{$u->id}}/edit"><button class="btn btn-sm btn-outline-secondary">edit</button></a></td>
       @if($u->user_active=='0')
  <td><span id="act{{$c}}">{{$u->user_active}} </span><button class="btn btn-sm btn-success" id="btn{{$c}}"></button><button id="deact{{$c}}" onclick="callajax({{$u->id}},this.id,'btn{{$c}}','act{{$c}}')" class="btn btn-sm ml-2 btn-outline-danger " >deactivate</button></td>
       @else
  <td><span id="act{{$c}}">{{$u->user_active}}</span> <button class="btn btn-sm btn-danger" id="btn{{$c}}"></button><button  onclick="callajax({{$u->id}},this.id,'btn{{$c}}','act{{$c}}')" class="btn btn-sm ml-2 btn-outline-success" id="deact{{$c}}">activate</button></td>
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

<script>

  

   function callajax(id,eid,btn,act){
        
       
          
          
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    alert(eid);
    alert(act);
    alert(btn);
   
  $.ajax({

    url: '/deactivate',
    type: 'POST',
    data: {_token: CSRF_TOKEN,vote:$("#deact").text(),id : id},
    dataType: 'JSON',

    success: function (data) {


      if(data['status']=='Deactivated'){
        $("#"+eid).removeClass("btn-danger");
        $("#"+eid).addClass("btn-success");
        $("#"+eid).html("Activate");
        $("#"+btn).removeClass('btn-danger');
        $("#"+btn).addClass('btn-success');
        $("#"+act).html(1 );
        $("#"+btn).removeClass("btn-danger")
        $('#'+btn).addClass("btn-success")
      }else{
        $("#"+eid).removeClass("btn-success");
        $("#"+eid).addClass("btn-danger");
        $("#"+eid).html("Deactivate");
        $("#"+act).html(0 );
        $("#"+btn).removeClass("btn-success")
        $('#'+btn).addClass("btn-danger")
      }

    },
    erro: function(){
      alert(0);
    }
  });       


  }
  </script>

@endsection()

