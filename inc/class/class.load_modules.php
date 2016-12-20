<?php

class SmartcatModulesLoader {
    
    private $modules;
    
    /**
     * Constructor for the Module loader
     * 
     * @since 1.0
     * @return void
     * @param string[] $modules
     * @param decimal $version
     */
    public function __construct( $modules = null ) {

        $this->modules = $modules;
        
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
        add_action( 'customize_controls_enqueue_scripts', array( $this, 'add_widget_styles' ) );
        
        // Contact Form Hooks
        add_action('wp_ajax_scmod_send_message', array( $this, 'scmod_send_message' ) );
        add_action('wp_ajax_nopriv_scmod_send_message', array( $this, 'scmod_send_message' ) );
        
    }

    /**
     * Load CSS & JS required for the Modules
     * 
     * @since 1.0
     * @return void
     */
    public function enqueue_module_styles_scripts() {
        
        if ( in_array( 'gallery', $this->modules ) ) :
            wp_enqueue_style( 'unite', SMARTCAT_MODULES_URL . 'inc/assets/styles/unite-gallery.css', array(), SmartcatModulesPlugin::$version );
            wp_enqueue_script('unite-js', SMARTCAT_MODULES_URL . 'inc/assets/scripts/unite.min.js', array('jquery'), SmartcatModulesPlugin::$version, true);
        endif;
        
        if ( in_array( 'testimonial', $this->modules ) ) :
            wp_enqueue_style( 'owl-carousel', SMARTCAT_MODULES_URL . 'inc/assets/styles/owl.carousel.css', array(), SmartcatModulesPlugin::$version );
            wp_enqueue_script('owl-carousel-js', SMARTCAT_MODULES_URL . 'inc/assets/scripts/owl.carousel.min.js', array('jquery'), SmartcatModulesPlugin::$version, true);
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
            
            // If the Rewrite Flag is false (first time creating the post types), 
            // then flush the rewrite rules to refresh permalinks and set flag true
            if ( !get_option( 'smartcat_modules_rewrite_rules_flag' ) ) :
                flush_rewrite_rules();
                update_option( 'smartcat_modules_rewrite_rules_flag', true );               
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
        register_widget( 'Smartcat_New_Row_Widget' );
        
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
            
            #available-widgets [class*="smartcat-module-cta"] .widget-title h3,
            #available-widgets [class*="smartcat-module-clients"] .widget-title h3,
            #available-widgets [class*="smartcat-module-contact-form"] .widget-title h3,
            #available-widgets [class*="smartcat-module-contact-info"] .widget-title h3,
            #available-widgets [class*="smartcat-module-events"] .widget-title h3,
            #available-widgets [class*="smartcat-module-faqs"] .widget-title h3,
            #available-widgets [class*="smartcat-module-gallery"] .widget-title h3,
            #available-widgets [class*="smartcat-module-news"] .widget-title h3,
            #available-widgets [class*="smartcat-module-new-row"] .widget-title h3,
            #available-widgets [class*="smartcat-module-pricing-table"] .widget-title h3,
            #available-widgets [class*="smartcat-module-projects"] .widget-title h3,
            #available-widgets [class*="smartcat-module-testimonials"] .widget-title h3,
            #available-widgets [class*="smartcat-module-positions"] .widget-title h3 
            {
                color: #16a6d8;
            }
            
            /* Call to Action */
            #available-widgets [class*="smartcat-module-cta"] .widget-title:before {
                color: #16a6d8;
                content: '\f534' !important; 
            }
            
            /* Clients */
            #available-widgets [class*="smartcat-module-clients"] .widget-title:before {
                color: #16a6d8;
                content: '\f307' !important; 
            }
            
            /* Contact Form */
            #available-widgets [class*="smartcat-module-contact-form"] .widget-title:before {
                color: #16a6d8;
                content: '\f466' !important; 
            }
            
            /* Contact Info */
            #available-widgets [class*="smartcat-module-contact-info"] .widget-title:before {
                color: #16a6d8;
                content: "\f231" !important;
            }
            
            /* Events */
            #available-widgets [class*="smartcat-module-events"] .widget-title:before {
                color: #16a6d8;
                content: '\f508' !important;
            }
            
            /* FAQs */
            #available-widgets [class*="smartcat-module-faqs"] .widget-title:before {
                color: #16a6d8;
                content: '\f223' !important; 
            }
            
            /* Gallery */
            #available-widgets [class*="smartcat-module-gallery"] .widget-title:before {
                color: #16a6d8;
                content: '\f161' !important; 
            }
            
            /* New Row */
            #available-widgets [class*="smartcat-module-new-row"] .widget-title:before {
                color: #16a6d8;
            }
            
            /* News */
            #available-widgets [class*="smartcat-module-news"] .widget-title:before {
                color: #16a6d8;
                content: '\f497' !important; 
            }
            
            /* Pricing Table */
            #available-widgets [class*="smartcat-module-pricing-table"] .widget-title:before {
                color: #16a6d8;
                content: '\f535' !important; 
            }
            
            /* Projects */
            #available-widgets [class*="smartcat-module-projects"] .widget-title:before {
                color: #16a6d8;
                content: '\f183' !important; 
            }
            
            /* Testimonials */
            #available-widgets [class*="smartcat-module-testimonials"] .widget-title:before {
                color: #16a6d8;
                content: '\f473' !important; 
            }
            
            /* Work History */
            #available-widgets [class*="smartcat-module-positions"] .widget-title:before {
                color: #16a6d8;
                content: '\f337' !important; 
            }
            
        </style>
        
    <?php }
    
    function scmod_send_message(){

        $name = sanitize_text_field( $_POST['name'] );
        $email = sanitize_text_field( $_POST['email'] );
        $message_entered = sanitize_text_field( $_POST['message'] );
        $recipient_email = sanitize_text_field( $_POST['recipient'] );

        $message = 'From: ' . $name . ' || Sender Email: ' . $email . ' || Message: ' . $message_entered;

        wp_mail( $recipient_email, __( 'New message from ' . get_option( 'blog_name' ), 'smartcat-modules' ), $message );

        echo 1;
        exit();

    }
    
}
