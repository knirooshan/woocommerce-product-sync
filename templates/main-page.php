<!-- WPS settings page -->

<div class="wrap">
    <!-- page heading -->
    <h1>Woo Product Sync Settings</h1>
    <form method="post" action="options.php">
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="wps_client_id">File Name</label></th>
                <td>
                    <input type="text" id="wps_client_id" name="wps_client_id" class="regular-text" value="<?php echo esc_attr(get_option('wps_filename')); ?>" />
                    <p class="description">Only fill this field on the receiver website</p>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wps_sender_url">Sender URL</label></th>
                <td>
                    <input type="text" id="wps_sender_url" name="wps_sender_url" class="regular-text" value="<?php echo esc_attr(get_option('wps_sender_url')); ?>" />
                    <p class="description">Only fill this field on the receiver website</p>
                </td>
            </tr>
        </table>

        <?php submit_button(); ?>
    </form>
</div>