<header class="navbar navbar-expand-lg bg-white shadow-sm @mobile fixed-top page-header @endmobile">
    <div class="container-fluid">
        <a class="navbar-brand d-lg-none" href="@can('create-user'){{ route('management.dashboard') }}@else{{ route('user.dashboard') }}@endcan">
            <img class="img-fluid" src="{{ asset('images/logo.png') }}" alt="Complaint Management System">
        </a>

        <button id="menuToggler" class="toggler d-lg-none" type="button">
            <i data-feather="menu"></i>
            <i data-feather="x"></i>
        </button>

        <div class="collapse navbar-collapse">
            <div class="navbar-nav mr-auto">
                <h2>@yield('page-heading')</h2>
            </div>

            <div class="ml-auto d-flex align-items-center">
                <i class="mr-1" data-feather="user"></i>
                Welcome, {{ auth()->user()->name }}!
            </div>
        </div>
    </div>
</header>