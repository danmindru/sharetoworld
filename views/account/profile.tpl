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
					<form action="{$URL}account/profile/" method="POST">
						<label>First Name</label>
						<input type="text" class="span3" placeholder="First Name" name="firstname" />
						<label>Last Name</label>
						<input type="texxt" class="span3" placeholder="Last Name" name="lastname" />
						<label>Website</label>
						<input type="text" class="span3" placeholder="Your Website URL" name="website" />
						<label>Activation Code</label>
						<input type="text" class="span3" placeholder="Your Activation Code" name="confirmation_code" /><br />
						<button type="submit" class="btn">Continue</button>
					</form>
				</div>
            </div>
		</div> 
	</div>
</div>
{include file="footer.tpl"}