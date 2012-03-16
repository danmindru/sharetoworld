{include file="mobile/header.tpl"}

	<div data-role="content">	
		<form action="{$URL}mobile_account/login/" method="POST">
			<div data-role="fieldcontain">
	   			<label for="user">Username:</label>
				<input type="text" name="user_name" id="user" value="" />
			</div>
			<div data-role="fieldcontain">
	   			<label for="password">Password:</label>
				<input type="password" id="password" name="password" />
			</div>
			<div data-role="fieldcontain">
	   			<input type="submit" value="LogIn" data-inline="true" />
			</div>		
		</form>					
	</div><!-- /content -->

</div><!-- /page -->

	
{include file="mobile/footer.tpl"}
