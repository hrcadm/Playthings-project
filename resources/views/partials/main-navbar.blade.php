<div class="navbar navbar-inverse" style="background-color: #4caf50">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{ route('home') }}" style="padding-top: 0;margin-top: 2px;">
			<img style="height: 3.5em;padding-top: 0;margin-top: 0;" src="{{ asset('assets/images/playthings_logo.png') }}" alt="Playthings" />
		</a>

		<ul class="nav navbar-nav pull-right visible-xs-block">
			<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-cog4"></i></a></li>
		</ul>
	</div>

	<div class="navbar-collapse collapse" id="navbar-mobile">

		<ul class="nav navbar-nav navbar-right">

			<li class="dropdown dropdown-user">
				<a class="dropdown-toggle" data-toggle="dropdown">
					<span><i class="icon-user position-left"></i> {{ Auth::user()->name }}</span>
					<i class="caret"></i>
				</a>

				<ul class="dropdown-menu dropdown-menu-right">
					@if(Auth::user()->role === 'admin')
						<li><a href="{{ route('register') }}"><i class="icon-user-plus"></i> Create New User</a></li>
						<li class="divider"></li>
					@endif

					<li>
						<a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();"><i class="icon-switch2"></i>
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
				</ul>
			</li>
		</ul>
	</div>
</div>