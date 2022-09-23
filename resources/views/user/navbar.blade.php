<nav class="navbar navbar-expand-md shadow-sm navbar-transparent">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{-- <img src="{{asset('images/logo.png')}}" width="auto" height="40px"/> --}}
            {{ config('app.name', 'MyCounsellor') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            &#9776;
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->firstname . " " . Auth::user()->lastname}}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="logOutUser()">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
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