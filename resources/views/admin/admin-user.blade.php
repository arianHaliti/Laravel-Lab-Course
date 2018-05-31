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
                            <h5 class="mb-0 mt ml-3 text-muted">Users</h5>
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
       <th>Name</th>
       <th>Last Name</th>
       <th>Username</th>
       <th>Email</th>
       <th>Created</th>
       <th>Edit</th>
       <th>Active</th>
</tr>
<tr>
       <td>Yllzon Sejdiu</td>
       <td>Nice Page</td>
       <td>yllzon</td>
       <td>yllzon@gmail.com</td>
       <td>12/2/2018</td>
       <td>edit</td>
       <td>delete</td>
</tr>
<tr>
       <td>Yllzon Sejdiu</td>
       <td>Nice Page</td>
       <td>yllzon</td>
       <td>yllzon@gmail.com</td>
       <td>12/2/2018</td>
       <td>edit</td>
       <td>delete</td>
</tr>
  </table>
</div>
            </div>
                    
            
           
                            
        
                        
                        </div>
                    

        </div>

</div>
</div>

@endsection()