@mobile
	@role(['user'])
		<footer class="bg-white bottom_menu">
			<ul>
				<li class="{{ Request::is('management/dashboard') || Request::is('user/dashboard') ? 'active' : '' }}">
					<a href="@can('create-user'){{ route('management.dashboard') }}@else{{ route('user.dashboard') }}@endcan">
						<i data-feather="grid"></i> Home
					</a>
				</li>
				<li class="{{ Request::is('complaints/index') ? 'active' : '' }}">
					<a href="{{ route('complaints.index') }}">
						<i data-feather="search"></i> Search
					</a>
				</li>
				<li class="{{ Request::is('complaint/complaint-type') || Request::is('complaint/super-categories') ? 'active' : '' }}">
					<a href="{{ route('complaint.complaint-type') }}">
						<i data-feather="plus-square"></i> Create
					</a> 
				</li>
				<!--<li class="{{ Request::is('complaints/create') ? 'active' : '' }}">
					<a href="{{ route('complaints.create') }}">
						<i data-feather="plus-square"></i> Create
					</a>
				</li> -->
				<li class="{{ Request::is('complaint/resolved') ? 'active' : '' }}">
					<a href="{{ route('complaint.resolved') }}">
						<i data-feather="edit"></i> Feedback
					</a>
				</li>
			</ul>
		</footer>
	@endrole
	@role(['sse'])
		<footer class="bg-white bottom_menu">
			<ul>
				<li class="{{ Request::is('management/dashboard') || Request::is('user/dashboard') ? 'active' : '' }}">
					<a href="@can('create-user'){{ route('management.dashboard') }}@else{{ route('user.dashboard') }}@endcan">
						<i data-feather="grid"></i> Home
					</a>
				</li>
				<li class="{{ Request::is('management/users') || Request::is('management/users/*') || Request::is('management/verify-users') ? 'active' : '' }}">
					<a href="{{ route('management.users.index') }}">
						<i data-feather="users"></i> Users
					</a>
				</li>
				<li class="{{ Request::is('complaints/create') ? 'active' : '' }}">
					<a href="{{ route('complaints.create') }}">
						<i data-feather="plus-square"></i> Create
					</a>
				</li>
				<li class="{{ Request::is('sse/vendors') || Request::is('sse/vendors/*') || Request::is('sse/resources') || Request::is('sse/resources/*') ? 'active' : '' }}">
					<a href="{{ route('sse.vendors.index') }}">
						<i data-feather="user-check"></i> Vendors
					</a>
				</li>
			</ul>
		</footer>
	@endrole
		@role(['helpdesk'])
		<footer class="bg-white bottom_menu">
			<ul>
				<li class="{{ Request::is('management/dashboard') || Request::is('user/dashboard') ? 'active' : '' }}">
					<a href="@can('create-user'){{ route('management.dashboard') }}@else{{ route('user.dashboard') }}@endcan">
						<i data-feather="grid"></i> Home
					</a>
				</li>
				<li class="{{ Request::is('complaints') ? 'active' : '' }}">
					<a href="{{ route('complaints.index') }}">
						<i data-feather="search"></i> Search
					</a>
				</li>
				<li class="{{ Request::is('complaints/create') ? 'active' : '' }}">
					<a href="{{ route('complaints.create') }}">
						<i data-feather="plus-square"></i> Create
					</a>
				</li>
				<li class="{{ Request::is('management/users') || Request::is('management/users/*') || Request::is('management/verify-users') ? 'active' : '' }}">
					<a href="{{ route('management.users.index') }}">
						<i data-feather="users"></i> Users
					</a>
				</li>
			</ul>
		</footer>
	@endrole
@elsemobile
	<footer>
    	<small>&copy; 2021 NRCMS. <span>App Version 2.0</span></small>
    </footer>
@endmobile