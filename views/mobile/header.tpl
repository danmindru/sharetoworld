<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Share To World</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="share, world, social, facebook, twitter, digg, like, follow" />
		<meta name="description" content="Share To World - Connect All People via Social Networks" />
		<meta name="Author" content="Dan Mindru - mindrudan@gmail.com ; Daniel Rosca - danielr@danielrosca.ro" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0-rc.1/jquery.mobile-1.1.0-rc.1.min.css" />
		<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.1.0-rc.1/jquery.mobile-1.1.0-rc.1.min.js"></script>
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
		{/literal}
		</script>
	</head>
	<body>
	
	<div data-role="page">
		<div data-role="header">
			<h1>Share To World</h1>
		</div><!-- /header -->
		
		{if $flash}
			{if $flash.type == 'warning'}
				<a data-role="button" data-theme="e" data-inline="true">{$flash.message}</a>
			{elseif $flash.type == 'error'}
				<a data-role="button" data-theme="a" data-inline="true">{$flash.message}</a>
			{elseif $flash.type == 'success'}
				<a data-role="button" data-theme="b" data-inline="true">{$flash.message}</a>
			{elseif $flash.type == 'info'}
				<a data-role="button" data-theme="c" data-inline="true">{$flash.message}</a> 
			{/if}
		{/if}