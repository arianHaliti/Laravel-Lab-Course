
<?php 

use App\Question; 
use App\Followers;
?>
@extends('layouts.app')

@section('content')
<?php 

  if(!Auth::guest()){
    $follow = Followers::where('follower_id','=',$user->id)
      ->where('user_id','=',auth()->user()->id)
      ->get()
      ->first();
  }
  $answerd = $user->answerd($user->id);
  $answers_count = count($answerd);
  $asked = $user->asked($user->id);
  $asked_count = count($asked);

  $sumA =$user->answerVotes($user->id);
    //Referes at User Model function votes 
  $sumQ =$user->votes($user->id);

  $sumVotes = $sumA[0]->summ +$sumQ[0]->summ;

?>

<div class="container mt-0 pt-1 px-0 mt-5">
    
    <div class="row px-0 mt-0 border-bottom">
    <div class="col-md-12  border-bottom mt-0  p-0">
	 <div class="row px-0 mt-0">
		<div class="col-md-7">
		  <div class="row">
			<div class="col-md-4 p-0">
		<ul class="stat-ul black ml-0 float-right mt-5 mb-0">
            <li class="float-left"><p>Asked</p><span>{{$asked_count}}</span><p>Questions</p></li>
            <li class="float-left"><p>Answered</p><span>{{$answers_count}}</span><p>Questions</p></li>
            
         </ul>
		 </div>

		 <div class="col-md-2 p-0">
         
      <img src="/storage/user_logos/{{$user->image}}" class="rounded-circle p-2 profile-img border border-primary">
	  
		</div>
		
		<div class="col-md-4 p-0 z-indexnegative">
      <ul class="stat-ul stat-ul2 ml-0 pl-0 float-left mt-5 mb-0">
            <li class="float-left"><p>Made</p><span>10001</span><p>Tuts</p></li>
            <li class="float-left"><p>Earned</p><span>{{$sumVotes}}</span><p>Points</p></li>
            
         </ul>
		 </div>
		</div>
		</div>
		<div class="col-md-5">
		@guest
      <button type="button" onclick="location.href='/login'" class="btn transform1 btn-sm mr-3  btn-outline-primary w-50 cr-button bg-light follow-btn float-right text-light">Follow</button>
    @else 
      @if(auth()->user()->id==$user->id)
        <a href="{{Auth::user()->id}}/edit"><button type="button" id="follow" class="btn transform1 btn-sm btn-outline-primary mr-3  w-50 cr-button bg-light follow-btn float-right text-light">Edit Profile</button></a>
      @elseif(count($follow)==0)   
       <button type="button" id="follow" class="btn transform1 btn-sm  btn-outline-primary mr-3  w-50 cr-button bg-light follow-btn float-right text-light">Follow</button>
      @else
        <button type="button" id="follow" class="btn transform1 btn-sm  btn-outline-primary mr-3 w-50 cr-button bg-light  text-light follow-btn float-right">Following</button>
      @endif
    @endguest
		
		</div>
	 </div>
	 </div>
	 <div class="col-md-12 bg-light border-left border-right">
      <div class="col-md-5 p-0 mr-auto float-left">
         

     <h5 class="text-center mt-4 mb-2 transform1">{{$user->username}}</h5>
    
    
      </div>
      <div class="col-md-7 ml-auto float-right p-0 transform1">
      <nav class="navbar border-bottom-0 navbar-expand-lg navbar-white p-0">
  <div class="container p-0">
    

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-nav1 ml-auto">
        <li class="nav-item active pl-0">
          <a class="nav-link " href="#">Browse
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link " href="#">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/contact">Contact</a>
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
<div class="container p-0">
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
              $question = Question::where('user_id', $user->id)->where('question_active','=',0)->get();
              $data['cate']=0;
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

<script>
    $(document).ready(function(){
        
        
        //alert(correct);
        //alert(correct); 
        $("#follow").click(function() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
           
            
            var follower_id = {!! json_encode($user->id) !!};
           //alert(follower_id);
           // alert(1);
            $.ajax({

                url: '/follow',
                type: 'POST',
                data: {_token: CSRF_TOKEN,vote:$('#follow').text(),follower_id:follower_id},
                dataType: 'JSON',

                success: function (data) {
                
                  
                   if(data['status']=='removed'){

                    $('#follow').html('Follow'); //Shtoja 1 klas me ba ma ndryshe ngjyren ! se spo di !
                   }else{
                    $('#follow').html('Following');
                  
                    //$(correct).addClass("correct-color"); //Shtoja 1 klas me ba ma ndryshe ngjyren ! se spo di !
                   }
                    
                },
                erro: function(){
                    alert(0);
                }
            });         
        });
    
    });
</script>




     
@endsection