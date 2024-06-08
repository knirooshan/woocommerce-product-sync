<?php

//get all the products and store them in a json file locally
function wps_export_products_to_json()
{
    // Check if WooCommerce is active
    if (!class_exists('WooCommerce')) {
        return new WP_Error('woocommerce_inactive', 'WooCommerce is not active.');
    }

    // Get the uploads directory
    $upload_dir = wp_upload_dir();
    $upload_path = $upload_dir['basedir'] . '/woo-product-sync';

    // Create the directory if it doesn't exist
    if (!file_exists($upload_path)) {
        wp_mkdir_p($upload_path);
    }

    $file_name = get_option('wps_filename') . '.json';

    // Define the file path
    $file_path = $upload_path . '/' . $file_name;

    // Initialize an empty array to store product data
    $products_data = array();

    // Get all products
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => -1,
    );
    $products = new WP_Query($args);

    // Check if there are products
    if ($products->have_posts()) {
        while ($products->have_posts()) {
            $products->the_post();
            $product_id = get_the_ID();
            $product = wc_get_product($product_id);

            // Get product data
            $product_data = $product->get_data();

            // Add categories and tags to product data
            $product_data['categories'] = wp_get_post_terms($product_id, 'product_cat', array('fields' => 'names'));
            $product_data['tags'] = wp_get_post_terms($product_id, 'product_tag', array('fields' => 'names'));

            // Add image URLs to product data
            $product_data['images'] = array();

            //add thumbnail url to product data['images']
            $thumbnail_id = get_post_thumbnail_id($product_id);
            array_push($product_data['images'], wp_get_attachment_url($thumbnail_id));

            foreach ($product->get_gallery_image_ids() as $image_id) {
                array_push($product_data['images'], wp_get_attachment_url($image_id));
            }

            //remove category ids, image ids, and tag ids from array
            unset($product_data['category_ids']);
            unset($product_data['image_id']);
            unset($product_data['tag_ids']);
            unset($product_data['gallery_image_ids']);

            // Add product data to the array
            $products_data[] = $product_data;
        }
        wp_reset_postdata();
    }

    // Convert the products data to JSON format
    $json_data = json_encode($products_data, JSON_PRETTY_PRINT);

    // Store the JSON data in a file
    if (file_put_contents($file_path, $json_data) === false) {
        return new WP_Error('file_write_error', 'Failed to write to file.');
    }
}

wps_export_products_to_json();