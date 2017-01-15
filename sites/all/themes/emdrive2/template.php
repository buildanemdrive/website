<?php

function emdrive2_preprocess_node(&$variables) {
	if($variables['type'] == 'facebook_landing_page' || $variables['type'] == 'thank-you') {
        # If field_facebook_pixel_id is not an empty array
        if(array_key_exists('field_facebook_pixel_id', $variables) && count($variables['field_facebook_pixel_id'] > 0) && strlen($variables['field_facebook_pixel_id'][0]['value']) > 0) {
            # Extract the value
            $fb_pixel_id = $variables['field_facebook_pixel_id'][0]['value'];
            $code = "
			    <!-- Facebook Pixel Code -->
			    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','//connect.facebook.net/en_US/fbevents.js');
			    fbq('init', '". $fb_pixel_id ."');
			    fbq('track', 'PageView');
            ";
            if(array_key_exists('stripeform_amount', $_REQUEST)) {
                $code .= "fbq('track', 'Purchase', {value: '". $_REQUEST['stripeform_amount'] ."', currency: 'USD'});\n";
            }
		    drupal_add_js($code, 'inline');
		    drupal_add_html_head("
			    <noscript><img height='1' width='1' style='display:none' src='https://www.facebook.com/tr?id=". $fb_pixel_id ."&ev=PageView&noscript=1' /></noscript>
			    <!-- End Facebook Pixel Code -->
		    ", 'markup');
        } # Skip FB coding since there is no pixel code.
	} # Skip FB coding since it is the wrong type.
}
