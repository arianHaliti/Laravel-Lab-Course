@extends('layouts.app')

@section('content')

<div class="container p-0 mt-3">
        <div class="row mt-0">
            
            <div class="col-md-2 border-right p-0 bg-light">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active pl-0 py-0 border-bottom"><a href="#" class="nav-link py-2"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>  
            <li class="nav-item active pl-0 py-0 border-bottom"><a href="#" class="nav-link py-2">Users</a></li>  
            <li class="nav-item active pl-0 py-0 border-bottom"><a href="#" class="nav-link py-2">Questions</a></li>  
            <li class="nav-item active pl-0 py-0 border-bottom"><a href="#" class="nav-link py-2">Answers</a></li>  
            <li class="nav-item active pl-0 py-0 border-bottom"><a href="#" class="nav-link py-2">Reports</a></li>  
            <li class="nav-item active pl-0 py-0 border-bottom"><a href="#" class="nav-link py-2">Roles and Permissions</a></li>  
            <li class="nav-item active pl-0 py-0 border-bottom"><a href="#" class="nav-link py-2">Settings</a></li>  
                    
                   

                </ul>

        </div>

        <div class="col-md-10 mt-3 ">
            <div class="container">
            
<div class="row border px-0 py-0 mt-0">
    <div class="col-md-12 p-2  border-top border-bottom mb-0 mt-2">
                <div class="row">
                        <div class="col-md-6 p-0">
                            <h5 class="mb-0 mt ml-3 text-muted">Questions</h5>
                        </div>
                        <div class="col-md-6">
                            
         
            
    
            
           <nav class="navbar navbar3 sort-nav navbar-expand-lg navbar-white float-right p-0">
              <ul class="navbar-nav mr-auto">
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
       <th>Q_Id</th>
       <th>U_ID</th>
       <th>Title</th>
       <th>Desc</th>
       <th>Views</th>
       <th>Created</th>
       <th>Updated</th>
       <th>Edit</th>
       <th>Active</th>
</tr>
<tr>
       <td>12</td>
       <td>1</td>
       <td>What is Java?</td>
       <td>I have a problem i dont know what java is, can somebody explain to me</td>
       <td>10000</td>
       <td>12/02/2018</td>
       <td>12/03/2018</td>
       <td>Edit</td>
       <td>Delete</td>
</tr>
<tr>
      <td>12</td>
       <td>1</td>
       <td>What is Java?</td>
       <td>I have a problem i dont know what java is, can somebody explain to me</td>
       <td>10000</td>
       <td>12/02/2018</td>
       <td>12/03/2018</td>
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