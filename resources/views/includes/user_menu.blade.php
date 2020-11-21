<ul class="nav nav-tabs">
    @if (Auth::check())
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user_dashboard') }}">Home</a>
        </li>
    @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('homepage') }}">Home</a>
        </li>
    @endif
    @if (Auth::user()->role_id == '1')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('authors.index') }}">Authors</a>
    </li>
    @elseif( Auth::user()->role_id == '2')
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Authors</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('authors.index') }}">All authors</a>
            <a class="dropdown-item" href="{{ route('authors.create') }}">Add author</a>
        </div>
    </li>
    @endif

    @if (Auth::user()->role_id == '1')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('books.index') }}">Books</a>
    </li>
    @elseif( Auth::user()->role_id == '2')
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Books</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('books.index') }}">All books</a>
            <a class="dropdown-item" href="{{ route('books.create') }}">Add book</a>
        </div>
    </li>
    @endif

    @if (Auth::user()->role_id == '1')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('genres.index') }}">Genres</a>
    </li>
    @elseif (Auth::user()->role_id == '2')
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Genres</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('genres.index') }}">All genres</a>
            <a class="dropdown-item" href="{{route('genres.create')}}">Add genre</a>
        </div>
    </li>
    @endif

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Nationalities</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('nationalities.index') }}">All nationalities</a>
            @if( Auth::user()->role_id == '2')
                <a class="dropdown-item" href="{{ route('nationalities.create') }}">Add nationality</a>
            @endif
        </div>
    </li>

    @if (Auth::user()->role_id == '2')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('roles.index') }}">Roles</a>
    </li>
    @endif

    @if (Auth::user()->role_id == '2')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.list') }}">Users</a>
    </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" href="{{ route('wishlists.index') }}">Wishlists</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('readlist') }}">Readlist</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user_speed') }}">Reading speed</a>
    </li>

    <li class="nav-item">
        <form action="{{ route('logout') }}" method="post" id="logout_form">
            @csrf
            <a id="logout_link" class="nav-link">{{ __('Logout') }}</a>
        </form>
    </li>
</ul>
<script type="text/javascript">
    $('#logout_link').on('click', function(){
        $('#logout_form').submit();
    })
</script>
