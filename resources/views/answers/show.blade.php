<?php use App\Vote; ?>

    <div class="row p-2 transform1 border-top border-bottom mb-0 mt-5">
                        <div class="col-md-6 p-0">
                            <h5 class="mb-0 mt text-muted">{{$sum}} {{$sum == 1 ? 'ANSWER' : 'ANSWERS'}}</h5>
                        </div>
                        <div class="col-md-6">
                            
         
            
    
            
           <nav class="navbar navbar3 sort-nav navbar-expand-lg navbar-white p-0 float-right">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted" href="{{Request::url()}}?sort=votes">Votes
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
                 <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted" href="{{Request::url()}}?sort=recent">Recent
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
               
               
              </ul>
              </nav>
             
           
            
        
        
                        </div>
                    
                     </div>
       
 
<!--answer BOX-->
<?php $c=0;

?>
@foreach($answers as $ans)
<?php  $c++;
$user_ans = $ans->createdBy($ans->answer_id)->first();
//GETS THE USERS VOTE FOR THE ANSWER TO SHOW ON THE ARROWS

if(!Auth::guest()){
    $av= $ans->votes($ans->answer_id,Auth::user()->id);
    
}?>    

<div class="row p-2  border-bottom">
<div class="stats  stats-full-post border-0 ml-2 p-1 w-10 mr-2 ml-auto" >
               
            </div>
    @if(!Auth::guest() && Auth::user()->id ==$question->user_id)
        @if($ans->correct_id)
            <!-- ADD A CLASS PER MIA NDRRU NGJYREN  QE ME TREGU QE E KA SELEKTU QITA -->
            <a href="#" id="{{'correct'.$c}}" onclick='correct("{{"#correct".$c}}",{{$ans->answer_id}})' ><div class="stats  stats-full-post bg-light ml-2 p-1 w-10 mr-2 ml-auto" >
                <p class="w-100 m-auto text-center h-100"><i class="fas fa-check m-auto text-center h-100" ></i></p>
            </div></a>
            
        @else

            <a href="#"  id="{{'correct'.$c}}"class="correct-color1" onclick='correct("{{"#correct".$c}}",{{$ans->answer_id}})'><div class="stats  stats-full-post bg-light ml-2 p-1 w-10 mr-2 ml-auto">
            <p class="w-100 m-auto text-center h-100"><i class="fas fa-check m-auto text-center h-100"></i></p>
            </div></a>
        @endif
    @elseif($ans->correct_id)
        <!-- NESE OSHT ANSWER E SAKT EDHE NUK ESHTE AUTHORI I PYTJES ME QIT TIKUN (QITJA EDHE KSAJ 1 KLAS)  shko edhe te 105 ngjitja 1 klas me JQUERY -->
        <div class="stats  stats-full-post bg-light ml-2 p-1 w-10 mr-2 ml-auto " id="{{'correct'.$c}}">
        <p class="w-100 m-auto text-center h-100"><i class="fas fa-check m-auto text-center h-100"></i></p>
        </div>
    @endif
    <div class="stats stats-full-post bg-light p-1 w-10 h-10 mr-2">

        @if(Auth::guest() || count($av)==0 || $av->vote_type ==0)
            <a id="{{'upvote'.$c}}" href="#"  class="float-left w-100 m-auto text-center up-do-arr {{'a_vote'.$c}}" name="up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>

            <a id="{{'downvote'.$c}}" href="#" class="float-left w-100 m-auto text-center up-do-arr {{'a_vote'.$c}}" name ="down" ><i class="fa fa-caret-down" aria-hidden="true"></i></a>
        @else
            @if($av ->vote_type==1)
                <a href="#" id="{{'upvote'.$c}}" class="float-left w-100 m-auto text-center up-do-arr {{'a_vote'.$c}} correct-color" name="up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>

                <a href="#" id="{{'downvote'.$c}}" class="float-left w-100 m-auto text-center up-do-arr {{'a_vote'.$c}}" name ="down" ><i class="fa fa-caret-down" aria-hidden="true"></i></a>
            @elseif ($av->vote_type==-1)
                <a href="#" id="{{'upvote'.$c}}" class="float-left w-100 m-auto text-center up-do-arr {{'a_vote'.$c}}" name="up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>

                <a href="#" id="{{'downvote'.$c}}" class="float-left w-100 m-auto text-center up-do-arr {{'a_vote'.$c}} correct-color" name ="down" ><i class="fa fa-caret-down" aria-hidden="true"></i></a>
            @endif
        @endif
      
      
        <p class="w-100 text-center m-auto float-left" id="{{'a_total'.$c}}" ></p>
    </div>
    <div class="stats bg-light p-1 w-10 rounded-circle">
        <img src="/storage/user_logos/{{$user_ans->image}}" class="rounded m-auto">
    </div>

    <div class="q-content a-content ml-2 p-2 border rounded">
    <div class="col-md-12 edit-del float-left">
                            <div class="float-right edit-del-nav">
        @if(!Auth::guest() && Auth::user()->id ==$ans->user_id)
    <a href= "/answers/{{$ans->answer_id}}/edit" class ="btn btn-outline-primary btn-sm edit-btn border-top-0">Edit</a>

    {!! Form::open(['action' => ['AnswerController@destroy' , $ans->answer_id] ,'method'=> 'POST']) !!}
        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('Delete',['class'=>'btn btn-outline-danger btn-sm  del-btn'])}}
    {!! Form::close() !!}
@endif
    </div>
</div>
        {!!$ans->answer_desc!!}
        
</div>
<div class="c-content ml-2 p-2 myBorder border border-top-0  ml-auto ">
    <!--COMMENTS
    <div class="c-content bg-light ml-2 p-2 myBorder border border-top-0  ml-auto">
    <img src="/storage/image/photo.jpg" class="rounded-circle ml-auto float-left mr-2">
    <p class="p-0 mb-0">
        first change</p>
        </div>
        <div class="c-content bg-light ml-2 p-2 myBorder border border-top-0 ml-auto">
    <img src="/storage/image/photo.jpg" class="rounded-circle ml-auto float-left mr-2">
    <p class="p-0 mb-0">
        Some other Comment</p>
        </div>
        <div class="c-content bg-light ml-2 p-2 myBorder border border-top-0 ml-auto">
    <img src="/storage/image/photo.jpg" class="rounded-circle ml-auto float-left mr-2">
    <p class="p-0 mb-0">
        You are rights.</p>
        </div>
    .COMMENTS-->
</div>


</div>
<script src="{{asset ('js/vote.js')}}" type="text/javascript" charset="utf-8"></script>

<script>                 
    var a_total = "#a_total<?php echo $c?>";
    var a_vote =".a_vote<?php echo $c?>";
    var a_up = "#upvote<?php echo $c?>";
    var a_down = "#downvote<?php echo $c?>"; 
    voteAjax({!! json_encode($ans->answer_id) !!},{!! json_encode(Auth::check()) !!},1,a_total,a_vote,a_up,a_down);
</script>
@endforeach
<script>
    function correct(correct,ans_id){
        
        //var correct = "#correct<?php echo $c?>";
        //alert(correct);
        //alert(correct); 
       
            
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
           
            var id = ans_id
            var q_id = {!! json_encode($question->question_id) !!};
           // alert(1);
            $.ajax({

                url: '/correct',
                type: 'POST',
                data: {_token: CSRF_TOKEN,vote:$(correct).text(),id : id,q_id :q_id},
                dataType: 'JSON',

                success: function (data) {
                
                   
                   if(data['status']=='removed'){
                    
                    
                    $(correct).addClass("correct-color1"); //Shtoja 1 klas me ba ma ndryshe ngjyren ! se spo di !
                   }else{
                    
                    $(correct).removeClass("correct-color1"); //Shtoja 1 klas me ba ma ndryshe ngjyren ! se spo di !
                   }
                    
                },
                erro: function(){
                    alert(0);
                }
            });         
       
    
    }
</script>
