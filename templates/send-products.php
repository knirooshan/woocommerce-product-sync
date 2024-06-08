<!-- Page heading -->
<h1 class="h3 mb-2 text-gray-800">Send Products</h1>

<!-- Page content -->
<div class="notice notice-info">
    <p>Use the following details to receive products on another website:</p>
    <!-- if filename is empty, mention to send products first -->
    <?php if (empty(get_option('wps_filename'))) : ?>
        <p><strong>File Name:</strong> Please send products first. then refresh this page to get the filename.</p>
    <?php endif; ?>
    <!-- if filename is not empty, display the filename -->
    <?php if (!empty(get_option('wps_filename'))) : ?>
        <p><strong>File Name:</strong> <?php echo get_option('wps_filename'); ?></p>
    <?php endif; ?>
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