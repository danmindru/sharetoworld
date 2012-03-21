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
					{if !$user.is_loggedin}
						<li><a href="#" id="login-from-addpage">Add New Page +</a></li>
					{else}
						<li><a href="#" id="opener">Add New Page +</a></li>
						<li><a href="{$URL}networks/yourNetworks/">Your Networks</a></li>
						<li><a href="#">Control Panel</a></li>
					{/if}
				</ul>
				
				<p class="navbar-buttons">
					{if !$user.is_loggedin}
						<a href="#" class="btn no-border-radius" id="login">Login</a>&nbsp;<a href="#" class="btn btn-inverse no-border-radius" id="register">Register</a>
					{else}
						<a href="#" class="btn btn-success no-border-radius">{$user.user_credits|number_format} Credits</a>
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
				<div class="social-title">Facebook</div>
			</div>
			<div class="social-entry" rel="social-twitter-form">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/twitter.png" />
				</div>
				<div class="social-title">Twitter</div>
			</div>
			<div class="social-entry" rel="social-google-form">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/google.png" />
				</div>
				<div class="social-title">Google Plus</div>
			</div>
			<div class="social-entry" rel="social-linkedin-form">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/linkedin.png" />
				</div>
				<div class="social-title">LinkedIn</div>
			</div>
			<div class="social-entry" rel="social-digg-form">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/digg.png" />
				</div>
				<div class="social-title">Digg</div>
			</div>
			<div class="social-entry" rel="social-stumbleupon-form">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/stumbleupon.png" />
				</div>
				<div class="social-title">StumbleUpon</div>
			</div>
		</div>
		<!-- default right dialog for add new page -->
		<div class="dialog-right">
			<div class="social-form-default">
				<form class="well">
					<img id="arrow-default-add-page" src="{$URL_STATIC}img/arrow-default-add-page.png" alt="Choose Social Networks"/>
					<h4 class="default-add-page-title">Add a New Social Page</h4>
					<p class="pro-text">Distribute points in order to get clicks on your links.</p>
					<p class="point-count">You have: <span class="credits">{$user.user_credits|number_format} Credits</span></p>
					<p class="pro-text-bottom">Like, +1, Share, Stumble, Pin, Digg or Tweet other pages to get more Credits</p>
				</form>
			</div>
			
			<div class="social-form" id="social-facebook-form">
				<form class="well" action="{$URL}cpanel/addFacebook/" method="POST">
					<label>Your URL</label>
					<input type="text" class="span3" placeholder="Type your Facebook Page URL" name="facebook_url" />
					<span class="help-inline">https://www.facebook.com/YourURL</span>
					<label>How many clicks would you like to get?
					<a href="#" class="btn btn-info facebook-clicks-button">Clicks: <span id="total-clicks"></span></a>
					<div id="slider-clicks"></div><br />
					<label>How many credits per click?</label>
					<div id="slider-points-per-click"></div>
					<hr />
					<input type="hidden" id="facebook_clicks" name="facebook_clicks" value="" />
					<input type="hidden" id="facebook_points_per_click" name="facebook_points_per_click" value="" />
					<a href="#" class="btn btn-info no-border-radius facebook-credits-click-button">Credits per click: <span id="point-per-click"></span></a><a href="#" id="btn-required-pronts" class="btn btn-success no-border-radius facebook-credits-required">You need: <span id="required-points"></span></a><a href="#" class="btn btn-info no-border-radius facebook-credits-own">You have {$user.user_credits|number_format}</a><button type="submit" class="btn no-border-radius" style="margin-left: 25px; margin-top: -15px;">Submit</button>
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
				
               <div id="graphic">
   				   
   				   <div class="row-fluid">
	             	   <div class="span4" id="par-format">
			               <img id="arrow-add" src="{$URL_STATIC}img/arrow-add-new-page.png" alt="Add a new social page"/>
			               
			               <h4>Add Your Social Page</h4>
			               <p class="txt">You can add pages from facebook, twitter,</p>
			               <p class="txt">google, stumbleupon, pinterest and digg.</p>
	            		</div>
	               
		               <!-- begin counter -->
		               <div class="span4" id="par-format">
		               		<div id="counter-hold">		
		               			
		               			<div class="counter-cell first-counter-cell">
		               				<p class="counter-number">0</p>
		               			</div>
		               			<div class="counter-cell">
		               				<p class="counter-number">0</p>
		               			</div>
		               			<div class="counter-cell">
		               				<p class="counter-number">0</p>
		               			</div>
		               			<div class="counter-cell">
		               				<p class="counter-number">0</p>
		               			</div>
		               			<div class="counter-cell">
		               				<p class="counter-number">1</p>
		               			</div>
		               			<div class="counter-cell">
		               				<p class="counter-number">3</p>
		               			</div>
		               			<div class="counter-cell">
		               				<p class="counter-number">4</p>
		               			</div>
		               			<div class="counter-cell">
		               				<p class="counter-number">7</p>
		               			</div>
		               			
		               			<p class="txt under-counter">Users are increasing their audience each minute.</p>
		               		</div>
		               </div>
		               <!-- end counter -->
		               
		               <div class="span4" id="par-format">
			               <img id="arrow-sign" src="{$URL_STATIC}img/arrow-sign-up.png" alt="Add a new social page"/>
			               
			               <h4>Sign Up - It's Free!</h4>
		                   <p class="txt">Have instant access to a audience </p>
		                   <p class="txt">you have never dreamed before.</p>
		                	<!-- <h2 class="hand-text">Testing Font</h2> -->
		              </div>
		          </div>    
                	<br/><br/><br/><br/><br/><br/><br/>
                	<hr/>
                	
					<h1>Welcome to Share To World - a free service that connects people via  social networks: share, world, social, facebook, twitter, digg, like, follow, pin, +1 or stumble.</h1>
              
                	
                  <div class="row-fluid">
	             	   <div class="span4" id="par-format">
				            <h5>What you get?</h5>
				            <p class="txt">Building a network has just got easy!</p>   
				            <p class="txt">The users of Share The World will be</p>
				            <p class="txt">connecting with your page faster than</p>
				            <p class="txt">you could ever begin to imagine.</p>
				            <p class="txt">Take your page to a global scale, for free!</p>
				            
		               </div>
		               
		               <div class="span4" id="par-format">
				            <h5>Dream become reality</h5>
				            <p class="txt">The good part has just got a lot better.</p>
				            <p class="txt">You will instantly have a potential</p>
				            <p class="txt">audience formed by thousands of people.</p>
				            <p class="txt">Each click you get connects you with all</p>
				            <p class="txt">of the target's friends and followers.</p>
		               </div>
	                	
	                   <div class="span4" id="par-format">  
		                   	<h5>No hidden pays or fees</h5>
				            <p class="txt">What do you have to do in order to get</p>
				            <p class="txt">access to this incredible service?</p>	 
				            <p class="txt">Just register and help others grow.</p>
				            <p class="txt">Each click you will give to others</p>
				            <p class="txt">is going to be in your advantage.</p>
		        	   </div>
	               </div>
               </div>
                
			</div>
		</div> 
	</div>
</div>
{include file="footer.tpl"}