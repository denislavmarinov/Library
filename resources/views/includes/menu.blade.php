<ul class="nav nav-tabs">
    @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <div class="navbar-nav ml-auto">
    		<li class="nav-item">
    			<a class="nav-link" href="{{ route('user_dashboard') }}">{{ __('User dashboard') }}</a>
    		</li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <input class="nav-link" type="submit" name="submit" value="{{ __('Logout') }}">
                </form>
            </li>
        </div>
    @endif
</ul>
