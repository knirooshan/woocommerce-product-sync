<!-- Page heading -->
<h1 class="h3 mb-2 text-gray-800">Send Products</h1>

<!-- Page content -->
<div class="notice notice-info">
    <p>Use the following credentials to receive products on another website:</p>
    <p><strong>Client ID:</strong> <?php echo esc_html(get_option('wps_sender_client_id')); ?></p>
    <p><strong>Client Secret:</strong> <?php echo esc_html(get_option('wps_sender_client_secret')); ?></p>
</div>

<!-- Sync button -->
<form method="post">
    <input type="submit" id="sync-button" name="sync_products" value="Send Products" class="button button-primary">
</form>

<!--send ajax request-->
<script>
    //send products
    jQuery(document).ready(function($) {
        $('#sync-button').click(function() {
            //send ajax request
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'post',
                data: {
                    action: 'send_products',
                },
            });
        });
    });
</script>