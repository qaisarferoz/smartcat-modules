<?php

class SmartcatModulesPlugin {

    const DEVMODE = TRUE;
    const VERSION = 1.0;

    private static $instance; 
    private $options;

    /**
     * Initial Instantiation
     * 
     * @since 1.0
     */
    public static function instance() {

        if ( !self::$instance ) :

            self::$instance = new self;
            self::$instance->get_options();
            self::$instance->add_hooks();
            self::$instance->setup_modules();

        endif;

    }

    /**
     * 
     * Runs when the plugin has been activated
     * 
     * @since 1.0
     * @return void 
     */
    public static function activate() {

        // Declare $options array
        $options = array (

            // ...
            
        );

        // If $options doesn't exist in wp_options, set it
        if ( ! get_option( 'smartcat_modules_options' ) ) :

            add_option( 'smartcat_modules_options', $options );
            update_option( 'smartcat_modules_options', $options );

        else  :

            $options = get_option( 'smartcat_modules_options' );
            update_option( 'smartcat_modules_options', $options );
            
        endif;
        
    }

    /**
     * 
     * Runs when the plugin is de-activated
     * 
     * @since 1.0
     * @return void
     */
    public static function deactivate() {

        // Delete options upon deactivation of the plugin
        // but only do so if DEVMODE is on!
        if( self::DEVMODE ) :
            
            delete_option( 'smartcat_modules_options' );

        endif;

    }

    /**
     * Updates the class options parameter from the settings stored in WP
     * 
     * @since 1.0
     * @return void
     * 
     */
    private function get_options() {

        if ( get_option( 'smartcat_modules_options' ) ) :
            $this->options = get_option( 'smartcat_modules_options' );
        endif;

    }
    
    /**
     * Plugin hook references go here
     * 
     * @since 1.0
     * @return void
     */
    private function add_hooks() {

        // Set up Plugin Menu & Submenu pages
        add_action( 'admin_menu',               array( $this, 'create_dashboard_menu' ) );

        // Enqueue Scripts & Styles
        add_action( 'admin_enqueue_scripts',    array( $this, 'enqueue_admin_styles_scripts' ) );
        add_action( 'wp_enqueue_scripts',       array( $this, 'enqueue_wp_styles_scripts' ) );
        
    }

    /**
     * 
     * 
     * 
     * @since 1.0
     */
    private function setup_modules() {

        $modules = new SmartcatModulesLoader( $this->get_theme_modules_array() );
        
    }
    
    /**
     * Return an array of strings, one for each theme mod module that is enabled / toggled ON
     * 
     * @since 1.0
     * @return array
     */
    private function get_theme_modules_array() {
        
        return array (

//            get_theme_mod( 'smartcat_toggle_call_to_action', 'include' )  == 'exclude' ? null : 'call_to_action',
//            get_theme_mod( 'smartcat_toggle_contact_form', 'include' )    == 'exclude' ? null : 'contact_form',
//            get_theme_mod( 'smartcat_toggle_contact_info', 'include' )    == 'exclude' ? null : 'contact_info',
//            get_theme_mod( 'smartcat_toggle_events', 'include' )          == 'exclude' ? null : 'event',
//            get_theme_mod( 'smartcat_toggle_faqs', 'include' )            == 'exclude' ? null : 'faq',
//            get_theme_mod( 'smartcat_toggle_gallery', 'include' )         == 'exclude' ? null : 'gallery',
//            get_theme_mod( 'smartcat_toggle_news', 'include' )            == 'exclude' ? null : 'news',
//            get_theme_mod( 'smartcat_toggle_pricing_table', 'include' )   == 'exclude' ? null : 'pricing_table',
//            get_theme_mod( 'smartcat_toggle_service', 'include' )         == 'exclude' ? null : 'service',
//            get_theme_mod( 'smartcat_toggle_testimonials', 'include' )    == 'exclude' ? null : 'testimonial',
            
        );
        
    }

    /**
     * 
     * Creates the plugin's Dashboard menu
     * 
     * @since 1.0
     * @return void
     */
    public function create_dashboard_menu() {
        
        $modules = $this->get_theme_modules_array();
        
        // Add the Main "Modules" menu item
        add_menu_page( 'Modules', 'Modules', 'manage_options', 'modules', array( $this, 'display_main_plugin_view' ), SMARTCAT_MODULES_URL . 'admin/felix_icon.png' );
     
        // Add all of the appropriate CPT module menu items that are enabled through Customizer
        
        if ( in_array( 'event', $modules ) ) :
            add_submenu_page( 'modules', 'Events', 'Events', 'manage_options', 'edit.php?post_type=event', NULL );
        endif;

        if ( in_array( 'faq', $modules ) ) :
            add_submenu_page( 'modules', 'FAQs', 'FAQs', 'manage_options', 'edit.php?post_type=faq', NULL );
        endif;

        if ( in_array( 'gallery', $modules ) ) :
            add_submenu_page( 'modules', 'Gallery Items', 'Gallery Items', 'manage_options', 'edit.php?post_type=gallery', NULL );
        endif;

        if ( in_array( 'news', $modules ) ) :
            add_submenu_page( 'modules', 'News', 'News', 'manage_options', 'edit.php?post_type=news', NULL );
        endif;

        if ( in_array( 'service', $modules ) ) :
            add_submenu_page( 'modules', 'Services', 'Services', 'manage_options', 'edit.php?post_type=service', NULL );
        endif;

        if ( in_array( 'testimonial', $modules ) ) :
            add_submenu_page( 'modules', 'Testimonials', 'Testimonials', 'manage_options', 'edit.php?post_type=testimonial', NULL );
        endif;
        
    }
    
    /**
     * 
     * Load CSS & JS for the admin dashboard
     * 
     * @since 1.0
     * @return void
     */
    public function enqueue_admin_styles_scripts() {

        $curr_page = esc_url( $_SERVER['REQUEST_URI'] );
        
        if ( strpos( $curr_page, '?page=modules' ) !== false ) : 
            
            wp_enqueue_style( 'smartcat-modules-admin-style', SMARTCAT_MODULES_URL . 'admin/modules_admin.css', NULL, self::VERSION );
            wp_enqueue_script( 'smartcat-modules-admin-js', SMARTCAT_MODULES_URL . 'admin/modules_admin.js', NULL, self::VERSION );
            
            wp_localize_script( 'smartcat-modules-admin-js', 'smartcat_ajax', array( 
                'ajax_url' => admin_url( 'admin-ajax.php' ), 
                'we_value' => 1234 
                ) 
            );
            
        endif;
        
    }

    /**
     * 
     * Load CSS & JS for the front-end
     * 
     * @since 1.0
     * @return void
     */
    public function enqueue_wp_styles_scripts() {
        
        wp_enqueue_style( 'smartcat-portfolio-main-style', SMARTCAT_MODULES_URL . 'inc/assets/styles/modules.css', NULL, self::VERSION );
        wp_enqueue_script( 'smartcat-portfolio-main-js', SMARTCAT_MODULES_URL . 'inc/assets/scripts/modules.js', NULL, self::VERSION );
        
    }

    /**
     * 
     * Loads the plugin's main admin page
     * 
     * @since 1.0
     * @return void
     */
    public function display_main_plugin_view() {

        include_once SMARTCAT_MODULES_PATH . 'admin/views/settings.php';

    }
    
    /**
     * 
     * Loads the plugin's main documentation page
     * 
     * @since 1.0
     * @return void
     */    
    public function display_documentation_view() {

        include_once SMARTCAT_MODULES_PATH . 'admin/views/documentation.php';

    }

}
    
    
    

