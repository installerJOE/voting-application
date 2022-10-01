<div class="col-md-12 col-12 px-0 bg-dark">
    <div class="align-items-center text-white">
        <div class="col-md-12 col-12"> 
            <a href="/" class="pb-3 text-white">
                <span class="fs-5 d-sm-inline"> {{config('app.name')}} </span>
            </a>
            <div class="header-menu-icon side-bar-cancel-btn"> 
                <div class="sidebar-toggler" data-bs-target="#sideBarContent" onclick="toggleSideBar()">
                    &times;
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12"> 
            <ul class="py-4 sidenav nav nav-pills flex-column mb-0 align-items-center align-items-sm-start" id="menu">
                @if(Auth::user()->admin !== null)
                    @include('user.sidebars.admin')
                @else
                    @include('user.sidebars.contestant')
                @endif

                <li>
                    <a href="{{route('user.profile')}}" class="nav-link align-middle {{ Route::is('user.profile') ? 'active-link' : 'text-white' }}">
                        <i class="bi-people"></i> 
                        <span class="ms-1 d-sm-inline">
                            Profile
                        </span> 
                    </a>
                </li>

                <li class="bd-bottom-light">
                    <a href="{{route('user.security')}}" class="nav-link align-middle {{ Route::is('user.security') ? 'active-link' : 'text-white' }}">
                        <i class="bi-people"></i> 
                        <span class="ms-1 d-sm-inline">
                            Password/Security
                        </span> 
                    </a>
                </li>

                <li>
                    <a class="nav-link align-middle text-light" href="{{ route('logout') }}" onclick="logOutUser()">
                        <span class="ms-1 d-sm-inline">
                            {{ __('Logout') }}
                        </span> 
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
    function logOutUser(){
        event.preventDefault(); 
        document.getElementById('logout-form').submit();
    }
</script>