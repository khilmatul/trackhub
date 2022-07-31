<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
<<<<<<< HEAD
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="img/logo.png" style="height: 30px; width:30px" alt="">Layanan Angkutan Kota Banyuwangi</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">        
        <ul class="navbar-nav ms-auto">
              @auth
              <li class="nav-item">
                  <a class="nav-link {{ Request::is('logout') ? 'active' : '' }}" href="{{url('logout')}}">Logout</a>
                </li>     
              @else
                <li class="nav-item">
                  <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{url('/')}}">Beranda</a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link {{ Request::is('register') ? 'active' : '' }}" href="/register">Daftar</a>
                </li> -->
                <li class="nav-item">
                  <a class="nav-link {{ Request::is('register') ? 'active' : '' }}" href="{{url('register')}}">Daftar Kartu</a>
                </li>              
              @endauth
              <li class="nav-item">
                  <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="{{url('login')}}">Masuk</a>
                </li>
          </ul>     
        </div>
=======
  <div class="container">
    <a class="navbar-brand" href="#">
    <img src="img/logo.png" style="height: 30px; width:30px" alt="">Layanan Angkutan Kota Banyuwangi</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">        
      <ul class="navbar-nav ms-auto">
        @auth
        <li class="nav-item">
            <a class="nav-link {{ Request::is('logout') ? 'active' : '' }}" href="{{url('logout')}}">Logout</a>
          </li>     
        @else
          <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{url('/')}}">Beranda</a>
          </li>
                        
          <li class="nav-item">
            <a class="nav-link {{ Request::is('register') ? 'active' : '' }}" href="{{url('register')}}">Daftar Kartu</a>
          </li> 
        @endauth
          
        <li class="nav-item">
          <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="{{url('login')}}">Masuk</a>
        </li> 
      </ul>     
>>>>>>> b49556890d951d8e5eebe59dba7640efdc7d50f8
    </div>
  </div>
</nav>