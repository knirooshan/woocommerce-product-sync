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
if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    //show a notice and return
    add_action('admin_notices', 'wps_woocommerce_not_active_notice');
    function wps_woocommerce_not_active_notice()
    {
        echo '<div class="notice notice-error is-dismissible">
            <p>WooCommerce is not active. Please activate WooCommerce to use this plugin.</p>
        </div>';
    }
    return;
}

//include the main class
class Woo_Product_Sync
{

    public function __construct()
    {

        //add admin menu
        add_action('admin_menu', array($this, 'add_admin_menu'));

        //activation hook
        register_activation_hook(__FILE__, array($this, 'activate'));

        //set options
        $this->options = [
            'client_id' => get_option('wps_client_id'),
            'client_secret' => get_option('wps_client_secret'),
            'sender_url' => get_option('wps_sender_url'),
            'sender_client_id' => get_option('wps_sender_client_id'),
            'sender_client_secret' => get_option('wps_sender_client_secret'),
        ];
    }

    //add admin menu
    public function add_admin_menu()
    {

        //main page
        add_menu_page(
            'Woo Product Sync',
            'Woo Product Sync',
            'manage_options',
            'woo-product-sync',
            array($this, 'admin_page'),
            'dashicons-update',
        );

        //send products submenu page
        add_submenu_page(
            'woo-product-sync',
            'Send Products',
            'Send Products',
            'manage_options',
            'send-products',
            array($this, 'send_products_page'),
        );

        //receive products submenu page
        add_submenu_page(
            'woo-product-sync',
            'Receive Products',
            'Receive Products',
            'manage_options',
            'receive-products',
            array($this, 'receive_products_page'),
        );
    }

    //register setting fields
    public function register_settings()
    {
        add_option('wps_client_id', '');
        add_option('wps_client_secret', '');
        add_option('wps_sender_url', '');
        add_option('wps_sender_client_id', '');
        add_option('wps_sender_client_secret', '');
    }

    // Activation hook: generate keys if they don't exist
    public function activate()
    {
        if (false === get_option('wps_sender_client_id')) {
            $sender_client_id = bin2hex(random_bytes(16)); // 32 characters
            update_option('wps_sender_client_id', $sender_client_id);
        }
        if (false === get_option('wps_sender_client_secret')) {
            $sender_client_secret = bin2hex(random_bytes(16)); // 32 characters
            update_option('wps_sender_client_secret', $sender_client_secret);
        }
    }

    //register actions
    public function register_actions()
    {

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
    public function receive_products()
    {
        require_once plugin_dir_path(__FILE__) . 'includes/receive-products.php';
    }

    //send products, include the function file
    public function send_products()
    {
        require_once plugin_dir_path(__FILE__) . 'includes/send-products.php';
    }


    //main page
    public function admin_page()
    {
        require_once plugin_dir_path(__FILE__) . 'templates/main-page.php';
    }

    //send products page
    public function send_products_page()
    {
        require_once plugin_dir_path(__FILE__) . 'templates/send-products.php';
    }

    //receive products page
    public function receive_products_page()
    {
        require_once plugin_dir_path(__FILE__) . 'templates/receive-products.php';
    }
}

//initialize the class
$woo_product_sync = new Woo_Product_Sync();
$woo_product_sync->register_actions();
$woo_product_sync->register_settings();
