<!-- Page heading -->
<h1 class="h3 mb-2 text-gray-800">Send Products</h1>

<!-- page content -->
<!-- show sender client id & secret here -->
<p>Use following credentials to receice produxts on other website</p>
<p>Client ID: <?php echo get_option('wps_sender_client_id'); ?></p>
<p>Client Secret: <?php echo get_option('wps_sender_client_secret'); ?></p>

<!-- sync button -->
<form method="post">
    <input type="submit" id="sync-button" name="sync_products" value="Sync Products" class="button button-primary">
</form>

<!--send ajax request-->
<script>
    //send products
    jQuery(document).ready(function($){
        $('#sync-button').click(function(){
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