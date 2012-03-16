{include file="mobile/header.tpl"}

{if $user.is_loggedin}
	<a href="{$URL}mobile_account/logout/" data-role="button" data-theme="c" data-inline="true">Logout</a>
{else}
	<a href="{$URL}mobile_account/login/" data-role="button" data-theme="c" data-inline="true">Login</a>
{/if}
	




{include file="mobile/footer.tpl"}