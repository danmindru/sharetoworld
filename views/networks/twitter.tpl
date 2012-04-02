{include file="header.tpl"}
<script type="text/javascript" charset="utf-8">
{literal}
	var page = 0;
	window.twttr = (function (d,s,id) {
		var t, js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
		js.src="//platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
		return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
	}(document, "script", "twitter-wjs"));
{/literal}
</script>

<script>
{literal}
	twttr.ready(function (twttr) {
		twttr.events.bind('follow',   function(e) {
			$( "#user-credits" ).hide();
			var params 		= e.target.parentNode.id;
			var myOptions 	= params.split('/');
			var total 		= $( "#user-credits" ).text();
			total 			= eval(total + "+" + myOptions[1]);
		
			$( "#user-credits" ).fadeIn(2000).text(total);
			$('[id="divid' + myOptions[0] + '"]').addClass("hidden-div");
			$.get( "{/literal}{$URL}cpanel/twitterFollow/{literal}", { ref: myOptions[0] } );
			
			//Increase likes count
			page++;
			if(page == 6) {
				//reload template
				window.location.replace("{/literal}{$URL}networks/twitter/{literal}");
			}
		});
	});
{/literal}
</script>

<script> 
	{literal}
		jQuery(document).ready(function($) {
			$(".icon-remove").click(function() {
				$('[id="divid' + $(this).attr("id") + '"]').addClass("hidden-div");
				
				//Increase likes count
				page++;
				if(page == 6) {
					//reload template
					window.location.replace("{/literal}{$URL}networks/twitter/{literal}");
				}
			});
		});
	{/literal}
</script>

{include file="navbar.tpl"}
{include file="addNewPage.tpl"}
{include file="register.tpl"}
{include file="login.tpl"}

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
				
				{include file="socialtabs.tpl"}
				
				<div class="social-buttons-container twitter-container">
					{foreach from=$twitter key=k item=page}
						<div id="divid{$page.twitter_id}" class="fb-container" style="position: relative; margin-bottom: 20px;">
							<i id="{$page.twitter_id}" class="icon-remove" style="position: absolute; top: 3px; right: 3px; z-index: 10; cursor: pointer;"></i>
							<div id="{$page.twitter_id}/{$page.twitter_points_per_follow}" style="margin-left: 10px; margin-top: 10px;">
								<a href="{$page.twitter_url}" class="twitter-follow-button" data-show-count="false" data-size="large" data-show-screen-name="false">Follow</a>
							</div><br />
							<a href="#" class="btn btn-success no-border-radius fb-page-credits">{$page.twitter_points_per_follow} Credits</a><br />
							<a href="{$page.twitter_url}" class="btn btn-info no-border-radius fb-page-credits">View Profile</a>
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