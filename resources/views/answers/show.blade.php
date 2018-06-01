<?php use App\Vote; ?>
<div class="row p-2 border-bottom border-top mt-5 transform1">
    <div class="col-md-12">
        <h5 class="mb-0 text-muted">{{$sum}} {{$sum == 1 ? 'ANSWER' : 'ANSWERS'}}</h5>
        <ul>
            <li><a href="{{Request::url()}}?sort=votes">Votes</a></li>
            <li><a href="{{Request::url()}}?sort=recent">Recent</a></li>
        </ul>
    </div>
</div>
<!--answer BOX-->
<?php $c=0;

?>
@foreach($answers as $ans)
<?php  $c++;

//GETS THE USERS VOTE FOR THE ANSWER TO SHOW ON THE ARROWS
if(!Auth::guest()){
    $av= $ans->votes($ans->answer_id,Auth::user()->id);
    
}?>        
<div class="row p-2  border-bottom">
    @if(!Auth::guest() && Auth::user()->id ==$question->user_id)
        @if($ans->correct_id)
            <!-- ADD A CLASS PER MIA NDRRU NGJYREN  QE ME TREGU QE E KA SELEKTU QITA -->
            <a href="#" id="{{'correct'.$c}}" class="correct-color"><div class="stats  stats-full-post bg-light ml-2 p-1 w-10 mr-2 ml-auto" >
                <p class="w-100 m-auto text-center h-100"><i class="fas fa-check m-auto text-center h-100"></i></p>
            </div></a>
        @else

            <a href="#"  id="{{'correct'.$c}}"><div class="stats  stats-full-post bg-light ml-2 p-1 w-10 mr-2 ml-auto">
            <p class="w-100 m-auto text-center h-100"><i class="fas fa-check m-auto text-center h-100"></i></p>
            </div></a>
        @endif
    @elseif($ans->correct_id)
        <!-- NESE OSHT ANSWER E SAKT EDHE NUK ESHTE AUTHORI I PYTJES ME QIT TIKUN (QITJA EDHE KSAJ 1 KLAS)  shko edhe te 105 ngjitja 1 klas me JQUERY -->
        <div class="stats  stats-full-post bg-light ml-2 p-1 w-10 mr-2 ml-auto" id="{{'correct'.$c}}">
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
        <img src="/storage/image/photo.jpg" class="rounded m-auto">
    </div>

    <div class="q-content ml-2 p-2 border">
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
    <!--COMMENTS-->
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
    <!--/.COMMENTS-->


</div>
<script src="{{asset ('js/vote.js')}}" type="text/javascript" charset="utf-8"></script>

<script>                 
    var a_total = "#a_total<?php echo $c?>";
    var a_vote =".a_vote<?php echo $c?>";
    var a_up = "#upvote<?php echo $c?>";
    var a_down = "#downvote<?php echo $c?>"; 
    voteAjax({!! json_encode($ans->answer_id) !!},{!! json_encode(Auth::check()) !!},1,a_total,a_vote,a_up,a_down);
</script>
<script>
    $(document).ready(function(){
        
        var correct = "#correct<?php echo $c?>";
        //alert(correct);
        //alert(correct); 
        $(correct).click(function() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
           
            var id = {!! json_encode($ans->answer_id) !!};
            var q_id = {!! json_encode($question->question_id) !!};
           // alert(1);
            $.ajax({

                url: '/correct',
                type: 'POST',
                data: {_token: CSRF_TOKEN,vote:$(correct).text(),id : id,q_id :q_id},
                dataType: 'JSON',

                success: function (data) {
                
                   
                   if(data['status']=='removed'){
                  
                    $(correct).removeClass("correct-color"); //Shtoja 1 klas me ba ma ndryshe ngjyren ! se spo di !
                   }else{
                    
                    $(correct).addClass("correct-color"); //Shtoja 1 klas me ba ma ndryshe ngjyren ! se spo di !
                   }
                    
                },
                erro: function(){
                    alert(0);
                }
            });         
        });
    
    });
</script>
@endforeach