<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
  <a class="navbar-brand" href="#">S-Community</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
    </ul>
    @if (Auth::user())
      <ul class="nav navbar-nav navbar-right">
        <li class="nav-item">
          <a href="{{route('account')}}" class="nav-link">Account</a>
        </li>
        <li class="nav-item">
          <a href="{{route('logout')}}" class="nav-link">Logout</a>
        </li>
      </ul>
    @endif
  </div>
</nav>