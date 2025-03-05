<?php
if (!defined('WP_UNINSTALL_PLUGIN')) exit;

global $wpdb;
$table_name = $wpdb->prefix . 'candidate_scores';

// Drop the custom table
$wpdb->query("DROP TABLE IF EXISTS $table_name");