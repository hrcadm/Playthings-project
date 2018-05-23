<div class="navbar navbar-inverse bg-indigo">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{ route('home') }}" style="padding:0;padding-bottom:16px;"><img src="{{ asset('assets/images/playthings_logo.png') }}" alt="Playthings" style="width:80%;height: 150%;margin-top:0;padding-top: 0;"></a>

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
					<li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
					<li class="divider"></li>
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