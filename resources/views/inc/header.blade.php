<nav class="navbar main-nav navbar-expand-lg bg-dark fixed-top py-0">
  <div class="container">
    <a class="navbar-brand" href="/questions"><img src="/storage/image/logo1.png" id="logo"></a>

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




                <li class="nav-item dropdown">
                  
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  <i class="fas fa-question-circle"></i> <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="nav-link border-bottom" style="color:black !important;" href="/team">Our Team
                        <span class="sr-only">(current)</span>
                      </a>
                      <a class="nav-link text-dark border-bottom" href="/about">About us
                        <span class="sr-only">(current)</span>
                      </a>
                  </div>
              </li>

        
          @guest
              <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
              <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
          @else
              <li class="nav-item dropdown">
                  
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->name }} <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="nav-link text-dark border-bottom" href="/home">Home
                        <span class="sr-only">(current)</span>
                      </a>
                      <a class="nav-link text-dark border-bottom" href="/questions/create">Ask a Question
                        <span class="sr-only">(current)</span>
                      </a>
                      <a class="dropdown-item text-dark border-bottom" href="{{ route('logout') }}"
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