<?php
/*
Plugin Name: Candidate Scoring Plugin
Description: Admin-only candidate scoring system with weighted calculations.
Version: 1.0
Author: Your Name
*/

defined('ABSPATH') or die('No script kiddies please!');

// Constants
define('CSP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('CSP_PLUGIN_URL', plugin_dir_url(__FILE__));

// Database and form handlers
require_once CSP_PLUGIN_DIR . 'includes/class-db-handler.php';
require_once CSP_PLUGIN_DIR . 'includes/form-processor.php';

// Activation hook
register_activation_hook(__FILE__, ['CSP_DB_Handler', 'create_tables']);

// Admin menu
add_action('admin_menu', 'csp_add_admin_menu');
function csp_add_admin_menu() {
    add_menu_page(
        'Candidate Scoring',
        'Candidate Scoring',
        'manage_options', // Change capability here if needed
        'candidate-scoring',
        'csp_admin_page_display',
        'dashicons-clipboard',
        30
    );
}

// Admin assets
add_action('admin_enqueue_scripts', 'csp_admin_assets');
function csp_admin_assets($hook) {
    if ('toplevel_page_candidate-scoring' !== $hook) return;
    
    wp_enqueue_style(
        'csp-admin-style',
        CSP_PLUGIN_URL . 'admin/css/admin-style.css'
    );
    
    wp_enqueue_script(
        'csp-admin-script',
        CSP_PLUGIN_URL . 'admin/js/admin-script.js',
        ['jquery'],
        '1.0',
        true
    );
}

// Admin page renderer
function csp_admin_page_display() {
    ob_start();
    include CSP_PLUGIN_DIR . 'admin/partials/admin-display.php';
    echo ob_get_clean();
}