{include file="header.tpl"}
	<div id="holder">
		<div id="main">
			<h2>Registration</h2>
			<form action="{$URL}account/create/" method="POST">
				<fieldset>
					<label>Username</label><br/>
					<input type="text" class="input" name="user_name" /><br/>
					<label>Password</label><br/>
					<input type="password" class="input" name="password" /><br/>
					<label>Repeat Password</label><br/>
					<input type="password" class="input" name="passwordagain" /><br/>
					<label>Email</label><br/>
					<input type="text" class="input" name="email" /><br/>
					
					<input type="submit" class="button" value="Register">
				</fieldset>
			</form>
	</div>
	<div class="clear"> </div>
</div>
{include file="footer.tpl"}
