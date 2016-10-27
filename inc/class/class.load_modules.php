<?php

class SmartcatModulesLoader {
    
    private $modules;
    private $version;
    
    /**
     * Constructor for the Module loader
     * 
     * @since 1.0
     * @return void
     */
    public function __construct( $modules = null, $version = null ) {

        $this->modules = $modules;
        $this->version = $version;
        
        $this->add_hooks();
        $this->check_modules();
        
    }

    /**
     * Hook references go here
     * 
     * @since 1.0
     * @return void
     */
    private function add_hooks() {

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_module_styles_scripts' ) );
        
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
        
    }
    
    /**
     * Check the desired Modules and set them up
     * 
     * @since 1.0
     * @return void
     */
    public function check_modules() {
        
        if ( !is_null( $this->modules ) ) :
            
            if ( in_array( 'event', $this->modules ) ) :
                include_once SMARTCAT_MODULES_PATH . 'inc/modules/cpt_event.php';
            endif;
            
            if ( in_array( 'faq', $this->modules ) ) :
                include_once SMARTCAT_MODULES_PATH . 'inc/modules/cpt_faq.php';
            endif;
            
            if ( in_array( 'gallery', $this->modules ) ) :
                include_once SMARTCAT_MODULES_PATH . 'inc/modules/cpt_gallery.php';
            endif;

            if ( in_array( 'job', $this->modules ) ) :
                include_once SMARTCAT_MODULES_PATH . 'inc/modules/cpt_job.php';
            endif;
            
            if ( in_array( 'news', $this->modules ) ) :
                include_once SMARTCAT_MODULES_PATH . 'inc/modules/cpt_news.php';
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
     * Register widgets
     * 
     * @since 1.0
     */
    public function register_widgets() {
        
        // Register all NON-CPT Widgets (always available)
        
        register_widget( 'Smartcat_CTA_Widget' );
        register_widget( 'Smartcat_Contact_Form_Widget' );
        register_widget( 'Smartcat_Contact_Info_Widget' );
        register_widget( 'Smartcat_Pricing_Table_Widget' );
        
        // Register remaining CPT Widgets (if enabled)
        
        if ( in_array( 'event', $this->modules ) ) :
            register_widget( 'Smartcat_Events_Widget' );
        endif;
        
        if ( in_array( 'faq', $this->modules ) ) :
            register_widget( 'Smartcat_FAQs_Widget' );
        endif;
        
        if ( in_array( 'gallery', $this->modules ) ) :
            register_widget( 'Smartcat_Gallery_Widget' );
        endif;
        
        if ( in_array( 'job', $this->modules ) ) :
            register_widget( 'Smartcat_Jobs_Widget' );
        endif;
        
        if ( in_array( 'news', $this->modules ) ) :
            register_widget( 'Smartcat_News_Widget' );
        endif;
        
        if ( in_array( 'testimonial', $this->modules ) ) :
            register_widget( 'Smartcat_Testimonials_Widget' );
        endif; 
        
    }
    
}