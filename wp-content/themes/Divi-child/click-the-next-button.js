<script>
// This is the initial GravityForms binding, it will be lost upon a page change with next/previous
// Thus we make a bind on gform_page_loaded event also
if( jQuery('.gform_wrapper form').length > 0 ) {
	jQuery('.gfield_radio input[type=radio]').bind("click", function() {
		//console.log('Clicked: ' + jQuery( this ).closest('.gform_page').find('.gform_page_footer .gform_next_button.button') );
		jQuery(this).closest('.gform_page').find('.gform_page_footer .gform_next_button.button').click();
	});
	jQuery('.gfield_select input[type=select]').bind("click", function() {
		//console.log('Clicked: ' + jQuery( this ).closest('.gform_page').find('.gform_page_footer .gform_next_button.button') );
		jQuery(this).closest('.gform_page').find('.gform_page_footer .gform_next_button.button').click();
	});
}

jQuery(document).bind('gform_page_loaded', function(event, form_id, current_page){
	// code to be trigger when next/previous page is loaded
	if( jQuery('.custom-form').length > 0 ) {
		jQuery('.gfield_radio input[type=radio]').bind("click", function() {
			//console.log('Clicked: ' + jQuery( this ).closest('.gform_page').find('.gform_page_footer .gform_next_button.button') );
			jQuery(this).closest('.gform_page').find('.gform_page_footer .gform_next_button.button').click();
		});
		jQuery('.gfield_select input[type=select]').bind("click", function() {
			//console.log('Clicked: ' + jQuery( this ).closest('.gform_page').find('.gform_page_footer .gform_next_button.button') );
			jQuery(this).closest('.gform_page').find('.gform_page_footer .gform_next_button.button').click();
		});
	}
});
</script>