<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/">
    <img src="{{asset('imgs/carmax_logo.png')}}" width="100" height="30" alt="carmax_logo" />
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

      <li class="nav-item {{Request::is('/') ? 'active' : ''}}">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>

      @if(Auth::check())
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Browse
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/carmake">Car make</a>
          <a class="dropdown-item" href="/carmodel">Car model</a>
          <a class="dropdown-item" href="/carfeature">Car feature</a>
        </div>
      </li>
      @endif

      <li class="nav-item">
          <a class="nav-link" href="/about">About</a>
      </li>

    </ul>

    <!-- Navigation right -->
    <ul class="nav navbar-nav navbar-right">
        <div class="my-2 my-lg-0">
            @if(!Auth::check())
            <a href="/login" class="btn btn-primary mr-1">Log in</a>
            <a href="/register" class="btn btn-success mr-1">Register</a>
            @else
            <li class="nav-item dropdown ml-auto">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{Auth::user()->user_name}}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="/users">Manage users</a>
                <a class="dropdown-item" href="/logout">Log out</a>
            </div>
          </li>
            @endif
        </div>
    </ul>

  </div>
</nav>
