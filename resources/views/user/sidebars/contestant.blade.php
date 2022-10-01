<li class="bd-bottom-light">
    <a href="{{route('contestant.dashboard')}}" class="nav-link align-middle {{ Route::is('contestant.dashboard') ? 'active-link' : 'text-white' }}">
        <i class="bi-people"></i> 
        <span class="ms-1 d-sm-inline">
            Dashboard
        </span> 
    </a>
</li>

<li>
    <a href="{{route('user.contests')}}" class="nav-link align-middle {{ Route::is('user.contests') || Route::is('user.showContest') ? 'active-link' : 'text-white' }}">
        <i class="bi-people"></i> 
        <span class="ms-1 d-sm-inline">
            My Contests
        </span> 
    </a>
</li>

<li class="bd-bottom-light">
    <a href="{{route('user.contests.register')}}" class="nav-link align-middle {{ Route::is('user.contests.register') ? 'active-link' : 'text-white' }}">
        <i class="bi-people"></i> 
        <span class="ms-1 d-sm-inline">
            Register Contest
        </span> 
    </a>
</li>