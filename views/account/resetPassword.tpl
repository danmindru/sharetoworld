{include file="header.tpl"}
{include file="navbar.tpl"}
{include file="addNewPage.tpl"}
{include file="register.tpl"}
{include file="login.tpl"}
 
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="hero-unit">
					
				<div class="flash-message-align">
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
				</div>	
					
				<div id="profile-form">					
					<form action="{$URL}account/resetPassword/" method="POST">
						<label>Email</label>
						<input type="text" class="span3" placeholder="Your email address" name="email" />
						<span class="help-inline">Reseting your password will generate a random one. You will receive it by email in a few minutes.</span>
						<button type="submit" class="btn">Reset Password</button>
					</form>
				</div>
            </div>
		</div> 
	</div>
</div>
{include file="footer.tpl"}