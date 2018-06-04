@extends('layouts.app')

@section('content')

<?php 
use App\Course;


 $courses= Course::orderBy('created_at')->paginate(10);


?>

<div class="container p-0 mt-0">
  <div class="row mt-0">
	<div class="col-md-1 mt-5">
		 <img src="/storage/image/cover.jpg" class="rounded-circle p-2 profile-img p-img3 border border-primary">
	</div>
	<div class="col-md-11 mt-5">
		<h5 class="mb-0">Yllzon Sejdiu <button class="btn btn-sm p-0 px-2 btn-outline-primary bg-light transform1">follow</button></h5>
		<p class="mb-0">Great programmer</p>
		<p class="mb-0">Created at 12/11/2017</p>
	</div>
  </div>
  <div class="row mt-0 border-top border-bottom mt-5">
	<div class="col-md-6 py-1  transform1 ">
	<h4>Learn Html</h4>
	</div>
	<div class="col-md-6 py-1 transform1 ">
	<ul class="float-right mt-1 mb-0 les-vid-ul">
	<li class="float-left mr-2">100 Lessons</li>
	<li class="float-left mr-2">/</li>
	<li class="float-left">10 Videos</li>
	
	</ul>
	</div>
  </div>
        <div class="row mt-0">
            
            <div class="lesons-links mt-5 border p-0 px-2 bg-light">
			<h5 class="border-bottom transform1 py-2">Lessons</h5>
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active pl-0 py-0 border-bottom"><a href="#" class="nav-link py-2">What is Html</a></li>  
            <li class="nav-item active pl-0 py-0 border-bottom"><a href="#" class="nav-link py-2">Html Intro</a></li>  
            <li class="nav-item active pl-0 py-0 border-bottom"><a href="#" class="nav-link py-2">Html tags</a></li>  
            <li class="nav-item active pl-0 py-0 border-bottom"><a href="#" class="nav-link py-2">Html class</a></li>  
                    
                   

                </ul>

        </div>

        <div class="p-2 q-content l-content mt-5 ml-3 mr-1">
       
				<h4 class="transform1 border-bottom pb-2">HTML Introduction</h4>
         
                            <p>The 'DOCTYPE html' declaration defines this document to be HTML5
The 'html' element is the root element of an HTML page
The 'head' element contains meta information about the document
The 'title' element specifies a title for the document
The 'body' element contains the visible page content
The 'h1>'element defines a large heading
The 'p' element defines a paragraph
</p>
        
                        
                        </div>
						
		
		@include('inc.question.right')
                    

        </div>

</div>
</div>
@endsection