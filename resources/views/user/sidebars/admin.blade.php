<li>
    <a href="{{route('admin.dashboard')}}" class="nav-link align-middle {{ Route::is('admin.dashboard') ? 'active-link' : 'text-white' }}">
        <i class="bi-people"></i> 
        <span class="ms-1 d-sm-inline">
            Dashboard
        </span> 
    </a>
</li>

<li>
    <a href="{{route('admin.contests')}}" class="nav-link align-middle {{ Route::is('admin.contests') ? 'active-link' : 'text-white' }}">
        <i class="bi-people"></i> 
        <span class="ms-1 d-sm-inline">
            Contests
        </span> 
    </a>
</li>