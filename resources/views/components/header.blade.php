<a id="topArrow" href="#top">
	<span class="icon is-large">
		<i class="fa fas fa-2x fa-arrow-circle-up" aria-hidden="true"></i>
	</span>
</a>

<header>
	<nav class="navbar has-shadow">
		<div class="container">
			<div class="navbar-brand">
				<a class="navbar-item" href="/">
					<img src="/images/Lta.png" alt="Logo">
				</a>
				<span class="navbar-burger" data-target="navbarMenuHeroC">
					<span></span>
					<span></span>
					<span></span>
				</span>
			</div>
			<div id="navbarMenuHeroC" class="navbar-menu">
				<div class="navbar-start" style="flex-grow: 1; justify-content: center;">
					{{-- <a class="navbar-item has-text-weight-bold" href="/">Home</a> --}}
					
					@auth
						<p class="navbar-item has-text-weight-bold" >Welcome {{auth()->user()->name}}</p>
						@role('Annotator')
							<a class="navbar-item" href="/paragraph">Annotations</a>	
						@endrole	
						<a class="navbar-item" href="/dashboard/profile">Dashboard</a>	
					@endauth
					<a class="navbar-item" href="/aboutus">About Us</a>
				</div>
				<div class="navbar-end">
					<div class="navbar-item">
						<div class="buttons">
							{{-- <a class="button is-primary" href="signup.html"><strong>GET STARTED</strong></a> --}}

							@auth
								<form method="POST" action="/logout">
									@csrf
									<button class="button is-light" type="submit">Logout<i class="material-icons"
										aria-hidden="true">exit_to_app</i></button>
								</form>
							@else
								{{-- <a class="button is-light" href="/register" >Register</a> --}}
								<a class="button is-light" href="/login" >Login</a>
							@endauth
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>
</header>