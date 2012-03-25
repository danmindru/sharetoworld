			<hr/>
			<div class="row-fluid footer1 footer-background">
				<div class="span3 bottom-link">
					<a href="{$URL}about/aboutus">About Share to World</a><br />
					<a href="{$URL}about/terms">Terms and Conditions</a><br />
					<a href="{$URL}about/policy">Privacy Policy</a><br />
					<a href="{$URL}about/contact">Contact Share to World</a><br />
					<a href="{$URL}about/faq">Frequently Asked Questions</a><br />
					<a href="{$URL}about/help">Help and Indications</a>
				</div>
				<div class="span3 bottom-link">
					<a href="{$URL}blog">Blog</a><br />
					<a href="#">Increase Audience</a><br />
					<a href="#">The New Web 3.0</a><br />
					<a href="#">Social Networks</a><br />
					<a href="#">STW user Guide</a><br />
					<a href="#">Welcome to STW</a>
				</div>
				<div class="span3 bottom-link">
					<a href="http://www.facebook.com/pages/Share-To-World/136290376499043">STW Facebook</a><br />
					<a href="https://twitter.com/#!/sharetoworld">STW Twitter</a><br />
					<a href="http://delicious.com/sharetoworld">STW Delicious</a><br />
					<a href="http://digg.com/sharetoworld/diggs">STW Digg</a><br />
					<a href="http://www.stumbleupon.com/stumbler/sharetoworld">STW StubmelUpon</a><br />
					<a href="http://pinterest.com/sharetoworld/">STW Pinterest</a>
				</div>
				<div class="span3 bottom-link">
					<a href="http://www.danielrosca.ro" target="_blank">Daniel Rosca</a><br />
					<a href="http://www.mindrudan.com" target="_blank">Dan Mindru</a><br />
					<a href="http://www.facebook.com/DanielRoscaPage" target="_blank">DanielRoscaPage</a><br />
					<a href="http://www.facebook.com/MindruDanMultimedia" target="_blank">MindruDanMultimedia</a><br />
					<a href="https://twitter.com/danielrosca" target="_blank">@danielrosca</a><br />
					<a href="https://twitter.com/mindrudan" target="_blank">@mindrudan</a>
				</div>
				
			</div>
			
			<div class="row-fluid footer2 footer-background">
				<p id="copy-right">
				
				{php}
					 $firstyear = 2012;
					 $time = time () ; 
					 $year= date("Y",$time); 
					if($firstyear == $year)
				 	 {
						 echo "Copyright &copy; Share to World $firstyear";
				 	 }
					else
					 {
						 echo "Copyright &copy; Share to World $firstyear - " . $year;
					 }
				{/php}	
					<br/>
					<span class="copy-notice">This site does not use private information from facebook, twitter, google, linkedin, pinterest, digg, stumbleupon and is not affiliated with them or their services in any way.</span>				
				</p>
			</div>
			
		<script type="text/javascript" src="{$URL_STATIC}js/bootstrap-transition.js"></script>
		<script type="text/javascript" src="{$URL_STATIC}js/bootstrap-alert.js"></script>
		<script type="text/javascript" src="{$URL_STATIC}js/bootstrap-modal.js"></script>
		<script type="text/javascript" src="{$URL_STATIC}js/bootstrap-dropdown.js"></script>
		<script type="text/javascript" src="{$URL_STATIC}js/bootstrap-scrollspy.js"></script>
		<script type="text/javascript" src="{$URL_STATIC}js/bootstrap-tab.js"></script>
		<script type="text/javascript" src="{$URL_STATIC}js/bootstrap-tooltip.js"></script>
		<script type="text/javascript" src="{$URL_STATIC}js/bootstrap-popover.js"></script>
		<script type="text/javascript" src="{$URL_STATIC}js/bootstrap-button.js"></script>
		<script type="text/javascript" src="{$URL_STATIC}js/bootstrap-collapse.js"></script>
		<script type="text/javascript" src="{$URL_STATIC}js/bootstrap-carousel.js"></script>
		<script type="text/javascript" src="{$URL_STATIC}js/bootstrap-typeahead.js"></script>
	</body>
</html>