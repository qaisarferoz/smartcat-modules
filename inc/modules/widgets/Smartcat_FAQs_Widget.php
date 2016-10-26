<?php

class Smartcat_FAQs_Widget extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'smartcat-module-faqs',
            __( 'Smartcat FAQs', 'vivita' ),
            array(
                'description' => __( 'Display the FAQs you have created', 'vivita' ),
            )
        );

    }

    public function widget( $args, $instance ) {

        // AddOns::vivita_output_faqs( 'widget' );

    }

    public function form( $instance ) {

    }

    public function update( $new_instance, $old_instance ) {

    }

}