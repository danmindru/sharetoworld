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
				window.location.replace("{/literal}{$URL}networks/yournetworks/{literal}");
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
					{foreach from=$facebook key=k item=page}
						<div class="fb-container" id="fbpage{$page.facebook_id}">
							<div class="fb-like facebook-like-button-network" data-href="{$page.facebook_url}" data-send="false" data-layout="box_count" data-width="50" data-ref="{$page.facebook_id}/{$page.facebook_points_per_click}" data-show-faces="false" style="padding-left: 30px;"></div><br />
							<a href="#" class="btn btn-success no-border-radius fb-page-credits">{$page.facebook_points_per_click} Credits</a><br />
							<a href="{$page.facebook_url}" class="btn btn-info no-border-radius fb-page-credits">View Page</a>
						</div>
					{/foreach}
				</div>
            </div>
		</div> 
	</div>
</div>

{include file="footer.tpl"}