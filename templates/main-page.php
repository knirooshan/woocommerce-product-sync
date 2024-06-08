<!-- WPS settings page -->

<!-- page heading -->
<h1>Woo Product Sync Settings</h1>

<div class="wrap">
    <h1>Woo Product Sync Settings</h1>
    <form method="post" action="options.php">
        <label for="wps_client_id">Client ID</label>
        <input type="text" name="wps_client_id" value="<?php echo esc_attr(get_option('wps_client_id')); ?>" />
        <br>
        <label for="wps_client_secret">Client Secret</label>
        <input type="text" name="wps_client_secret" value="<?php echo esc_attr(get_option('wps_client_secret')); ?>" />
        <br>
        <label for="wps_sender_url">Sender URL</label>
        <!-- add a small notice -->
        <p>Only fill this fieds in receiver website</p>
        <input type="text" name="wps_sender_url" value="<?php echo esc_attr(get_option('wps_sender_url')); ?>" />
        <br>
        <?php submit_button(); ?>
    </form>
</div>