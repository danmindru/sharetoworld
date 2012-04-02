<div id="dialog" title="Add New Page">
	<div class="dialog-container">
		<div class="dialog-left">
			<div class="social-entry" rel="social-facebook-form">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/facebook.png" />
				</div>
				<div class="social-title">Facebook</div>
			</div>
			<div class="social-entry" rel="social-twitter-form">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/twitter.png" />
				</div>
				<div class="social-title">Twitter</div>
			</div>
			<div class="social-entry" rel="social-google-form">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/google.png" />
				</div>
				<div class="social-title">Google Plus</div>
			</div>
			<div class="social-entry" rel="social-linkedin-form">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/linkedin.png" />
				</div>
				<div class="social-title">LinkedIn</div>
			</div>
			<div class="social-entry" rel="social-digg-form">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/digg.png" />
				</div>
				<div class="social-title">Digg</div>
			</div>
			<div class="social-entry" rel="social-stumbleupon-form">
				<div class="social-icon">
					<img src="{$URL_STATIC}img/64x64/stumbleupon.png" />
				</div>
				<div class="social-title">StumbleUpon</div>
			</div>
		</div>
		<!-- default right dialog for add new page -->
		<div class="dialog-right">
			<div class="social-form-default">
				<form class="well">
					<img id="arrow-default-add-page" src="{$URL_STATIC}img/arrow-default-add-page.png" alt="Choose Social Networks"/>
					<h4 class="default-add-page-title">Add a New Social Page</h4>
					<p class="pro-text">Distribute points in order to get clicks on your links.</p>
					<p class="point-count">You have: <span class="credits">{$user.user_credits|number_format} Credits</span></p>
					<p class="pro-text-bottom">Like, +1, Share, Stumble, Pin, Digg or Tweet other pages to get more Credits</p>
				</form>
			</div>
			
			<div class="social-form" id="social-facebook-form">
				<form class="well" action="{$URL}cpanel/addFacebook/" method="POST">
					<label>Your URL</label>
					<input type="text" class="span3" placeholder="Type your Facebook Page URL" name="facebook_url" />
					<span class="help-inline">http://www.yourURL.com</span><br /><br />
					<label>
						How many likes would you like to get?
						<a href="#" class="btn btn-info facebook-clicks-button">Likes: <span id="facebook-total-clicks"></span></a>
					</label>
					<div id="facebook-slider-clicks"></div><br /><br />
					<label>How many credits per like?</label>
					<div id="facebook-slider-points-per-click"></div>
					<hr />
					<input type="hidden" id="facebook_clicks" name="facebook_clicks" value="" />
					<input type="hidden" id="facebook_points_per_click" name="facebook_points_per_click" value="" />
					<a href="#" class="btn btn-info no-border-radius facebook-credits-click-button">Credits per like: <span id="facebook-point-per-click"></span></a><a href="#" id="facebook-btn-required-pronts" class="btn btn-success no-border-radius facebook-credits-required">You need: <span id="facebook-required-points"></span></a><a href="#" class="btn btn-info no-border-radius facebook-credits-own">You have {$user.user_credits|number_format}</a><button type="submit" class="btn no-border-radius" style="margin-left: 25px; margin-top: -15px;">Submit</button>
				</form>
			</div>
			<div class="social-form" id="social-twitter-form">
				<form class="well" action="{$URL}cpanel/addTwitter/" method="POST">
					<label>Your URL</label>
					<input type="text" class="span3" placeholder="Type your Twitter Page URL" name="twitter_url" />
					<span class="help-inline">http://www.twitter.com/YourName</span><br /><br />
					<label>
						How many follows would you like to get?
						<a href="#" class="btn btn-info facebook-clicks-button">Follows: <span id="twitter-total-clicks"></span></a>
					</label>
					<div id="twitter-slider-clicks"></div><br /><br />
					<label>How many credits per follow?</label>
					<div id="twitter-slider-points-per-click"></div>
					<hr />
					<input type="hidden" id="twitter_clicks" name="twitter_clicks" value="" />
					<input type="hidden" id="twitter_points_per_click" name="twitter_points_per_click" value="" />
					<a href="#" class="btn btn-info no-border-radius facebook-credits-click-button">Credits per follow: <span id="twitter-point-per-click"></span></a><a href="#" id="twitter-btn-required-pronts" class="btn btn-success no-border-radius facebook-credits-required">You need: <span id="twitter-required-points"></span></a><a href="#" class="btn btn-info no-border-radius facebook-credits-own">You have {$user.user_credits|number_format}</a><button type="submit" class="btn no-border-radius" style="margin-left: 25px; margin-top: -15px;">Submit</button>
				</form>
			</div>
			<div class="social-form" id="social-google-form">
				<form class="well" action="{$URL}cpanel/addGoogle/" method="POST">
					<label>Your URL</label>
					<input type="text" class="span3" placeholder="Type your Google Plus Page URL" name="google_url" />
					<span class="help-inline">http://www.YourURL</span><br /><br />
					<label>
						<span class="question-text">How many plus ones would you like to get?</span>
						<a href="#" class="btn btn-info facebook-clicks-button">Plus One: <span id="google-total-clicks"></span></a>
					</label>
					<div id="google-slider-clicks"></div><br /><br />
					<label>How many credits per plus one?</label>
					<div id="google-slider-points-per-click"></div>
					<hr />
					<input type="hidden" id="google_clicks" name="google_clicks" value="" />
					<input type="hidden" id="google_points_per_click" name="google_points_per_click" value="" />
					<a href="#" class="btn btn-info no-border-radius facebook-credits-click-button">Credits per +1: <span id="google-point-per-click"></span></a><a href="#" id="google-btn-required-pronts" class="btn btn-success no-border-radius facebook-credits-required">You need: <span id="google-required-points"></span></a><a href="#" class="btn btn-info no-border-radius facebook-credits-own">You have {$user.user_credits|number_format}</a><button type="submit" class="btn no-border-radius" style="margin-left: 25px; margin-top: -15px;">Submit</button>
				</form>
			</div>
			<div class="social-form" id="social-linkedin-form">
				<form class="well">
					<label>Linkedin</label>
					<button type="submit" class="btn">Submit</button>
				</form>
			</div>
			<div class="social-form" id="social-digg-form">
				<form class="well">
					<label>Digg</label>
					<button type="submit" class="btn">Submit</button>
				</form>
			</div>
			<div class="social-form" id="social-stumbleupon-form">
				<form class="well">
					<label>StumbleUpon</label>
					<button type="submit" class="btn">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>