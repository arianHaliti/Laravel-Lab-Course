<?php 
use App\Notification;
use App\Question;
use App\Answer;
use App\User;
use App\Vote;
?>
@include('inc.functions')
<nav class="navbar main-nav navbar-expand-lg bg-dark fixed-top py-0">
  <div class="container">
    <a class="navbar-brand" href="/"><img src="/storage/image/logo1.png" id="logo"></a>

<div class="input-group input-group-sm mySearch border-0 rounded">

<input type="text" placeholder="Search..." id="search" class="form-control text-light px-3 bg-secondary border-0" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
<div class="input-group-append">
<button class="btn btn-secondary border-0 px-3" type="button"><i class="fas fa-search"></i></button>
</div>
</div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse navbar1">
      <ul class="navbar-nav bd-navbar-nav flex-row ml-auto mr-4">


       

               

        
          @guest
          <li><a class="nav-link" href="/questions"><i class="fas fa-globe"></i> Browse</a></li>
          <li class="nav-item dropdown">
                  
            <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <i class="fas fa-question-circle"></i>
            </a>

            <div class="dropdown-menu dropdown-menu1 dropdown-menu-right" aria-labelledby="navbarDropdown">
               <!--NOTIFY-BOX-->
 <a class="nav-link border-bottom py-2" style="color:black !important;" href="/about">
  <div class="container">
  <div class="row p-0">
      <div class="col-md-2 p-0">
          <h5 class=""><i class="fas fa-building text-muted ml-2"></i></h5>
        
      </div>
      <div class="mb-0 col-md-10 p-0 notify-box">
      <p class=" mb-0 f-12 ml-1 text-muted border-bottom">About Us</p>
     
      <p class=" f-14 ml-1 l-h mb-1 mt-1">Learn more about us DCircle Company</p>
     
      </div>
  </div>
  
</div>
</a>

<!--/.NOTIFY-BOX-->

<!--NOTIFY-BOX-->
<a class="nav-link border-bottom py-2" style="color:black !important;" href="/team">
  <div class="container">
  <div class="row p-0">
      <div class="col-md-2 p-0">
          <h5 class=""><i class="fas fa-users text-muted ml-1"></i></h5>
        
      </div>
      <div class="mb-0 col-md-10 p-0 notify-box">
      <p class=" mb-0 f-12 ml-1 text-muted border-bottom">Our Team</p>
     
      <p class=" f-14 ml-1 l-h mb-1 mt-1">See the team we are working with</p>
     
      </div>
  </div>
  
</div>
</a>

<!--/.NOTIFY-BOX-->

<!--NOTIFY-BOX-->
<a class="nav-link border-bottom py-2" style="color:black !important;" href="/team">
  <div class="container">
  <div class="row p-0">
      <div class="col-md-2 p-0">
          <h5 class=""><i class="fas fa-map-signs text-muted ml-1"></i></h5>
        
      </div>
      <div class="mb-0 col-md-10 p-0 notify-box">
      <p class=" mb-0 f-12 ml-1 text-muted border-bottom">Tour</p>
     
      <p class=" f-14 ml-1 l-h mb-1 mt-1">Start here for a quick overview about the site</p>
     
      </div>
  </div>
  
</div>
</a>

<!--/.NOTIFY-BOX-->

<!--NOTIFY-BOX-->
<a class="nav-link border-bottom py-2" style="color:black !important;" href="/team">
  <div class="container">
  <div class="row p-0">
      <div class="col-md-2 p-0">
          <h5 class=""><i class="fas fa-hands-helping text-muted ml-1"></i></h5>
        
      </div>
      <div class="mb-0 col-md-10 p-0 notify-box">
      <p class=" mb-0 f-12 ml-1 text-muted border-bottom">Help Center</p>
     
      <p class=" f-14 ml-1 l-h mb-1 mt-1">Detailed answers to any questions you might have</p>
     
      </div>
  </div>
  
</div>
</a>

<!--/.NOTIFY-BOX-->
            </div>
        </li>
              <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
              <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
              
          @else
          <li><a class="nav-link" href="/"><i class="fas fa-home"></i> Home</a></li>
          <?php
            $notes = Notification::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();

            $notRead =Notification::where('user_id',Auth::user()->id)
            ->where('read',0)->count();
          ?>
          <li id = 'note' class="nav-item dropdown">
                  
            <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              <i id="notes" class="fas fa-inbox"></i>
              <span id="note_count" class="f-12">{{$notRead==0 ?"":$notRead}}</span> 
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <div class="col-md-12 bg-light border-top border-bottom px-2">
                    <p class="mb-1 mt-1 text-muted"><i class="fas fa-inbox mr-2"></i>Inbox</p>
                </div>
           
               
                @foreach($notes as $n)
                    
                <?php 
                    if($n->note_type ==0){
                        $answer = Answer::find($n->note_id);
                        $user_id =$answer->user_id;
                        $user = User::find($user_id);
                        $question= Question::find($answer->question_id);  
                    }else if($n->note_type==1) {
                        $vote = Vote::find($n->note_id);
                        if($vote->content_type ==0){
                           $content = Question::find($vote->content_id);
                           $content_title = $content->question_title;
                           $content_desc = $content->question_desc;
                           $id = $content->question_id;
                        }
                        else{
                            $content = Answer::find($vote->content_id);
                           $content_title = $content->answer_title;
                           $content_desc = $content->answer_desc;
                           $id = $content->question_id;
                        }

                    }
                    else{

                    }
                ?>
                @if($n->note_type==0)
                <a class="nav-link border-bottom py-2" style="color:black !important;" href="/questions/{{$question->question_id}}">
                  <div class="container">
                  <div class="row p-0">
                      <div class="col-md-1 p-0">
                         <img src="/storage/user_logos/cover.jpg" class="sm-pic rounded-circle">
                        
                      </div>
                      <div class="mb-0 col-md-11 p-0 notify-box">
                      <p class=" mb-0 f-12 ml-1 text-muted border-bottom">{{$user->username}} answered your question   {{$n->read == 0 ? '   //  //not seen': ' //  //seen'}}</p>
                      <p class="f-14 ml-1 mt-2 text-primary l-h mb-1">{{$question->question_title}} </p>
                      <p class="mb-0 f-14 ml-1 l-h">{{strip_tags($answer->answer_desc)}}</p>
                      <p class="mb-0 f-14 ml-1 l-h mt-1 text-muted f-12">{{time_since(time()-strtotime($n->created_at)).' ago'}}</p>
                      </div>
                  </div>
                  
                </div>
                </a>
                @elseif($n->note_type==1)
                
              
               
                 <a class="nav-link border-bottom py-2" style="color:black !important;" href="/questions/{{$id}}">
                  <div class="container">
                  <div class="row p-0">
                      <div class="col-md-1 p-0">
                        @if($vote->vote_type==1)
                          <h5 class=""><i class="fas fa-caret-up ml-1 text-primary"></i></h5>
                        @else
                        <h5 class=""><i class="fas fa-caret-down ml-1 text-muted"></i></h5>
                        @endif
                      </div>
                      <div class="mb-0 col-md-11 p-0 notify-box">
                    @if($vote->vote_type==1)
                      <p class=" mb-0 f-12 ml-1 text-muted border-bottom">You earned <span class="text-success font-weight-bold">+1</span> vote  on Your Question {{$n->read == 0 ? '   //  //not seen': ' //  //seen'}}</p>
                    @else
                    <p class=" mb-0 f-12 ml-1 text-muted border-bottom">You earned <span class="text-danger font-weight-bold">-1</span> vote  on Your Answer {{$n->read == 0 ? '   //  //not seen': ' //  //seen'}}</p>
                    @endif

                      <p class="f-14 ml-1 mt-2 text-primary l-h mb-1">{{$content_title}} </p>
                      <p class="mb-0 f-14 ml-1 l-h">{{strip_tags($content_desc)}}</p>
                      <p class="mb-0 f-14 ml-1 l-h mt-1 text-muted f-12">{{time_since(time()-strtotime($n->created_at)).' ago'}}</p>
                      </div>
                  </div>
                  
                </div>
                </a>
                @endif
                @endforeach
  <!--
                <a class="nav-link border-bottom py-2" style="color:black !important;" href="/team">
                  <div class="container">
                  <div class="row p-0">
                      <div class="col-md-1 p-0">
                         <img src="/storage/image/cover.jpg" class="sm-pic rounded-circle">
                        
                      </div>
                      <div class="mb-0 col-md-11 p-0 notify-box">
                      <p class=" mb-0 f-12 ml-1 text-muted border-bottom">Yllzon commented on your post</p>
                      <p class="f-14 ml-1 mt-2 text-primary l-h mb-1">What is PHP? </p>
                      <p class="mb-0 f-14 ml-1 l-h">Php is a programming language that is used to make web applications</p>
                      <p class="mb-0 f-14 ml-1 l-h mt-1 text-muted f-12">May 25 at 23:11</p>
                      </div>
                  </div>
                  
                </div>
                </a>
            
   
                 <a class="nav-link border-bottom py-2" style="color:black !important;" href="/team">
                  <div class="container">
                  <div class="row p-0">
                      <div class="col-md-1 p-0">
                          <h5 class=""><i class="fas fa-caret-down ml-1 text-muted"></i></h5>
                        
                      </div>
                      <div class="mb-0 col-md-11 p-0 notify-box">
                      <p class=" mb-0 f-12 ml-1 text-muted border-bottom">You earned <span class="text-danger font-weight-bold">-1</span> vote</p>
                      <p class="f-14 ml-1 mt-2 text-primary l-h mb-1">What is PHP? </p>
                      <p class="mb-0 f-14 ml-1 l-h">Php is a programming language that is used to make web applications</p>
                      <p class="mb-0 f-14 ml-1 l-h mt-1 text-muted f-12">May 25 at 23:11</p>
                      </div>
                  </div>
                  
                </div>
                </a>
 
              
                 <a class="nav-link border-bottom py-2" style="color:black !important;" href="/team">
                  <div class="container">
                  <div class="row p-0">
                      <div class="col-md-1 p-0">
                          <h5 class=""><i class="fas fa-caret-down ml-1 text-muted"></i></h5>
                        
                      </div>
                      <div class="mb-0 col-md-11 p-0 notify-box">
                      <p class=" mb-0 f-12 ml-1 text-muted border-bottom">You earned <span class="text-danger font-weight-bold">-1</span> vote</p>
                      <p class="f-14 ml-1 mt-2 text-primary l-h mb-1">What is PHP? </p>
                      <p class="mb-0 f-14 ml-1 l-h">Php is a programming language that is used to make web applications</p>
                      <p class="mb-0 f-14 ml-1 l-h mt-1 text-muted f-12">May 25 at 23:11</p>
                      </div>
                  </div>
                  
                </div>
                </a>

             
                  <a class="nav-link border-bottom py-2" style="color:black !important;" href="/team">
                    <div class="container">
                    <div class="row p-0">
                        <div class="col-md-1 p-0">
                            <h5 class=""><i class="fas fa-envelope  text-muted"></i></h5>
                          
                        </div>
                        <div class="mb-0 col-md-11 p-0 notify-box">
                        <p class=" mb-0 f-12 ml-1 text-muted border-bottom">Yllzon sent you a message</p>
                        <p class="f-14 ml-1 mt-2 text-primary l-h mb-1">Hi my friend</p>
                        <p class="mb-0 f-14 ml-1 l-h">Hi, how you doing? can I ask you something</p>
                        <p class="mb-0 f-14 ml-1 l-h mt-1 text-muted f-12">May 25 at 23:11</p>
                        </div>
                    </div>
                    
                  </div>
                  </a>
            
                -->

                <a class="nav-link text-dark border-bottom text-center f-14 py-1 bg-light" href="/about">
                  See more
                </a>
            </div>
        </li>


        <li class="nav-item dropdown">
                  
          <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <i class="fas fa-trophy"></i>
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <div class="col-md-12 bg-light border-top border-bottom px-2">
                  <p class="mb-1 mt-1 text-muted"> <i class="fas fa-trophy mr-2"></i>Trophies cabinet</p>
              </div>
            <!--NOTIFY-BOX-->
              <a class="nav-link border-bottom py-2" style="color:black !important;" href="/team">
                <div class="container">
                <div class="row p-0">
                    <div class="col-md-1 p-0">
                        <i class="fas fa-trophy ml-1 text-warning"></i>
                      
                    </div>
                    <div class="mb-0 col-md-11 p-0 notify-box">
                    <p class=" mb-0 f-12 ml-1 text-muted border-bottom">You earned a yellow trophy</p>
                   
                    <p class="mb-0 f-14 ml-1 l-h mt-2">Yellow trophy is earned when you have more than 10k points, so you made it.</p>
                    <p class="mb-0 f-14 ml-1 l-h mt-1 text-muted f-12">May 25 at 23:11</p>
                    </div>
                </div>
                
              </div>
              </a>

              <!--/.NOTIFY-BOX-->
          </div>
      </li>

      
       
          
          <li class="nav-item dropdown">
                  
            <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <i class="fas fa-question-circle"></i>
            </a>


            <div class="dropdown-menu dropdown-menu1 dropdown-menu-right" aria-labelledby="navbarDropdown">

 <!--NOTIFY-BOX-->
 <a class="nav-link border-bottom py-2" style="color:black !important;" href="/about">
  <div class="container">
  <div class="row p-0">
      <div class="col-md-2 p-0">
          <h5 class=""><i class="fas fa-building text-muted ml-2"></i></h5>
        
      </div>
      <div class="mb-0 col-md-10 p-0 notify-box">
      <p class=" mb-0 f-12 ml-1 text-muted border-bottom">About Us</p>
     
      <p class=" f-14 ml-1 l-h mb-1 mt-1">Learn more about us DCircle Company</p>
     
      </div>
  </div>
  
</div>
</a>

<!--/.NOTIFY-BOX-->

<!--NOTIFY-BOX-->
<a class="nav-link border-bottom py-2" style="color:black !important;" href="/team">
  <div class="container">
  <div class="row p-0">
      <div class="col-md-2 p-0">
          <h5 class=""><i class="fas fa-users text-muted ml-1"></i></h5>
        
      </div>
      <div class="mb-0 col-md-10 p-0 notify-box">
      <p class=" mb-0 f-12 ml-1 text-muted border-bottom">Our Team</p>
     
      <p class=" f-14 ml-1 l-h mb-1 mt-1">See the team we are working with</p>
     
      </div>
  </div>
  
</div>
</a>

<!--/.NOTIFY-BOX-->

<!--NOTIFY-BOX-->
<a class="nav-link border-bottom py-2" style="color:black !important;" href="/team">
  <div class="container">
  <div class="row p-0">
      <div class="col-md-2 p-0">
          <h5 class=""><i class="fas fa-map-signs text-muted ml-1"></i></h5>
        
      </div>
      <div class="mb-0 col-md-10 p-0 notify-box">
      <p class=" mb-0 f-12 ml-1 text-muted border-bottom">Tour</p>
     
      <p class=" f-14 ml-1 l-h mb-1 mt-1">Start here for a quick overview about the site</p>
     
      </div>
  </div>
  
</div>
</a>

<!--/.NOTIFY-BOX-->

<!--NOTIFY-BOX-->
<a class="nav-link border-bottom py-2" style="color:black !important;" href="/team">
  <div class="container">
  <div class="row p-0">
      <div class="col-md-2 p-0">
          <h5 class=""><i class="fas fa-hands-helping text-muted ml-1"></i></h5>
        
      </div>
      <div class="mb-0 col-md-10 p-0 notify-box">
      <p class=" mb-0 f-12 ml-1 text-muted border-bottom">Help Center</p>
     
      <p class=" f-14 ml-1 l-h mb-1 mt-1">Detailed answers to any questions you might have</p>
     
      </div>
  </div>
  
</div>
</a>

<!--/.NOTIFY-BOX-->

               
            </div>
        </li>
              <li class="nav-item dropdown profile-nav-li">
                  
                  <a id="navbarDropdown" class="nav-link dropdown-toggle profile-nav-li" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                   <img src="/storage/user_logos/{{Auth::user()->image}}" class="profile-sm-img rounded-circle mr-1 border">   {{ Auth::user()->name }} 
                  </a>

                  <div class="dropdown-menu dropdown-menu2 dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="nav-link text-dark border-bottom p-3 px-3" href="/profile/{{Auth::user()->id}}">
                        <p class="mb-0">{{Auth::user()->name.' '.Auth::user()->surname}}</p>
                        <p class="mb-0 f-14 text-muted">{{'@'.Auth::user()->username}}</p>
                      </a>

                      <a class="nav-link text-dark border-bottom p-1 px-3 f-14" href="/home">Dashboard
                       
                      </a>

                      <a class="nav-link text-dark border-bottom p-1 px-3 f-14" href="/profile/{{Auth::user()->id}}">Profile
                        <span class="sr-only">(current)</span>
                      </a>
                      <a class="nav-link text-dark border-bottom p-1 px-3 f-14" href="/questions/create">Ask a Question
                        <span class="sr-only">(current)</span>
                      </a>
                      <a class="nav-link text-dark border-bottom p-1 px-3 f-14" href="/profile/{{Auth::user()->id}}/edit">Settings                        <span class="sr-only">(current)</span>
                      </a>
                      <a class="dropdown-item text-dark border-bottom p-1 px-3 f-14" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </div>
              </li>
              
          @endguest
          
      </ul>
  
  
    </div>



  </div>
</nav>
<!-- /HEADER -->
<div class="container p-0 transform1">

<nav class="navbar navbar-expand-lg navbar-white border-top myNav z">

  <div class="container p-0">
      

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse navbar3" id="navbarResponsive">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active pl-0">
          <a class="nav-link px-5" href="/questions"><i class="fas fa-question-circle"></i> Questions
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-5" href="/courses"><i class="fas fa-graduation-cap"></i> Tutorials</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-5" href="/user"><i class="fas fa-user"></i> Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-5" href="/tag"><i class="fas fa-tag"></i> Tags</a>
        </li>
      </ul>
 
    </div>
<div class="btn-group small-navbar">
<button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Large button
</button>
<div class="dropdown-menu">
...
</div>
</div>

  </div>
</nav>
</div>

<script>
    $( "#note" ).click(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
           
           
           // alert(1);
            $.ajax({

                url: '/notification',
                type: 'POST',
                data: {_token: CSRF_TOKEN,vote:$("#note").text()},
                dataType: 'JSON',

                success: function (data) {
                    $("#note_count").html("");
                },
                erro: function(){
                    alert(0);
                }
            });       
    });
</script>