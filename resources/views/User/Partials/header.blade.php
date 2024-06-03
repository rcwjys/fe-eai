<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="{{url('/user/dashboard')}}">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/user/dashboard')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/create-candidate')}}">Buat Kandidat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Pricing</a>
        </li>

        <li class="nav-item">
          <form action="{{url('/logout')}}" method="POST">
            @csrf
            <button class="nav-link" type="submit">Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>