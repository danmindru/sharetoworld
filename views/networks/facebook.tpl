{include file="header.tpl"}

<div id="fb-root"></div>
<script>
{literal}
	var page = 0;
	window.fbAsyncInit = function() {
		FB.init({
			appId  : '117660814934034',
			status : true, // check login status
			cookie : true, // enable cookies to allow the server to access the session
			xfbml  : true  // parse XFBML
		});
    
		FB.Event.subscribe('edge.create', function(href, widget) {
			$( "#user-credits" ).hide();
		
			var myOptions 	= widget._attr.ref.split('/');
			var total 		= $( "#user-credits" ).text();
			total 			= eval(total + "+" + myOptions[1]);
		
			$( "#user-credits" ).fadeIn(2000).text(total);
			$('[id="fbpage' + myOptions[0] + '"]').remove();
			$.get( "{/literal}{$URL}cpanel/facebookLike/{literal}", { url: href, ref: myOptions[0] } );
			
			//Increase likes count
			page++;
			console.log(page);
			if(page == 3) {
				//reload template
				window.location.replace("{/literal}{$URL}networks/facebook/{literal}");
			}
    	});
	};

	// Load the SDK Asynchronously
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js 		= d.createElement(s); js.id = id;
		js.src 	= "//connect.facebook.net/en_US/all.js#xfbml=1";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
   
{/literal}
</script> 


{include file="navbar.tpl"}
{include file="addNewPage.tpl"}
{include file="register.tpl"}
{include file="login.tpl"}

<div class="container-fluid footer-min">
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
				
				{include file="socialtabs.tpl"}
				
				<div class="social-buttons-container twitter-container">
					{foreach from=$facebook key=k item=page}
						<div class="fb-container" style="margin-bottom: 20px;" id="fbpage{$page.facebook_id}">
							<div class="fb-like facebook-like-button-network" data-href="{$page.facebook_url}" data-send="false" data-layout="box_count" data-width="50" data-ref="{$page.facebook_id}/{$page.facebook_points_per_click}" data-show-faces="false" style="padding-left: 30px; overflow:hidden;"></div><br />
							<a href="#" class="btn btn-success no-border-radius fb-page-credits">{$page.facebook_points_per_click} Credits</a><br />
							<a href="{$page.facebook_url}" target="_blank" class="btn btn-info no-border-radius fb-page-credits">View Page</a>
						</div>
					{/foreach}
				</div>
				
				{php}
					$display_text = rand(1,5);
					// echo $display_text;
					
					if($display_text == 1){{/php}	
					<img id="arrow-facebook-points" src="{$URL_STATIC}img/arrow-facebook-points.png" alt="Get points by clicking the buttons"/>
					
				<div id="facebook-instructions-container" class="par-format-justify">
					<h4>You Are One Click Away From Getting More Points</h4>
					<p class="facebook-instructions-text">Like a link in order to get the displayed credits.<br/>We will display only 3 buttons at the same time for faster loading.<br/>When you have clicked all of them, we will display 3 more!</p>
				</div>
				    {php} } 
				    else if($display_text == 2){{/php}
				    	<img id="arrow-facebook-tabs" src="{$URL_STATIC}img/click-on-tabs.png" alt="Switch between social network tabs"/>
					
				<div id="facebook-instructions-container" class="par-format-justify">
					<h4>Click on another tab to get more points</h4>
					<p class="facebook-instructions-text">The credits you get from following someone can be used to gain more likes and viceversa.<br/>You can choose on what networks to be active.<br/>Switch between networks to get the maximum amount of credits.</p>
				</div>
				    {php} }
				    else if($display_text == 3){{/php}
				    	<img id="arrow-facebook-help" src="{$URL_STATIC}img/arrow-help.png" alt="Go on our Help page to see a quick user guide"/>
					
				<div id="facebook-instructions-container" class="par-format-justify">
					<h4>See how it works</h4>
					<p class="facebook-instructions-text">Learn more about the Share to World platform or our credit and rank system. <br/> Go on our help page to see a quick user guide.<br/>Check our Terms & Conditions to learn more about our policies.<br/>As a fact, we will not give your private information to anyone.</p>
				</div>
				    {php} }
				    else if($display_text == 4){{/php}
				    	<img id="arrow-facebook-credits" src="{$URL_STATIC}img/arrow-credits.png" alt="Get points by clicking the buttons"/>
					
				<div id="facebook-instructions-container" class="par-format-justify">
					<h4>Total credits</h4>
					<p class="facebook-instructions-text">The total number of credits is displayed on the top right corner while you are logged in.<br/>Each time you click on a link the points will be updated in real time.<br/>Get more credits to increase your rank and unlock new features.</p>
				</div>
				    {php} }
				    else if($display_text == 5){{/php}
				    	<img id="arrow-facebook-donate" src="{$URL_STATIC}img/arrow-donate.png" alt="Donate to Share to World"/>
					
				<div id="facebook-instructions-container" class="par-format-justify">
					<h4>Help us improve</h4>
					<p class="facebook-instructions-text">You can send your suggestions at any time in order to make our services better.<br/>We are open to new ideas so feel free to express your opinion.<br/>If you enjoy using our services, you can donate at any time.</p>
				</div>
				    {php} } {/php}
				
            </div>
		</div> 
	</div>
</div>

{include file="footer.tpl"}