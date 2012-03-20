jQuery(document).ready(function($) {

	/* Add New Page 
	 * - open a pop-up window with social media networks
	 */ 
	
	// increase the default animation speed to exaggerate the effect
	$.fx.speeds._default = 1000;
	$(function() {
		
		$( "#dialog" ).dialog({
			autoOpen: false,
			modal: true,
			draggable: false,
			resizable: false,
			position: ['center', 50],
			show: "blind",
			hide: "blind"
		});
	
		$( "#opener" ).click(function() {
			$( "#dialog" ).dialog( "open" );
			return false;

		});
		
	/* Register Page 
	 * - open a pop-up window with register form
	 */ 
	
	// increase the default animation speed to exaggerate the effect		
	$( "#register-form" ).dialog({
		autoOpen: false,
		modal: true,
		draggable: false,
		resizable: false,
		width: 500,
		position: ['center', 50],
		show: "blind",
		hide: "blind"
	});

	$( "#register" ).click(function() {
		$( "#register-form" ).dialog( "open" );
		return false;
	});

	/* login Page 
	 * - open a pop-up window with login form
	 */ 
	
	// increase the default animation speed to exaggerate the effect		
	$( "#login-form" ).dialog({
		autoOpen: false,
		modal: true,
		draggable: false,
		resizable: false,
		width: 250,
		position: ['center', 50],
		show: "blind",
		hide: "blind"
	});

	$( "#login" ).click(function() {
		$( "#login-form" ).dialog( "open" );
		return false;
	});
	
	$( "#login-from-addpage" ).click(function() {
		$( "#login-form" ).dialog( "open" );
		return false;
	});
	
	$( "#register-from-login" ).click(function() {
		$( "#login-form" ).dialog( "close" );
		$( "#register-form" ).dialog( "open" );
		return false;
	});
	
	/* Points Per Click Slider
	 * - give user permssion to choose a certain amount of points per click
	 */
		$( "#slider-points-per-click" ).slider({
			range: "min",
			value: 2,
			min: 1,
			max: 10,
			slide: function( event, ui ) {
				$( "#point-per-click" ).text( ui.value );
				$( "#required-points" ).text( ui.value * $( "#slider-clicks" ).slider( "value" ) );
			}
		});
		$( "#point-per-click" ).text( $( "#slider-points-per-click" ).slider( "value" ) );
	
	/* Clicks Slider
	 * - give user permssion to choose total number of clicks
	 */
		$( "#slider-clicks" ).slider({
			range: "min",
			value: 1,
			min: 10,
			max: 100,
			slide: function( event, ui ) {
				$( "#total-clicks" ).text( ui.value );		
				$( "#required-points" ).text( ui.value * $( "#slider-points-per-click" ).slider( "value" ) );
			}
		});
		$( "#total-clicks" ).text( $( "#slider-clicks" ).slider( "value" ) );
		$( "#required-points" ).text( $( "#slider-clicks" ).slider( "value" ) * $( "#slider-points-per-click" ).slider( "value" ) );
		
		
		/**
		 * Social Forms
		 * - show and hide social forms when user select a network
		 */
		//Store ID
		var id 			= '';
		
		//Store previous ID
		var previousId 	= '';
		
		//Hide all forms when page loads
		$( ".social-form" ).hide();
		
		$( ".social-entry" ).click(function () {
			//added by Dan M - hide the default form after clicking a button
			$( ".social-form-default" ).hide();
			//Get ID from 'rel' attribute 	
			id = $( this ).attr("rel");
			
			if ( id == $( this ).attr("rel") ) {
				//hide previous form
				$( "#" + previousId ).hide();
				
				//show current form
				$( "#" + id ).fadeIn(1000);
				
				//Set previous ID
				previousId = id;
			} 
		})					
	});
});
