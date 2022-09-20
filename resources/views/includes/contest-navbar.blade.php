<nav class="navbar navbar-expand-md shadow-sm navbar-transparent">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{-- <img src="{{asset('images/logo.png')}}" width="auto" height="40px"/> --}}
            {{ config('app.name', 'Voting Application') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            &#9776;
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="{{ route('public.showContest') }}" class="nav-link {{Route::is('public.showContest') ? 'active-nav-link' : 'text-white'}}">
                        {{ __('Back to Contest') }}
                    </a>
                </li>                
            </ul>
        </div>
    </div>
</nav>
