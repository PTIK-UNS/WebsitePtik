function social_color_picker(){
	
        // Add Color Picker to all inputs that have 'color-field' class
        jQuery( '.color-field' ).wpColorPicker();
}

jQuery(document).ready(function($) {
        social_color_picker();

        jQuery(document).on('click', '.social-choose .outline', function(event) {
                event.stopImmediatePropagation();
                var getTargetClassName = jQuery(this).attr('class').split(' ');
                var uniqueTargetClassSingleName = getTargetClassName[1];
                var uniqueTargetClassName = getTargetClassName[2];

                if (jQuery(this).hasClass('active')) {
                        jQuery(this).removeClass('active');
                        jQuery('.url-link.' + uniqueTargetClassName).removeClass('active');
                        jQuery('input#show_hide_' + uniqueTargetClassSingleName).val('off');
                } else {
                        jQuery(this).addClass('active');
                        jQuery('.url-link.' + uniqueTargetClassName).addClass('active');
                        jQuery('input#show_hide_' + uniqueTargetClassSingleName).val('on');
                }
        });
});
