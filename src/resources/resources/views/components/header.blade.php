<header>
    <div class="header align-items-center flex">
        <x-hamburger-menu />
        @if(request()->path() == '/' || request()->path() == 'search')
        <x-search />
        @endif
    </div>
    @if (session('fs_msg'))
    <div class="flash_message">
        {{ session('fs_msg') }}
    </div>
    @endif
    <x-drowmenu />
</header>
