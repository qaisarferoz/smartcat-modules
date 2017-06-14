<?php
/*
 * Plugin Name: Smartcat Modules
 * Plugin URI: http://smartcatdesign.net/
 * Description: Smartcat Modules adds custom widgets and post types to your website.
 * Version: 1.0.1
 * Author: Smartcat
 * Author URI: https://smartcatdesign.net
 * License: GPL v2
 * Text Domain: smartcat-modules
 * Domain Path: /languages 
 * 
 * @author          Bilal Hassan    <bilal@smartcat.ca>
 * @author          Zack Mitchell   <zack@smartcat.ca>
 * @date            October 26, 2016
 * @update          October 26, 2016
 * @copyright       Smartcat Design <https://smartcatdesign.net>
 * 
 */

// Exit if accessed directly for security
if( !defined( 'ABSPATH' ) ) {
    die;
}

// Assign the PATH & URL of the plugin to global variables
if ( !defined( 'SMARTCAT_MODULES_PATH' ) )
    define( 'SMARTCAT_MODULES_PATH', plugin_dir_path( __FILE__ ) );
if ( !defined( 'SMARTCAT_MODULES_URL' ) )
    define( 'SMARTCAT_MODULES_URL' , plugin_dir_url( __FILE__ ) );

// Include all general class files
foreach( glob( SMARTCAT_MODULES_PATH . 'inc/class/*.php' ) as $file ) :
    require_once $file;
endforeach;

// Include all Widget Class files
foreach( glob( SMARTCAT_MODULES_PATH . 'inc/modules/widgets/*.php' ) as $widget_class_file ) :
    require_once $widget_class_file;
endforeach;

// Activation & deactivation Hooks
// The functions referenced run upon activation and deactivation of the plugin
register_activation_hook( __FILE__, array( 'SmartcatModulesPlugin', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'SmartcatModulesPlugin', 'deactivate' ) );

/**
 * 
 * Set plugin localization string
 * 
 * @since 1.0
 * @return void
 * 
 */
function smartcat_modules_localize() {

    load_plugin_textdomain( 'smartcat-modules', FALSE, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

}
add_action( 'init', 'smartcat_modules_localize' );

// Call the plugin class static method, instance()
//SmartcatModulesPlugin::instance();
