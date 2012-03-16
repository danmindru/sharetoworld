<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Share To World</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="share, world, social, facebook, twitter, digg, like, follow" />
		<meta name="description" content="Share To World - Connect All People via Social Networks" />
		<meta name="Author" content="Dan Mindru - mindrudan@gmail.com ; Daniel Rosca - danielr@danielrosca.ro" />
		<link rel="stylesheet" type="text/css" media="screen" href="{$URL_STATIC}css/start/jquery-ui-1.8.18.custom.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="{$URL_STATIC}css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="{$URL_STATIC}css/style.css" />
		<script type="text/javascript" src="{$URL_STATIC}js/jquery.js"></script>
		<script type="text/javascript" src="{$URL_STATIC}js/jquery-ui-1.8.18.custom.min.js"></script>
		<script type="text/javascript" src="{$URL_STATIC}js/bootstrap.js"></script>
		<script type="text/javascript">
		{literal}
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-29749551-1']);
		  _gaq.push(['_trackPageview']);

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
			// increase the default animation speed to exaggerate the effect
			$.fx.speeds._default = 1000;
			$(function() {
				
				$( "#dialog" ).dialog({
					autoOpen: false,
					draggable: false,
					resizable: false,
					position: ['center', 50],
					show: "blind",
					hide: "puff"
				});

				$( "#opener" ).click(function() {
					$( "#dialog" ).dialog( "open" );
					return false;
				});

				$( "#slider-points-per-click" ).slider({
					range: "min",
					value: 2,
					min: 1,
					max: 10,
					slide: function( event, ui ) {
						$( "#point-per-click" ).text( ui.value );
						$( "#required-points" ).text( ui.value * $( "#slider-clicks" ).slider( "value" ) );
					}
				});
				$( "#point-per-click" ).text( $( "#slider-points-per-click" ).slider( "value" ) );

				$( "#slider-clicks" ).slider({
					range: "min",
					value: 1,
					min: 10,
					max: 100,
					slide: function( event, ui ) {
						$( "#total-clicks" ).text( ui.value );		
						$( "#required-points" ).text( ui.value * $( "#slider-points-per-click" ).slider( "value" ) );
					}
				});
				$( "#total-clicks" ).text( $( "#slider-clicks" ).slider( "value" ) );
				$( "#required-points" ).text( $( "#slider-clicks" ).slider( "value" ) * $( "#slider-points-per-click" ).slider( "value" ) );				
			});
		{/literal}
		</script>
	</head>
	<body>