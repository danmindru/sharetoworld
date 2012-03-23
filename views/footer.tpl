			<div class="row-fluid footer1 footer-background">
				<div class="span3 bottom-link">
					<a href="#">Facebook</a><br />
					<a href="#">Twitter</a><br />
					<a href="#">Google+</a><br />
					<a href="#">LinkedIn</a><br />
					<a href="#">Digg</a><br />
					<a href="#">StubmelUpon</a>
				</div>
				<div class="span3 bottom-link">
					<a href="#">Facebook</a><br />
					<a href="#">Twitter</a><br />
					<a href="#">Google+</a><br />
					<a href="#">LinkedIn</a><br />
					<a href="#">Digg</a><br />
					<a href="#">StubmelUpon</a>
				</div>
				<div class="span3 bottom-link">
					<a href="#">Facebook</a><br />
					<a href="#">Twitter</a><br />
					<a href="#">Google+</a><br />
					<a href="#">LinkedIn</a><br />
					<a href="#">Digg</a><br />
					<a href="#">StubmelUpon</a>
				</div>
				<div class="span3 bottom-link">
					<a href="#">Facebook</a><br />
					<a href="#">Twitter</a><br />
					<a href="#">Google+</a><br />
					<a href="#">LinkedIn</a><br />
					<a href="#">Digg</a><br />
					<a href="#">StubmelUpon</a>
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