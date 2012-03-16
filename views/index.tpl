{include file="header.tpl"}

<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container-fluid">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="#"><img class="logo" src="{$URL_STATIC}img/whitesmall.png" alt="Share The World"/></a>
			<div class="nav-collapse">
				<ul class="nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#" id="opener">Add New Page +</a></li>
					<li><a href="#about">About</a></li>
					<li><a href="#contact">Contact</a></li>
				</ul>
				
				<p class="navbar-buttons">
					{if !$user.is_loggedin}
						<a href="#" class="btn no-border-radius" id="login">Login</a>&nbsp;<a href="#" class="btn btn-inverse no-border-radius" id="register">Register</a>
					{else}
						<a href="{$URL}account/logout/" class="btn no-border-radius">Logout [{$user.user_name}]</a>
					{/if}
				</p>
				
			</div><!--/.nav-collapse -->
		</div>
	</div>
</div>
 
<div id="dialog" title="Add New Page">
	<div class="dialog-container">
		<div class="dialog-left">
			<div class="social-entry" rel="social-facebook-form">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/facebook.png" />
				</div>
				<div class="social-title">FACEBOOK</div>
			</div>
			<div class="social-entry" rel="social-twitter-form">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/twitter.png" />
				</div>
				<div class="social-title">TWITTER</div>
			</div>
			<div class="social-entry" rel="social-google-form">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/google.png" />
				</div>
				<div class="social-title">GOOGLE PLUS</div>
			</div>
			<div class="social-entry" rel="social-linkedin-form">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/linkedin.png" />
				</div>
				<div class="social-title">LINKEDIN</div>
			</div>
			<div class="social-entry" rel="social-digg-form">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/digg.png" />
				</div>
				<div class="social-title">DIGG</div>
			</div>
			<div class="social-entry" rel="social-stumbleupon-form">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/stumbleupon.png" />
				</div>
				<div class="social-title">STUMBLEUPON</div>
			</div>
		</div>
		<div class="dialog-right">
			<div class="social-form" id="social-facebook-form">
				<form class="well">
					<label>Your URL</label>
					<input type="text" class="span3" placeholder="Type your Facebook Page URL">
					<span class="help-inline">https://www.facebook.com/YourURL</span>
					<label>How many clicks would you like to get?&emsp;&emsp;&emsp;Clicks: <span id="total-clicks"></span></label>
					<div id="slider-clicks"></div><br />
					<label>Points per click: <span id="point-per-click"></span>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;You need: <span id="required-points"></span> points</label>
					<div id="slider-points-per-click"></div><br />
					<button type="submit" class="btn">Submit</button>
				</form>
			</div>
			<div class="social-form" id="social-twitter-form">
				<form class="well">
					<label>Twitter</label>
					<button type="submit" class="btn">Submit</button>
				</form>
			</div>
			<div class="social-form" id="social-google-form">
				<form class="well">
					<label>Google</label>
					<button type="submit" class="btn">Submit</button>
				</form>
			</div>
			<div class="social-form" id="social-linkedin-form">
				<form class="well">
					<label>Linkedin</label>
					<button type="submit" class="btn">Submit</button>
				</form>
			</div>
			<div class="social-form" id="social-digg-form">
				<form class="well">
					<label>Digg</label>
					<button type="submit" class="btn">Submit</button>
				</form>
			</div>
			<div class="social-form" id="social-stumbleupon-form">
				<form class="well">
					<label>StumbleUpon</label>
					<button type="submit" class="btn">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div> 

<div id="register-form" title="Registration">
	<form action="{$URL}account/create/" method="POST">
		<label>Username</label>
		<input type="text" class="span3" placeholder="Username" name="user_name" />
		<label>Password</label>
		<input type="password" class="span3" placeholder="&#149;&#149;&#149;&#149;&#149;&#149;" name="password" />
		<label>Retype Password</label>
		<input type="password" class="span3" placeholder="&#149;&#149;&#149;&#149;&#149;&#149;" name="passwordagain" />
		<label>Email</label>
		<input type="text" class="span3" placeholder="Email" name="email" /><br />
		<button type="submit" class="btn">Register</button>
	</form>
</div>

<div id="login-form" title="Login">
	<form action="{$URL}account/login/" method="POST">
		<label>Username</label>
		<input type="text" class="span3" placeholder="Username" name="user_name" />
		<label>Password</label>
		<input type="password" class="span3" placeholder="&#149;&#149;&#149;&#149;&#149;&#149;" name="password" />
		<button type="submit" class="btn">Login</button><br />
		<span class="more-info">Don't have an account yet? <a href="#" class="more-info-a" id="register-from-login">Sign Up!</a></span>
		
	</form>
</div>

 
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="hero-unit">
				{if $flash}
					{if $flash.type == 'warning'}
						<a class="btn btn-warning" href="#">{$flash.message}</a>
					{elseif $flash.type == 'error'}
						<a class="btn btn-danger" href="#">{$flash.message}</a>
					{elseif $flash.type == 'success'}
						<a class="btn btn-success" href="#">{$flash.message}</a>
					{elseif $flash.type == 'info'}
						<a class="btn btn-info" href="#">{$flash.message}</a> 
					{/if}
				{/if}
				<h1>Share To World!</h1>
				<p>Share To World - Connect All People via Social Networks : share, world, social, facebook, twitter, digg, like, follow</p>
                
                <div id="graphic">
                	<h2 class="hand-text">Testing Font</h2>
                
                </div>
                
			</div>
		</div> 
	</div>
</div>
{include file="footer.tpl"}