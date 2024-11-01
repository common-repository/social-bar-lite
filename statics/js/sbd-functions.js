jQuery( document ).ready( function( $ ) {
	$( ".floatsocialbar" ).slideToggle("show");

	$( ".close-sidebar" ).click(function() {
	  $( ".floatsocialbar" ).slideToggle( "slow" );
	});

});
