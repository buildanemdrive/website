<?php

drupal_add_css('//code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css', array('type' => 'external', 'group' => CSS_DEFAULT));
drupal_add_js('//code.jquery.com/ui/1.10.4/jquery-ui.js', 'external');
drupal_add_js('
    jQuery( function() {
        jQuery(document).tooltip();
    });
', 'inline');

print drupal_render_children($form);

?>
<script src="https://checkout.stripe.com/checkout.js"></script>

<script>
    var handler = StripeCheckout.configure({
        key: '<?php print variable_get('stripeform_public_key'); ?>',
        locale: 'auto',
        name: 'Build an EM Drive',
        description: 'Please Help',
        token: function(token) {
            // Submit the form
            jQuery('input[name=stripeEmail]').val(token.email);
            jQuery('input[name=stripeId]').val(token.id);
            jQuery('#<?php print $form['#id']; ?>').submit();
        }
    });

    jQuery('#<?php print $form['#id']; ?> input[type=submit]').on('click', function(e) {
        try {
            var field = jQuery('#<?php print $form['#id']; ?> #edit-amount');
        if(!field[0].checkValidity()) {
            field.addClass('error');
            field.prop('title', 'A number is required.');
            field.mouseover();
        } else {
            handler.open({
                amount: jQuery('#<?php print $form['#id']; ?> input[name=amount]').val() * 100
            });
        }
        } catch (e) {
            var i = 0;
        }
        e.preventDefault();
    });

    jQuery(window).on('popstate', function() {
        handler.close();
    });
</script>
