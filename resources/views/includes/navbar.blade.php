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
                    <a href="{{ route('public.home') }}" class="nav-link {{Route::is('public.home') ? 'active-nav-link' : 'text-white'}}">
                        {{ __('Home') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('public.about') }}" class="nav-link {{Route::is('public.about') ? 'active-nav-link' : 'text-white'}}">
                        {{ __('About') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('public.contact') }}" class="nav-link {{Route::is('public.contact') ? 'active-nav-link' : 'text-white'}}">
                        {{ __('Contact') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('public.contests') }}" class="nav-link {{Route::is('public.contests') ? 'active-nav-link' : 'text-white'}}">
                        {{ __('Contests') }}
                    </a>
                </li>
                
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link nav-login auth-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link auth-link" href="{{ Auth::user()->admin !== null ? route('admin.dashboard') : route('contestant.dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<script>

    function logOutUser(){
        event.preventDefault(); 
        document.getElementById('logout-form').submit();s
    }

</script>