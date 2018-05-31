@extends('layouts.app')

@section('content')
<?php use App\User;
  $users = User::all();
?>

      

<div class="container p-0">
  <div class="row mt-0">
    <div class="col-md-9 p-0">
      <div class="col-md-12  mt-5">     
        <div class="row p-2 transform1 border-top border-bottom mb-0">
          <div class="col-md-6">
            <div class="row">Search
              <div class="col-md-2">
                <div class="icon"></div>
              </div>
              <div class="col-md-10">
                <input type="text" id="searchuser" autocomplete="off" class="form-control text-light px-3 bg-secondary border-0" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
              </div>
              <ul id="results"></ul>                       
            </div>
           <nav class="navbar navbar3 sort-nav navbar-expand-lg navbar-white float-right p-0">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted" href="#">Name
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
                 <li class="nav-item active pl-0">
                  <a class="nav-link px-5 text-muted" href="#">Popular
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
    $('#searchuser').focus();
  });

  function search() {
  var query_value = $('#searchuser').val();
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
            $('#results').append("<li><a href='profile/" +data.user[index].id+ "'>" + data.user[index].username+ "</a></li>");
          });
        }
      }
    });
  }return false;    
}
  $("#searchuser").live("keyup", function(e) {
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