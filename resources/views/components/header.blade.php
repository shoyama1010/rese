<header>
  <div class="header align-items-center flex">
    <div id="hamburger" class="header__hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <h1 class="header__ttl">Rese</h1>
  </div>
  @if (session('fs_msg'))
  <div class="flash_message">
    {{ session('fs_msg') }}
  </div>
  @endif

  <div id="menu" class="menu">
    <a href="{{ url('/') }}" class="menu__item">Home</a>
    @if( Auth::check() )
    <a href="{{ url('/logout') }}" class="menu__item">Logout</a>
    <a href="{{ url('/mypage') }}" class="menu__item">Mypage</a>
    @else
    <a href="{{ url('/register') }}" class="menu__item">Registration</a>
    <a href="{{ url('login') }}" class="menu__item">Login</a>
    @endif
  </div>
</header>