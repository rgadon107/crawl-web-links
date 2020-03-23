<?php
/**
 * Crawl Web Links plugin
 *
 * @package     spiralWebDb\wpMedia
 * @author      Robert A. Gadon
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name:         Crawl Web Links
 * Plugin URI:          https://github.com/rgadon107/web-links
 * Description:         A WordPress plugin to crawl a site's internal hyperlinks, store the data, and report it.
 * Version:             1.0.0
 * Requires at least:   5.0
 * Requires PHP:        5.6
 * Author:              Robert A. Gadon
 * Author URI:          https://spiralwebdb.com
 * Text Domain:         web-links
 * License:             GPL-2.0+
 * License URI:         http://www.gnu.org/licenses/gpl-2.0.txt
 */

namespace spiralWebDb\wpMedia;

/**
 * Gets this plugin's absolute directory path.
 *
 * @since  1.0.0
 * @ignore
 * @access private
 *
 * @return string
 */
function _get_plugin_directory() {
	return __DIR__;
}

/**
 * Gets this plugin's URL.
 *
 * @since  1.0.0
 * @ignore
 * @access private
 *
 * @return string
 */
function _get_plugin_url() {
	static $plugin_url;

	if ( empty( $plugin_url ) ) {
		$plugin_url = plugins_url( null, __FILE__ );
	}

	return $plugin_url;
}

/**
 * Checks if this plugin is in development mode.
 *
 * @since  1.0.0
 * @ignore
 * @access private
 *
 * @return bool
 */
function _is_in_development_mode() {
	return defined( WP_DEBUG ) && WP_DEBUG === true;
}

/*
 *  Registers the plugin with WordPress activation, deactivation, and uninstall hooks.
 *
 *  @since 1.0.0
 *
 *  @return void
 */
function register_plugin() {

	register_activation_hook( __FILE__, __NAMESPACE__ . '\delete_rewrite_rules' );
	register_deactivation_hook( __FILE__, __NAMESPACE__ . '\delete_rewrite_rules' );
	register_uninstall_hook( __FILE__, __NAMESPACE__ . '\delete_rewrite_rules' );
}

/**
 * Deletes the rewrite rules option.
 *
 * @since 1.0.0
 */
function delete_rewrite_rules() {
	delete_option( 'rewrite_rules' );
}

/**
 * Autoload the plugin's files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function autoload_files() {
	$files = [

	];

	foreach ( $files as $file ) {
		require __DIR__ . '/src/' . $file;
	}
}

/**
 * Launch the plugin.
 *
 * @since 1.0.0
 *
 * @return void
 */
function launch() {
	autoload_files();
	register_plugin();

}

launch();
