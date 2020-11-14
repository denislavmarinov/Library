<ul class="nav nav-tabs">
    @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('homepage') }}">{{ __('Home') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        @if (Route::currentRouteName() !== "password_update")
		<li class="nav-item">
			<a class="nav-link" href="{{ route('user_dashboard') }}">{{ __('User dashboard') }}</a>
		</li>
        @endif
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="post" id="logout_form">
                @csrf
                <a id="logout_link" class="nav-link">{{ __('Logout') }}</a>
            </form>
        </li>
    @endif
</ul>
<script type="text/javascript">
    $('#logout_link').on('click', function(){
        $('#logout_form').submit();
    })
</script>
