@extends('layouts.app')

@section('content')

<div class="container p-0 mt-3">
        <div class="row mt-0">
            
          @include('admin.left')

        <div class="col-md-10 ">
        <ul class="links1 pl-0">
                    <li><a href="/admin" class="text-muted">Dashboard</a></li>
                    <li>/</li>
                    <li><a href="#" class="text-muted">Reports</a></li>
                    
                </ul>
            <div class="container">
            
<div class="row border px-0 py-0 mt-0">
    <div class="col-md-12 p-2  border-top border-bottom mb-0 mt-2">
                <div class="row">
                        <div class="col-md-5 p-0">
                            <h5 class="mb-0 mt ml-3 text-muted">User Reports</h5>
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
                  <a class="nav-link px-5 text-muted" href="#">A-Z
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
                
               
              </ul>
              </nav>
</div>
</div>
</div>

<table class="table mt-2">
   <tr>
       <th>U_reporting_Id</th>
       <th>U_reporting_name</th>
       <th>U_reported_Id</th>
       <th>U_reported_name</th>
       <th>Reason</th>
       <th>Created</th>
       <th>Edit</th>
       <th>Active</th>
</tr>
<tr>
       <td>11</td>
       <td>Yllzon</td>
       <td>2</td>
       <td>Arian</td>
      <td>He is not active at all</td>
       <td>12/02/2018</td>
       <td>Edit</td>
       <td>Delete</td>
</tr>
<tr>
<td>11</td>
       <td>Yllzon</td>
       <td>2</td>
       <td>Arian</td>
      <td>He is not active at all</td>
       <td>12/02/2018</td>
       <td>Edit</td>
       <td>Delete</td>
</tr>
  </table>
</div>
            </div>
                    
            
           
                            
        
                        
                        </div>
                    

        </div>

</div>
</div>

@endsection()