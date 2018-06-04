@extends('layouts.app')

@section('content')

      

<div class="container p-0">
  <div class="row mt-0">
    <div class="col-md-9 p-0">
      <div class="col-md-12  mt-5">     
        <div class="row p-2 transform1 border-top border-bottom mb-0">
		<div class="col-md-4">
			<h5 class="mb-0 mt ml-0 text-muted">Users</h5>
		</div>
		<div class="col-md-3">
		
             <div class="input-group input-group-sm mySearch mySearch1 mr-4 border-0 w-100 rounded float-left">


{!! Form::open(['id'=>'form','action' => 'ProfileController@specificUsers', 'method'=> 'POST','style'=>'display:inherit']) !!}
{{Form::text('input','',['id'=>"search1",'class' => 'form-control text-light px-2 bg-light border  search1','aria-label'=>"Small", 'aria-describedby'=>"inputGroup-sizing-sm",'placeholder' => 'Search...'])}}
<div class="input-group-append">

{{Form::button('<i class="fas fa-search"></i>',['type' => 'submit', 'class'=>'btn btn-light border px-3'])}}

{!! Form::close() !!} 
</div>
</div>
              <ul id="results" style="z-index:10000 !important;" class="position-absolute bg-light border px-2"></ul>                       
           
		</div>
          <div class="col-md-5">
            
           <nav class="navbar navbar3 sort-nav navbar-expand-lg navbar-white float-right p-0 mt-1">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted" href="{{Request::url()}}?sort=name">Name
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
                 <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted" href="{{Request::url()}}?sort=popular">Popular
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
		  
        </div>
        <div class="row p-0 border-bottom courses">
          @foreach($users as $u) 
            @include('inc.user-box')    
          @endforeach
        </div>
        {{$users->links()}}
      </div>
    </div>
    @include('inc.question.right')
  </div>
</div>

     

                          
                           
                           
                          
                              
<script type="text/javascript">
jQuery.fn.extend({
  live: function (event, callback) {
    if (this.selector) {
     jQuery(document).on(event, this.selector, callback);
    }
  }
});
                                
  // Search  
$(document).ready(function() {  
  // Icon Click Focus
  $('div.icon').click(function(){
    $('#search1').focus();
  });

  function search() {
  var query_value = $('#search1').val();
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

  //$('b#search-string').text(query_value);
  //alert( $('#searchuser').val());
  if(query_value !== ''){
    $.ajax({
      type: "POST",
      url: "/searchUsers",
      data: { _token: CSRF_TOKEN,query_value: query_value}, 

      success: function(data){

        if(data.status=='nothing'){
            // nese nuk ka pas results
            $('#results').empty();
            $('#results').append("No user found");
        }
        else{

          //fshin results e kalume 
          $('#results').empty();
          $.each(data.user, function(index) {
            //Iterate through the results of the query dhe perdor index si key per ti qasur te dhenave [index].id [index].username
            $('#results').append("<li class='py-1'><a href='profile/" +data.user[index].id+ "'>" + data.user[index].username+ "</a></li>");
          });
        }
      }
    });
  }return false;    
}
  $("#search1").live("keyup", function(e) {
    // Set Timeout
    // alert($(this).val())
    clearTimeout($.data(this, 'timer'));
    // Set Search String
    var search_string = $(this).val();
    // Do Search
    if (search_string == '') {
      $("ul#results").fadeOut();
      $('h4#results-text').fadeOut();
    }else{
      $("ul#results").fadeIn();
      $('h4#results-text').fadeIn();
      $(this).data('timer', setTimeout(search, 100));
    };
  });
});
</script>
                   
                            
@endsection()