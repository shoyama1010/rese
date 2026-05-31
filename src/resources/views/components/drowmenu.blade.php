<div id="menu" class="menu">
	<a href="{{ route('root') }}" class="menu__item">Home</a>

	@if (Auth::check())
	<form class="menu__item" name="logout" action="{{ route('logout') }}" method="POST">
		@csrf
		<a class="menu__item" onclick="document.logout.submit();">Logout</a>
	</form>

	<a href="{{ route('mypage') }}" class="menu__item">Mypage</a>
	<a href="{{ route('multi.login.form') }}" class="menu__item">Management Login</a>
	@else
	<a href="{{ route('register') }}" class="menu__item">Registration</a>
	<a href="{{ route('login') }}" class="menu__item">Login</a>
	<a href="{{ route('multi.login.form') }}" class="menu__item">Management Login</a>
	@endif
</div>