<div class="card" style=" height: 100%;">
    <div class="card-header">Logged in: {{ Auth::user()->name }}-{{ Auth::user()->id }}</div>

    <div class="card-body" style="background-color:steelblue;">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div>
            <ul>
               <a class="dropdown-item" href="/DASHBOARD">Local Movies</a>
                <hr>

                <!-- Calling the GATE for manage-users - will show if admin of viewOnlyAdmin - see gate in AuthServiceProvider.php-->

                    <a class="dropdown-item" href="/upload">Movie Listing</a>
                    <hr>
                    <a class="dropdown-item" href="/upload/create">Create Movie</a>
                    <hr>
                    <a class="dropdown-item" href="/user-profile">Profile</a>
                    <hr>
                @can('manage-users')
                    <a class="dropdown-item" href="{{route('admin.users.index')}}">Manage Users</a>
                    <hr>
                @endcan

                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
            </ul>
        </div>
    </div>
</div>
