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
				<p class="navbar-text pull-right">Logged in as <a href="#">username</a></p>
			</div><!--/.nav-collapse -->
		</div>
	</div>
</div>
 
<div id="dialog" title="Add New Page">
	<div class="dialog-container">
		<div class="dialog-left">
			<div class="social-entry">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/facebook.png" />
				</div>
				<div class="social-title">FACEBOOK</div>
			</div>
			<div class="social-entry">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/twitter.png" />
				</div>
				<div class="social-title">TWITTER</div>
			</div>
			<div class="social-entry">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/google.png" />
				</div>
				<div class="social-title">GOOGLE PLUS</div>
			</div>
			<div class="social-entry">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/linkedin.png" />
				</div>
				<div class="social-title">LINKEDIN</div>
			</div>
			<div class="social-entry">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/digg.png" />
				</div>
				<div class="social-title">DIGG</div>
			</div>
			<div class="social-entry">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/stumbleupon.png" />
				</div>
				<div class="social-title">STUMBLEUPON</div>
			</div>
		</div>
		<div class="dialog-right">
			<div id="social-facebook-form">
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
		</div>
	</div>
</div> 
 
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="hero-unit">
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