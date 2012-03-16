{include file="header.tpl"}
<div id="holder">
		<div id="main">
			<form action="{$URL}account/login/" method="POST">
			<fieldset id="login">
				<label>Username</label><br/>
				<input type="text" class="input" name="user_name" /><br/>
				<label>Password</label><br/>
				<input type="password" class="input" name="password" /><br/><br/>
				<input type="submit" class="button" value="Login">
			</fieldset>
		</form>
		</div>
		<div id="sidebar">
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ipsum metus, sagittis a placerat a, pulvinar ut dolor. Aenean eget dignissim enim. Quisque nec diam nec velit lobortis venenatis quis vitae nisl. Quisque lacinia, enim sit amet tincidunt blandit, mi lectus ullamcorper erat, pretium viverra massa neque non lectus. Integer in enim pellentesque neque imperdiet lobortis.</p>
		</div>
	</div>
	<div class="clear"> </div>
</div>
{include file="footer.tpl"}
