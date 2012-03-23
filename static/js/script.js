jQuery(document).ready(function($) {

	// increase the default animation speed to exaggerate the effect
	$.fx.speeds._default = 1000;
	
	$(function() {
	
		/* Add New Page 
		 * - open a pop-up window with social media networks
		 */	
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
	
		/* Login Page 
		 * - open a pop-up window with login form
		 */ 
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
	
	
	/* FACEBOOK Points Per Click Slider
	 * - give user permssion to choose a certain amount of points per click
	 */
		$( "#facebook-slider-points-per-click" ).slider({
			range: "min",
			value: 2,
			min: 1,
			max: 10,
			slide: function( event, ui ) {
				$( "#facebook-point-per-click" ).text( ui.value );
				$( "#facebook-required-points" ).text( ui.value * $( "#facebook-slider-clicks" ).slider( "value" ) );
				$( "#facebook_points_per_click" ).val( ui.value );
				
				if( (ui.value * $( "#facebook-slider-clicks" ).slider( "value" )) > userCredits) {
					$( "#facebook-btn-required-pronts" ).removeClass("btn-success").addClass("btn-danger");
					creditsClass = true;
						
				}
				if( ((ui.value * $( "#facebook-slider-clicks" ).slider( "value" )) <= userCredits) && creditsClass == true) {
					$( "#facebook-btn-required-pronts" ).removeClass("btn-danger").addClass("btn-success");	
					creditsClass = false;
				}
			}
		});
		$( "#facebook-point-per-click" ).text( $( "#facebook-slider-points-per-click" ).slider( "value" ) );
		$( "#facebook_points_per_click" ).val( $( "#facebook-slider-points-per-click" ).slider( "value" ) );

	/* FACEBOOK Clicks Slider
	 * - give user permssion to choose total number of clicks
	 */
		$( "#facebook-slider-clicks" ).slider({
			range: "min",
			value: 1,
			min: 10,
			max: 100,
			slide: function( event, ui ) {
				$( "#facebook-total-clicks" ).text( ui.value );		
				$( "#facebook-required-points" ).text( ui.value * $( "#facebook-slider-points-per-click" ).slider( "value" ) );
				$( "#facebook_clicks" ).val( ui.value );
				
				if( (ui.value * $( "#facebook-slider-points-per-click" ).slider( "value" )) > userCredits) {
					$( "#facebook-btn-required-pronts" ).removeClass("btn-success").addClass("btn-danger");
					creditsClass = true;	
				}
				if( ((ui.value * $( "#facebook-slider-points-per-click" ).slider( "value" )) <= userCredits)  && creditsClass == true) {
					$( "#facebook-btn-required-pronts" ).removeClass("btn-danger").addClass("btn-success");	
					creditsClass = false;
				}
			}
		});
		$( "#facebook-total-clicks" ).text( $( "#facebook-slider-clicks" ).slider( "value" ) );
		$( "#facebook-required-points" ).text( $( "#facebook-slider-clicks" ).slider( "value" ) * $( "#facebook-slider-points-per-click" ).slider( "value" ) );
		$( "#facebook_clicks" ).val( $( "#facebook-slider-clicks" ).slider( "value" ) );
		
		if( ($( "#facebook-slider-clicks" ).slider( "value" ) * $( "#facebook-slider-points-per-click" ).slider( "value" )) > userCredits) {
			$( "#facebook-btn-required-pronts" ).removeClass("btn-success").addClass("btn-danger");	
			creditsClass = true;
		}
		if( (($( "#facebook-slider-clicks" ).slider( "value" ) * $( "#facebook-slider-points-per-click" ).slider( "value" )) <= userCredits) && creditsClass == true) {
			$( "#facebook-btn-required-pronts" ).removeClass("btn-danger").addClass("btn-success");
			creditsClass = false;	
		}
		
			/* TWITTER Points Per Click Slider
	 * - give user permssion to choose a certain amount of points per click
	 */
		$( "#twitter-slider-points-per-click" ).slider({
			range: "min",
			value: 2,
			min: 1,
			max: 10,
			slide: function( event, ui ) {
				$( "#twitter-point-per-click" ).text( ui.value );
				$( "#twitter-required-points" ).text( ui.value * $( "#twitter-slider-clicks" ).slider( "value" ) );
				$( "#twitter_points_per_click" ).val( ui.value );
				
				if( (ui.value * $( "#twitter-slider-clicks" ).slider( "value" )) > userCredits) {
					$( "#twitter-btn-required-pronts" ).removeClass("btn-success").addClass("btn-danger");
					creditsClass = true;
						
				}
				if( ((ui.value * $( "#twitter-slider-clicks" ).slider( "value" )) <= userCredits) && creditsClass == true) {
					$( "#twitter-btn-required-pronts" ).removeClass("btn-danger").addClass("btn-success");	
					creditsClass = false;
				}
			}
		});
		$( "#twitter-point-per-click" ).text( $( "#twitter-slider-points-per-click" ).slider( "value" ) );
		$( "#twitter_points_per_click" ).val( $( "#twitter-slider-points-per-click" ).slider( "value" ) );
	
	/* TWITTER Clicks Slider
	 * - give user permssion to choose total number of clicks
	 */
		$( "#twitter-slider-clicks" ).slider({
			range: "min",
			value: 1,
			min: 10,
			max: 100,
			slide: function( event, ui ) {
				$( "#twitter-total-clicks" ).text( ui.value );		
				$( "#twitter-required-points" ).text( ui.value * $( "#twitter-slider-points-per-click" ).slider( "value" ) );
				$( "#twitter_clicks" ).val( ui.value );
				
				if( (ui.value * $( "#twitter-slider-points-per-click" ).slider( "value" )) > userCredits) {
					$( "#twitter-btn-required-pronts" ).removeClass("btn-success").addClass("btn-danger");
					creditsClass = true;	
				}
				if( ((ui.value * $( "#twitter-slider-points-per-click" ).slider( "value" )) <= userCredits)  && creditsClass == true) {
					$( "#twitter-btn-required-pronts" ).removeClass("btn-danger").addClass("btn-success");	
					creditsClass = false;
				}
			}
		});
		$( "#twitter-total-clicks" ).text( $( "#twitter-slider-clicks" ).slider( "value" ) );
		$( "#twitter-required-points" ).text( $( "#twitter-slider-clicks" ).slider( "value" ) * $( "#twitter-slider-points-per-click" ).slider( "value" ) );
		$( "#twitter_clicks" ).val( $( "#twitter-slider-clicks" ).slider( "value" ) );
		
		if( ($( "#twitter-slider-clicks" ).slider( "value" ) * $( "#twitter-slider-points-per-click" ).slider( "value" )) > userCredits) {
			$( "#twitter-btn-required-pronts" ).removeClass("btn-success").addClass("btn-danger");	
			creditsClass = true;
		}
		if( (($( "#twitter-slider-clicks" ).slider( "value" ) * $( "#twitter-slider-points-per-click" ).slider( "value" )) <= userCredits) && creditsClass == true) {
			$( "#twitter-btn-required-pronts" ).removeClass("btn-danger").addClass("btn-success");
			creditsClass = false;	
		}
		
		
		//Keep track of button classes (Total Credits)
		var creditsClass = false;
			
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