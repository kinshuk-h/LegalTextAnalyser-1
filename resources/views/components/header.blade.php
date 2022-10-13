<style> <?php include public_path('css/header_css.css') ?> </style>
<div class="headerbox">
	<div class="logo">
		<a href="/">Legal Text Analyser</a>
	</div>
	<div class="linkbox">
		
		@auth
		  	<span>
			  Welcome {{auth()->user()->name}}
			</span>

			<a href="#">Paragraphs</a>		
			<a href="/dashboard">Dashboard</a>	

			<form method="POST" action="/logout">
				@csrf
				<button type="submit">Logout</button>
			</form>
		@else
			<a href="#">Paragraphs</a>		
			<a href="/dashboard">Dashboard</a>
			<a href="/register" >Register</a>
			<a href="/login" >Login</a>
		@endauth

		<a href="#">About Us</a>
		
	</div>
	<button class="get-started-btn-h">
		GET STARTED
	</button>
</div>
