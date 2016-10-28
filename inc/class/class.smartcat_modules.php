<?php

class SmartcatModulesPlugin {

    const DEVMODE = TRUE;
    const VERSION = 1.0;

    private static $instance; 
    private $modules;
    private $options;

    /**
     * Initial Instantiation
     * 
     * @since 1.0
     * @return void
     */
    public static function instance( $modules = null ) {

        if ( !self::$instance ) :

            self::$instance = new self;
            self::$instance->set_modules( $modules );
            self::$instance->get_options();
            self::$instance->add_hooks();
            self::$instance->setup_modules();

        endif;

    }

    /**
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
     * Sets the class modules list property
     * 
     * @since 1.0
     * @return void
     */
    private function set_modules( $modules = null ) {

        $this->modules = $modules; 

    }

    /**
     * Updates the class options parameter from the settings stored in WP
     * 
     * @since 1.0
     * @return void
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
     * Set up the modules based on the list of module strings
     * 
     * @since 1.0
     * @return void
     */
    private function setup_modules() {

        if ( !is_null( $this->modules ) ) :
            new SmartcatModulesLoader( $this->modules, self::VERSION );
        endif; 
    }

    /**
     * Creates the plugin's Dashboard menu
     * 
     * @since 1.0
     * @return void
     */
    public function create_dashboard_menu() {
        
        if ( !is_null( $this->modules ) ) :
        
            // Add the Main "Modules" menu item
            add_menu_page( 'Modules', 'Modules', 'manage_options', 'modules', array( $this, 'display_main_plugin_view' ), 'dashicons-layout' );

            // Add all of the appropriate CPT module menu items that are enabled through Customizer

            if ( in_array( 'client', $this->modules ) ) :
                add_submenu_page( 'modules', 'Clients', 'Clients', 'manage_options', 'edit.php?post_type=client', NULL );
            endif;

            if ( in_array( 'event', $this->modules ) ) :
                add_submenu_page( 'modules', 'Events', 'Events', 'manage_options', 'edit.php?post_type=event', NULL );
            endif;

            if ( in_array( 'faq', $this->modules ) ) :
                add_submenu_page( 'modules', 'FAQs', 'FAQs', 'manage_options', 'edit.php?post_type=faq', NULL );
            endif;

            if ( in_array( 'gallery', $this->modules ) ) :
                add_submenu_page( 'modules', 'Gallery Items', 'Gallery Items', 'manage_options', 'edit.php?post_type=gallery', NULL );
            endif;

            if ( in_array( 'news', $this->modules ) ) :
                add_submenu_page( 'modules', 'News', 'News', 'manage_options', 'edit.php?post_type=news', NULL );
            endif;

            if ( in_array( 'position', $this->modules ) ) :
                add_submenu_page( 'modules', 'Work History', 'Work History', 'manage_options', 'edit.php?post_type=position', NULL );
            endif;
            
            if ( in_array( 'project', $this->modules ) ) :
                add_submenu_page( 'modules', 'Projects', 'Projects', 'manage_options', 'edit.php?post_type=project', NULL );
            endif;
            
            if ( in_array( 'testimonial', $this->modules ) ) :
                add_submenu_page( 'modules', 'Testimonials', 'Testimonials', 'manage_options', 'edit.php?post_type=testimonial', NULL );
            endif;
            
        endif;
        
    }
    
    /**
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
     * Load CSS & JS for the front-end
     * 
     * @since 1.0
     * @return void
     */
    public function enqueue_wp_styles_scripts() {
        
        wp_enqueue_style( 'smartcat-modules-main-style', SMARTCAT_MODULES_URL . 'inc/assets/styles/modules.css', NULL, self::VERSION );
        wp_enqueue_script( 'smartcat-modules-main-js', SMARTCAT_MODULES_URL . 'inc/assets/scripts/modules.js', NULL, self::VERSION );
        
    }

    /**
     * Loads the plugin's main admin page
     * 
     * @since 1.0
     * @return void
     */
    public function display_main_plugin_view() {

        include_once SMARTCAT_MODULES_PATH . 'admin/views/settings.php';

    }
    
    /**
     * Loads the plugin's main documentation page
     * 
     * @since 1.0
     * @return void
     */    
    public function display_documentation_view() {

        include_once SMARTCAT_MODULES_PATH . 'admin/views/documentation.php';

    }

}
    
    
    

