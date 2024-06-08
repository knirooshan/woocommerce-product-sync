<!-- Page heading -->
<h1 class="h3 mb-2 text-gray-800">Receive Products</h1>

<!-- notice -->
<p>After filling the settings in options page, click below button to sync products.</p>

<!-- sync button -->
<form method="post">
    <input type="submit" id="sync-button" name="sync_products" value="Sync Products" class="button button-primary">
</form>

<!-- call functions.php file -->
<script>
    //check all settings fields are filled or not
    function check_settings(){
        var client_id = '<?php echo get_option('wps_client_id'); ?>';
        var client_secret = '<?php echo get_option('wps_client'); ?>';
        var sender_url = '<?php echo get_option('wps_sender_url'); ?>';

        //check if any field is empty
        if(client_id == '' || client_secret == '' || sender_url == ''){
            alert('Please fill all settings fields first.');
            return false;
        }

        return true;
    }

    //sync products
    jQuery(document).ready(function($){
        $('#sync-button').click(function(){
            //check settings
            if(!check_settings()){
                //display error and return
                alert('Please fill all settings fields first.');
                return;
            }

            //send ajax request
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'post',
                data: {
                    action: 'receive_products',
                },
                success: function(response){
                    alert(response);
                }
            });
        });
    });
</script>