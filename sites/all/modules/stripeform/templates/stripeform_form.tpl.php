<?php print drupal_render_children($form) ?>
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
        handler.open({
            amount: jQuery('#<?php print $form['#id']; ?> input[name=amount]').val() * 100
        });
        e.preventDefault();
    });

    jQuery(window).on('popstate', function() {
        handler.close();
    });
</script>
