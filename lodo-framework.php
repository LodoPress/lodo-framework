<?php
/**
 * Plugin Name:     Lodo Framework
 * Plugin URI:      http://lodothemes.com
 * Description:     Framework for the lodothemes ecosystem
 * Author:          Ryan Kanner
 * Author URI:      http://rkanner.com
 * Text Domain:     lodo-framework
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Lodo_Framework
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'LodoFramework' ) ) {

	/**
	 * Class LodoFramework
	 */
	final class LodoFramework {

		/**
		 * Stores the instance of the LodoFramework class
		 *
		 * @var LodoFramework Instance of the one and only LodoFramework class
		 * @since 0.1.0
		 * @access private
		 */
		private $instance;

		/**
		 * Creates the single instance of the LodoFramework class
		 *
		 * @return object|LodoFramework
		 * @since 0.1.0
		 * @access public
		 */
		public function run() {

			if ( ! isset( $this->instance ) && ( ! $this->instance instanceof LodoFramework ) ) {
				$this->instance = new LodoFramework();
				$this->setup_constants();
				$this->includes();
				$this->load();

				/**
				 * Fire the init hook for the framework
				 *
				 * @param LodoFramework $instance The instance of the LodoFramework class.
				 */
				do_action( 'Lodoframework_init', $this->instance );
				
			}

			return $this->instance;

		}

		/**
		 * Throw error on object clone.
		 * The whole idea of the singleton design pattern is that there is a single object
		 * therefore, we don't want the object to be cloned.
		 *
		 * @since  0.1.0
		 * @access public
		 * @return void
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'The LodoFramework class should not be cloned.', 'lodo-framework' ), '0.1.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @since  0.1.0
		 * @access protected
		 * @return void
		 */
		public function __wakeup() {
			// De-serializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'De-serializing instances of the LodoFramework class is not allowed', 'lodo-framework' ), '0.1.0' );
		}

		/**
		 * Defines some global constants for use throughout the codebase
		 *
		 * @access private
		 * @since 0.1.0
		 * @return void
		 */
		private function setup_constants() {

			if ( ! defined( 'LODOFRAMEWORK_VERSION' ) ) {
				define( 'LODOFRAMEWORK_VERSION', '0.1.0' );
			}

			if ( ! defined( 'LODOFRAMEWORK_PLUGIN_DIR' ) ) {
				define( 'LODOFRAMEWORK_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			}

			if ( ! defined( 'LODOFRAMEWORK_PLUGIN_URL' ) ) {
				define( 'LODOFRAMEWORK_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}

			if ( ! defined( 'LODOFRAMEWORK_PLUGIN_FILE' ) ) {
				define( 'LODOFRAMEWORK_PLUGIN_FILE', __FILE__ );
			}

		}

		/**
		 * Include autoloader files
		 *
		 * @access private
		 * @since 0.1.0
		 * @return void
		 */
		private function includes() {

			// Included the autoloader
			require_once( LODOFRAMEWORK_PLUGIN_DIR . 'vendor/autoload.php' );

		}

		/**
		 * Initiates the load process
		 *
		 * @access private
		 * @since 0.1.0
		 * @return void
		 */
		private function load() {
			new \LodoFramework\Load();
			new \LodoFramework\Install();
		}

	}
}

function LodoFramework() {
	$framework_instance = new LodoFramework();
	$framework_instance->run();
	return $framework_instance;
}
// Initialize the main class on the after_setup_theme hook
add_action( 'after_setup_theme', 'LodoFramework' );
