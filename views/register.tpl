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
		<label class="checkbox">
			<input type="checkbox" name="terms" value="terms"> I read and agree with the <a href="{$URL}about/terms" target="_blank"><span class="term-link">Terms & Conditions</span></a>
      	</label><br />
		<button type="submit" class="btn">Register</button>
	</form>
</div>