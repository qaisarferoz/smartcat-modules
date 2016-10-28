<?php

class SmartcatModulesLoader {
    
    private $modules;
    private $version;
    
    /**
     * Constructor for the Module loader
     * 
     * @since 1.0
     * @return void
     * @param string[] $modules
     * @param decimal $version
     */
    public function __construct( $modules = null, $version = null ) {

        $this->modules = $modules;
        $this->version = $version;
        
        $this->add_hooks();
        $this->check_modules();
        $this->add_meta_boxes();
        
    }

    /**
     * Hook References
     * 
     * @since 1.0
     * @return void
     */
    private function add_hooks() {

        // Enqueues
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_module_styles_scripts' ) );
        add_action( 'admin_head-widgets.php', array( $this, 'add_widget_styles' ) );
        
    }

    /**
     * Load CSS & JS required for the Modules
     * 
     * @since 1.0
     * @return void
     */
    public function enqueue_module_styles_scripts() {
        
        if ( in_array( 'gallery', $this->modules ) ) :
            wp_enqueue_style( 'unite', SMARTCAT_MODULES_URL . 'inc/assets/styles/unite-gallery.css', array(), $this->version );
            wp_enqueue_script('unite-js', SMARTCAT_MODULES_URL . 'inc/assets/scripts/unite.min.js', array('jquery'), $this->version, true);
        endif;
        
        if ( in_array( 'testimonial', $this->modules ) ) :
            wp_enqueue_style( 'owl-carousel', SMARTCAT_MODULES_URL . 'inc/assets/styles/owl.carousel.css', array(), $this->version );
            wp_enqueue_script('owl-carousel-js', SMARTCAT_MODULES_URL . 'inc/assets/scripts/owl.carousel.min.js', array('jquery'), $this->version, true);
        endif;
        
    }
    
    /**
     * Check the desired Modules and set them up
     * 
     * @since 1.0
     * @return void
     */
    public function check_modules() {
        
        if ( !is_null( $this->modules ) ) :
            
            if ( in_array( 'client', $this->modules ) ) :
                include_once SMARTCAT_MODULES_PATH . 'inc/modules/cpt_client.php';
            endif;

            if ( in_array( 'event', $this->modules ) ) :
                include_once SMARTCAT_MODULES_PATH . 'inc/modules/cpt_event.php';
            endif;
            
            if ( in_array( 'faq', $this->modules ) ) :
                include_once SMARTCAT_MODULES_PATH . 'inc/modules/cpt_faq.php';
            endif;
            
            if ( in_array( 'gallery', $this->modules ) ) :
                include_once SMARTCAT_MODULES_PATH . 'inc/modules/cpt_gallery.php';
            endif;

            if ( in_array( 'news', $this->modules ) ) :
                include_once SMARTCAT_MODULES_PATH . 'inc/modules/cpt_news.php';
            endif;
            
            if ( in_array( 'position', $this->modules ) ) :
                include_once SMARTCAT_MODULES_PATH . 'inc/modules/cpt_position.php';
            endif;
            
            if ( in_array( 'project', $this->modules ) ) :
                include_once SMARTCAT_MODULES_PATH . 'inc/modules/cpt_project.php';
            endif;
            
            if ( in_array( 'testimonial', $this->modules ) ) :
                include_once SMARTCAT_MODULES_PATH . 'inc/modules/cpt_testimonial.php';
            endif;
            
            // Register the Widgets
            add_action( 'widgets_init', array( $this, 'register_widgets' ) );
            
        else : 
            
            // Set Status to false as no modules were passed ($modules == null)
            $this->status = false;
            
        endif;
        
    }
    
    /**
     * Register Widgets
     * 
     * @since 1.0
     * @return void
     */
    public function register_widgets() {
        
        // Register all NON-CPT Widgets (always available)
        
        register_widget( 'Smartcat_CTA_Widget' );
        register_widget( 'Smartcat_Contact_Form_Widget' );
        register_widget( 'Smartcat_Contact_Info_Widget' );
        register_widget( 'Smartcat_Pricing_Table_Widget' );
        
        // Register remaining CPT Widgets (if enabled)
        
        if ( in_array( 'client', $this->modules ) ) :
            register_widget( 'Smartcat_Clients_Widget' );
        endif;

        if ( in_array( 'event', $this->modules ) ) :
            register_widget( 'Smartcat_Events_Widget' );
        endif;
        
        if ( in_array( 'faq', $this->modules ) ) :
            register_widget( 'Smartcat_FAQs_Widget' );
        endif;
        
        if ( in_array( 'gallery', $this->modules ) ) :
            register_widget( 'Smartcat_Gallery_Widget' );
        endif;
        
        if ( in_array( 'news', $this->modules ) ) :
            register_widget( 'Smartcat_News_Widget' );
        endif;
        
        if ( in_array( 'position', $this->modules ) ) :
            register_widget( 'Smartcat_Work_History_Widget' );
        endif;
        
        if ( in_array( 'project', $this->modules ) ) :
            register_widget( 'Smartcat_Projects_Widget' );
        endif;
        
        if ( in_array( 'testimonial', $this->modules ) ) :
            register_widget( 'Smartcat_Testimonials_Widget' );
        endif; 
        
    }
    
    /**
     * Add all applicable Metaboxes to CPTs
     * 
     * @since 1.0
     * @param Post $post
     * @return void
     */
    public function add_meta_boxes() {
    
        if ( in_array( 'client', $this->modules ) ) :
            include_once SMARTCAT_MODULES_PATH . 'inc/modules/metaboxes/Client_Meta_Box.php';
        endif;
        
        if ( in_array( 'event', $this->modules ) ) :
            include_once SMARTCAT_MODULES_PATH . 'inc/modules/metaboxes/Event_Meta_Box.php';
        endif;
        
        if ( in_array( 'position', $this->modules ) ) :
            include_once SMARTCAT_MODULES_PATH . 'inc/modules/metaboxes/Position_Meta_Box.php';
        endif;
        
        if ( in_array( 'project', $this->modules ) ) :
            include_once SMARTCAT_MODULES_PATH . 'inc/modules/metaboxes/Project_Meta_Box.php';
        endif;  
        
    }

    /**
     * May contain CSS used to alter icons of Widgets
     * 
     * @since 1.0
     * @return void
     */
    function add_widget_styles() { ?>

        <style>
            /* CSS to change Widget Icons? */
        </style>
        
    <?php }
    
}
