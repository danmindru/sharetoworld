{include file="header.tpl"}
<script type="text/javascript" charset="utf-8">
{literal}
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
				
				<div class="social-buttons-container">
					{foreach from=$twitter key=k item=page}
						<div id="divid{$page.twitter_id}" class="fb-container" style="margin-bottom: 20px;">
							<div id="{$page.twitter_id}/{$page.twitter_points_per_follow}" style="margin-left: 10px; margin-top: 10px;">
								<a href="{$page.twitter_url}" class="twitter-follow-button" data-show-count="false" data-size="large" data-show-screen-name="false">Follow</a>
							</div><br />
							<a href="#" class="btn btn-success no-border-radius fb-page-credits">{$page.twitter_points_per_follow} Credits</a><br />
							<a href="{$page.twitter_url}" class="btn btn-info no-border-radius fb-page-credits">View Profile</a>
						</div>
					{/foreach}
				</div>
            </div>
		</div> 
	</div>
</div>

{include file="footer.tpl"}