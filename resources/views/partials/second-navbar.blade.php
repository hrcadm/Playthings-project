<div class="navbar navbar-default" id="navbar-second">
	<ul class="nav navbar-nav no-border visible-xs-block">
		<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
	</ul>

	<div class="navbar-collapse collapse" id="navbar-second-toggle">
		<ul class="nav navbar-nav navbar-nav-material">
			<li class="active"><a href="{{ route('home') }}"><i class="icon-home2 position-left"></i> Dashboard</a></li>

			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-make-group position-left"></i> Manage <span class="caret"></span>
				</a>

				<ul class="dropdown-menu width-250">
					<li class="dropdown-header">Manage Sections</li>
					<li><a href="{{ route('users.index') }}"><i class="icon-users2"></i> Users</a></li>
					<li><a href="{{ route('items.index') }}"><i class="icon-file-empty"></i> Items</a></li>
					<li><a href="{{ route('labs.index') }}"><i class="icon-library2"></i> Labs</a></li>
					<li><a href="{{ route('factories.index') }}"><i class="icon-store2"></i> Factories</a></li>
					<li><a href="{{ route('standards.index') }}"><i class="icon-certificate"></i> Standards</a></li>
				</ul>
			</li>

			<li><a href="{{ route('vendors.index') }}"><i class="icon-cc position-left"></i> Vendors</a></li>
			<li><a href="#"><i class="icon-safe position-left"></i> Items Tests Passed</a></li>
			<li><a href="#"><i class="icon-archive position-left"></i> Archive</a></li>
		</ul>
	</div>
</div>