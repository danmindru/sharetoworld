<div id="register-form" title="Registration">
	<form action="{$URL}account/create/" method="POST">
		<label>Username</label>
		<input type="text" class="span3" placeholder="Username" name="user_name" />
		<label>Password</label>
		<input type="password" class="span3" placeholder="&#149;&#149;&#149;&#149;&#149;&#149;" name="password" />
		<label>Retype Password</label>
		<input type="password" class="span3" placeholder="&#149;&#149;&#149;&#149;&#149;&#149;" name="passwordagain" />
		<label>Email</label>
		<input type="text" class="span3" placeholder="Email" name="email" /><br />
		<button type="submit" class="btn">Register</button>
	</form>
</div>