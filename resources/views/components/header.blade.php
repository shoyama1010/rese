<header>
  <div class="header align-items-center flex">
    <div id="hamburger" class="header__hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <h1 class="header__ttl">Rese</h1>
  </div>
  <div id="menu" class="menu">
    <a href="/" class="menu__item">Home</a>
    @if( Auth::check() )
    <a href="/logout" class="menu__item">Logout</a>
    <a href="/mypage" class="menu__item">Mypage</a>
    @else
    <a href="/register" class="menu__item">Registration</a>
    <a href="login" class="menu__item">Login</a>
    @endif
  </div>
</header>