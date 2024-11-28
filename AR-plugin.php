<?php
/**
 * Plugin Name: AR-plugin
 * Description: AR-plugin for woocommerce products
 * Version: 1.62
 * Author: George Kapanadze
 */

define('AR_VERSION', '5.0.0');
define('AR_URI', plugin_dir_url(__FILE__));

// Подключение файлов
require_once __DIR__ . '/includes/enqueue-scripts.php';
require_once __DIR__ . '/includes/admin-fields.php';
require_once __DIR__ . '/includes/frontend-render.php';
require_once __DIR__ . '/includes/settings-page.php';

// Хуки и фильтры
add_action('wp_enqueue_scripts', 'ar_plugin_assets');
add_action('woocommerce_product_options_general_product_data', 'ar_plugin_add_custom_fields');
add_action('woocommerce_process_product_meta', 'ar_plugin_custom_fields_save');
add_action(get_option('simple_wooc'), 'insert_ar_block');
add_action('generate_before_footer', 'insert_ar_block_scripts');
add_action('generate_before_footer', 'insert_ar_block_styles');
