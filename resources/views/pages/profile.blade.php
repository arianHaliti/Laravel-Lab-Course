
<?php use App\Question; ?>
@extends('layouts.app')

@section('content')

<div class="container mt-3">
    <div class="row px-2">
        <div class="col-md-12">
            <ul class="stat-ul trophies-ul black ml-4">
            <li class="rounded-circle"><i class="fas fa-trophy" style="font-size:18px; color:red"></i></li>
         </ul>
        </div>
    <img src="storage/image/cover.jpg" class="w-100 rounded-top border border border-bottom-0" style="height:330px;">
    </div>
    <div class="row px-2">
    <div class="col-md-12 border rounded-bottom p-0">
      <div class="col-md-5 p-0 mr-auto float-left">
         <ul class="stat-ul black ml-4">
            <li class=""><p>Earned</p><span>1000</span><p>Points</p></li>
            <li><p>Earned</p><span>1000</span><p>Points</p></li>
            
         </ul>
      <img src="storage/image/cover.jpg" class="rounded-circle p-1 black-shadow position-absolute profile-img">
      <ul class="stat-ul stat-ul2">
            <li><p>Earned</p><span>1000</span><p>Points</p></li>
            <li><p>Earned</p><span>1000</span><p>Points</p></li>
            
         </ul>
     <h5 class="text-center mt-4 mb-2">{{$user->username}}</h5>
     
      </div>
      <div class="col-md-7 ml-auto float-right p-0">
      <nav class="navbar border-bottom-0 navbar-expand-lg navbar-white p-0">
  <div class="container p-0">
    

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-nav1 ml-auto">
        <li class="nav-item active pl-0 pr-3">
          <a class="nav-link color-muted" href="#">Browse
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link color-muted" href="#">About</a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link color-muted" href="#">Services</a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link color-muted" href="#">Contact</a>
        </li>
      </ul>
     
    </div>
  </div>
</nav>
        
      </ul>
      </div>
      </div>
    </div>
</div>
  <!--CONTAINER-->
<div class="container">
<div class="row mt-0">
    
    <div class="col-md-9 p-0">
    
        <div class="col-md-12  mt-5">
        
            <div class="row p-2 transform1 border-top border-bottom mb-0">
                <div class="col-md-6 p-0">
                    <h5 class="mb-0 mt text-muted">Questions By {{$user->username}}</h5>
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
          <a class="nav-link px-5 text-muted" href="{{Request::url()}}?sort=unanswered">Unanswered
            <span class="sr-only">(current)</span>
          </a>
        </li>
       
      </ul>
      </nav>
     
   
    


                </div>
            
            </div>
        
            <?php   
              $question = Question::where('user_id', $user->id)->get();
              
            //$question = Question:where('users_id',GEtUSERID);
            ?>
          
        @if(count($question))
          @foreach($question as $q)     
            @include('inc.question.question-box')
          @endforeach
       @endif
        </div>
    </div>
        @include('inc.question.right')
    </div>
</div>






     
@endsection