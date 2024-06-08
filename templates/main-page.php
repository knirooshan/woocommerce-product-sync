<!-- WPS settings page -->

<div class="wrap">
    <!-- page heading -->
    <h1>Woo Product Sync Settings</h1>
    <form method="post" action="options.php">
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="wps_client_id">Client ID</label></th>
                <td><input type="text" id="wps_client_id" name="wps_client_id" class="regular-text" value="<?php echo esc_attr(get_option('wps_client_id')); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wps_client_secret">Client Secret</label></th>
                <td><input type="text" id="wps_client_secret" name="wps_client_secret" class="regular-text" value="<?php echo esc_attr(get_option('wps_client_secret')); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wps_sender_url">Sender URL</label></th>
                <td>
                    <input type="text" id="wps_sender_url" name="wps_sender_url" class="regular-text" value="<?php echo esc_attr(get_option('wps_sender_url')); ?>" />
                    <p class="description">Only fill this field on the receiver website</p>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wps_sender_client_id">Sender Client ID</label></th>
                <td><input type="text" id="wps_sender_client_id" name="wps_sender_client_id" class="regular-text" value="<?php echo esc_attr(get_option('wps_sender_client_id')); ?>" readonly /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wps_sender_client_secret">Sender Client Secret</label></th>
                <td><input type="text" id="wps_sender_client_secret" name="wps_sender_client_secret" class="regular-text" value="<?php echo esc_attr(get_option('wps_sender_client_secret')); ?>" readonly /></td>
            </tr>
        </table>

        <?php submit_button(); ?>
    </form>
</div>