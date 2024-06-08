<?php

/**
 * Plugin Name: Woo Product Sync
 * Plugin URI: https://kaveeshanirooshan.com/plugins/
 * Description: Sync woocommerce products between two websites.
 * Version: 1.0.0
 * Author: Kaveesha Nirooshan
 * Author URI: https://kaveeshanirooshan.com/plugins/
 * Requires at least: 6.3
 * Requires PHP: 7.4
 */

 
 //check unauthorized access
 defined('ABSPATH') or die('Unauthorized Access!');

 //check if woocommerce is active
 if(!class_exists('WooCommerce')){
    //display notice and die
    add_action('admin_notices', 'woocommerce_not_active_notice');
    function woocommerce_not_active_notice(){
        echo '<div class="notice notice-error is-dismissible">
                <p>WooCommerce is not active. Please activate WooCommerce to use this plugin.</p>
            </div>';
    }
    return;
 }

 //include the main class
 class Woo_Product_Sync{

    public function __construct(){

        //add admin menu
        add_action('admin_menu', array($this, 'add_admin_menu'));

        //set options
        $this->options = [
            'client_id' => get_option('wps_client_id'),
            'client_secret' => get_option('wps_client_secret'),
            'sender_url' => get_option('wps_sender_url'),
        ];
    }

    //add admin menu
    public function add_admin_menu(){

        //main page
        add_menu_page(
            'Woo Product Sync',
            'Woo Product Sync',
            'manage_options',
            'woo-product-sync',
            array($this, 'admin_page'),
            'dashicons-update',
        );

        //send products page
        add_menu_page(
            'Send Products',
            'Send Products',
            'manage_options',
            'woo-product-sync-send',
            array($this, 'send_products_page'),
            'dashicons-update',
        );

        //receive products page
        add_menu_page(
            'Receive Products',
            'Receive Products',
            'manage_options',
            'woo-product-sync-receive',
            array($this, 'receive_products_page'),
            'dashicons-update',
        );
    }

    //register actions
    public function register_actions(){

        //recieve products
        add_action('wp_ajax_receive_products', array($this, 'receive_products'));
        add_action('wp_ajax_nopriv_receive_products', array($this, 'receive_products'));

        //send products
        add_action('wp_ajax_send_products', array($this, 'send_products'));
        add_action('wp_ajax_nopriv_send_products', array($this, 'send_products'));

        //admin menu pages
        add_action('admin_menu', array($this, 'add_admin_menu'));
    }

    //receive products, include the function file
    public function receive_products(){
        require_once plugin_dir_path(__FILE__) . 'includes/receive-products.php';
    }

    //send products, include the function file
    public function send_products(){
        require_once plugin_dir_path(__FILE__) . 'includes/send-products.php';
    }


    //main page
    public function admin_page(){
        require_once plugin_dir_path(__FILE__) . 'templates/main-page.php';
    }

    //send products page
    public function send_products_page(){
        require_once plugin_dir_path(__FILE__) . 'templates/send-products.php';
    }

    //receive products page
    public function receive_products_page(){
        require_once plugin_dir_path(__FILE__) . 'templates/receive-products.php';
    }

    //register options
    add_option('wps_client_id', '');
    add_option('wps_client_secret', '');
    add_option('wps_sender_url', '');

    //generate sender client id & secret
    public function generate_client_id_secret(){
        $client_id = bin2hex(random_bytes(16));
        $client_secret = bin2hex(random_bytes(16));

        //add new options
        add_option('wps_sender_client_id', $client_id);
        add_option('wps_sender_client_secret', $client_secret);
    }

 }

 //initialize the class
$woo_product_sync = new Woo_Product_Sync();
$woo_product_sync->register_actions();
$woo_product_sync->generate_client_id_secret();