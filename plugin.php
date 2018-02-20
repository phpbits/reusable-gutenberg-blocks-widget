<?php
/**
 * Plugin Name: Gutenberg Reusable Blocks Widget
 * Plugin URI: https://widget-options.com/
 * Description: Display Gutenberg saved reusable blocks anywhere via widget.
 * Version: 1.0
 * Author: Phpbits Creative Studio
 * Author URI: https://phpbits.net/
 *
 * @category Widgets
 * @author Jeffrey Carandang
 * @version 1.0
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'WP_Gutenberg_Reusable_Blocks_Widgets' ) ) :

/**
 * Main WP_Gutenberg_Reusable_Blocks_Widgets Class.
 *
 * @since 1.0
 */
final class WP_Gutenberg_Reusable_Blocks_Widgets {
	/**
	 * @var WP_Gutenberg_Reusable_Blocks_Widgets The one true WP_Gutenberg_Reusable_Blocks_Widgets
	 * @since 1.0
	 */
	private static $instance;

	/**
	 * Main WP_Gutenberg_Reusable_Blocks_Widgets Instance.
	 *
	 * Insures that only one instance of WP_Gutenberg_Reusable_Blocks_Widgets exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @since 1.0
	 * @static
	 * @staticvar array $instance
	 * @uses WP_Gutenberg_Reusable_Blocks_Widgets::setup_constants() Setup the constants needed.
	 * @uses WP_Gutenberg_Reusable_Blocks_Widgets::includes() Include the required files.
	 * @see WIDGETOPTS()
	 * @return object|WP_Gutenberg_Reusable_Blocks_Widgets The one true WP_Gutenberg_Reusable_Blocks_Widgets
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof WP_Gutenberg_Reusable_Blocks_Widgets ) ) {
			self::$instance = new WP_Gutenberg_Reusable_Blocks_Widgets;
			self::$instance->setup_constants();

			// add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );

			self::$instance->includes();
			// self::$instance->roles         = new WIDGETOPTS_Roles();
		}
		return self::$instance;
	}

	/**
	 * Setup plugin constants.
	 *
	 * @access private
	 * @since 1.0
	 * @return void
	 */
	private function setup_constants() {

		// Plugin version.
		if ( ! defined( 'GUTENRBW_PLUGIN_NAME' ) ) {
			define( 'GUTENRBW_PLUGIN_NAME', 'Gutenberg Reusable Blocks Widget' );
		}

		// Plugin version.
		if ( ! defined( 'GUTENRBW_VERSION' ) ) {
			define( 'GUTENRBW_VERSION', '1.0' );
		}

		// Plugin Folder Path.
		if ( ! defined( 'GUTENRBW_PLUGIN_DIR' ) ) {
			define( 'GUTENRBW_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin Folder URL.
		if ( ! defined( 'GUTENRBW_PLUGIN_URL' ) ) {
			define( 'GUTENRBW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		// Plugin Root File.
		if ( ! defined( 'GUTENRBW_PLUGIN_FILE' ) ) {
			define( 'GUTENRBW_PLUGIN_FILE', __FILE__ );
		}
	}

	/**
	 * Include required files.
	 *
	 * @access private
	 * @since 1.0
	 * @return void
	 */
	private function includes() {
		// global $widget_options, $extended_license, $widgetopts_taxonomies, $widgetopts_pages, $widgetopts_types, $pagenow;
		// $widget_options = widgetopts_get_settings();

		require_once GUTENRBW_PLUGIN_DIR . 'includes/widget.php';
		require_once GUTENRBW_PLUGIN_DIR . 'includes/extras.php';

	}

}

endif; // End if class_exists check.


/**
 * The main function for that returns WP_Gutenberg_Reusable_Blocks_Widgets
 *
 * The main function responsible for returning the one true WP_Gutenberg_Reusable_Blocks_Widgets
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $gutenwidgets = WP_Gutenberg_Reusable_Blocks_Widgets(); ?>
 *
 * @since 1.0
* @return object|WP_Gutenberg_Reusable_Blocks_Widgets The one true WP_Gutenberg_Reusable_Blocks_Widgets Instance.
 */
if( !function_exists( 'GutenReusableBlocksWidgets' ) ){
	function GutenReusableBlocksWidgets() {
		return WP_Gutenberg_Reusable_Blocks_Widgets::instance();
	}
	add_action( 'plugins_loaded', 'GutenReusableBlocksWidgets', 90 );
}
?>
