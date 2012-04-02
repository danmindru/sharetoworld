<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container-fluid">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="{$URL}"><img class="logo" src="{$URL_STATIC}img/whitesmall.png" alt="Share The World"/></a>
			<div class="nav-collapse">
				<ul class="nav">
					<li class="active"><a href="{$URL}">Home</a></li>
					{if !$user.is_loggedin}
						<li><a href="#" id="login-from-addpage">Add New Page +</a></li>
					{else}
						<li><a href="#" id="opener">Add New Page +</a></li>
						<li><a href="{$URL}networks/facebook/">Get Points</a></li>
						<li><a href="{$URL}pages">Your Pages</a></li>
						<li><a href="#">Statistics</a></li>
					{/if}
				</ul>
				
				<p class="navbar-buttons">
					{if !$user.is_loggedin}
						<a href="#" class="btn no-border-radius" id="login">Login</a>&nbsp;<a href="#" class="btn btn-inverse no-border-radius" id="register">Register</a>
					{else}
						<a href="#" class="btn btn-success no-border-radius"><span id="user-credits">{$user.user_credits}</span> Credits</a>
						<a href="{$URL}account/logout/" class="btn no-border-radius">Logout [{$user.user_name}]</a>
					{/if}
				</p>
				
			</div><!--/.nav-collapse -->
		</div>
	</div>
</div>