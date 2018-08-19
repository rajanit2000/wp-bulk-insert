<?php

/**
 * The plugin bootstrap file.
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       WP Bulk Insert
 * Plugin URI:        http://example.com/wp-bulk-insert/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Rajan V
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-bulk-insert
 * Domain Path:       /languages
 */

namespace WPBulkInsert;

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// We load Composer's autoload file
require_once plugin_dir_path(__FILE__).'vendor/autoload.php';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-bulk-insert-activator.php.
 */
function activate_wp_bulk_insert()
{
    utils\Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-bulk-insert-deactivator.php.
 */
function deactivate_wp_bulk_insert()
{
    utils\Deactivator::deactivate();
}

register_activation_hook(__FILE__, '\WPBulkInsert\activate_wp_bulk_insert');
register_deactivation_hook(__FILE__, '\WPBulkInsert\deactivate_wp_bulk_insert');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 1.0.0
 */
function run_wp_bulk_insert()
{
    $plugin = new Main();
    $plugin->run();
}
run_wp_bulk_insert();
