<?php

class Smartcat_Contact_Form_Widget extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'smartcat-module-contact-form',
            __( 'Smartcat Contact Form', 'smartcat-modules' ),
            array(
                'classname'   => 'scmod-contact-form',
                'description' => __( 'Output a Contact Form', 'smartcat-modules' ),
            )
        );

    }

    public function widget( $args, $instance ) { 

        if ( file_exists( get_template_directory() . '/smartcat-modules/views/Contact_Form_Widget_View.php') ) : 
            include_once get_template_directory() . '/smartcat-modules/views/Contact_Form_Widget_View.php' ;
        else :
            include_once SMARTCAT_MODULES_PATH . 'inc/modules/views/Contact_Form_Widget_View.php';
        endif;

    }

    public function form( $instance ) {

        $widths = array(
            '3'     => '1/4',
            '4'     => '1/3',
            '6'     => '1/2',
            '12'    => __( 'Full', 'smartcat-modules' ),
        );
       
        // Set default values
        $instance = wp_parse_args( (array) $instance, array( 
            'scmod_contact_form_title'              => __( 'Contact Form', 'smartcat-modules'),
            'scmod_contact_form_width'              => '12',
            'scmod_contact_form_detail'             => __( 'Detail Text', 'smartcat-modules'),
            'scmod_contact_form_from_label'         => __( 'Name', 'smartcat-modules'),
            'scmod_contact_form_email_label'        => __( 'Email Address', 'smartcat-modules'),
            'scmod_contact_form_message_label'      => __( 'Message', 'smartcat-modules'),
            'scmod_contact_form_submit_label'       => __( 'Submit', 'smartcat-modules'),
            'scmod_contact_form_recipient_email'    => '',
        ) );

        // Retrieve an existing value from the database
        $scmod_contact_form_title           = !empty( $instance['scmod_contact_form_title'] ) ? $instance['scmod_contact_form_title'] : '';
        $scmod_contact_form_width           = !empty( $instance['scmod_contact_form_width'] ) ? $instance['scmod_contact_form_width'] : '12';
        $scmod_contact_form_detail          = !empty( $instance['scmod_contact_form_detail'] ) ? $instance['scmod_contact_form_detail'] : '';
        $scmod_contact_form_from_label      = !empty( $instance['scmod_contact_form_from_label'] ) ? $instance['scmod_contact_form_from_label'] : '';
        $scmod_contact_form_email_label     = !empty( $instance['scmod_contact_form_email_label'] ) ? $instance['scmod_contact_form_email_label'] : '';
        $scmod_contact_form_message_label   = !empty( $instance['scmod_contact_form_message_label'] ) ? $instance['scmod_contact_form_message_label'] : '';
        $scmod_contact_form_submit_label    = !empty( $instance['scmod_contact_form_submit_label'] ) ? $instance['scmod_contact_form_submit_label'] : '';
        $scmod_contact_form_recipient_email = !empty( $instance['scmod_contact_form_recipient_email'] ) ? $instance['scmod_contact_form_recipient_email'] : '';
        
        // Title - Text
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_contact_form_title' ) . '" class="scmod_contact_form_title_label">' . __( 'Title', 'smartcat-modules' ) . '</label>';
        echo '	<input type="text" id="' . $this->get_field_id( 'scmod_contact_form_title' ) . '" name="' . $this->get_field_name( 'scmod_contact_form_title' ) . '" class="widefat" placeholder="' . esc_attr__( 'Title', 'smartcat-modules' ) . '" value="' . esc_attr( $scmod_contact_form_title ) . '">';
        echo '</p>';

        // Widget Width - Select/Option
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_contact_form_width' ) . '" class="scmod_contact_form_width_label">' . __( 'Widget Width', 'smartcat-modules' ) . '</label>';
        echo '	<select id="' . $this->get_field_id( 'scmod_contact_form_width' ) . '" name="' . $this->get_field_name( 'scmod_contact_form_width' ) . '" class="widefat">';
            foreach( $widths as $key => $value ) :
                echo '<option value="' . $key . '" ' . selected( $scmod_contact_form_width, $key, false ) . '> ' . $value . '</option>';
            endforeach;
        echo '	</select>';
        echo '</p>';

        // Detail Text - Text
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_contact_form_detail' ) . '" class="scmod_contact_form_detail_label">' . __( 'Detail Text', 'smartcat-modules' ) . '</label>';
        echo '	<input type="text" id="' . $this->get_field_id( 'scmod_contact_form_detail' ) . '" name="' . $this->get_field_name( 'scmod_contact_form_detail' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr( $scmod_contact_form_detail ) . '">';
        echo '</p>';
        
        // Label / Name - Text
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_contact_form_from_label' ) . '" class="scmod_contact_form_from_label_label">' . __( 'Name Label', 'smartcat-modules' ) . '</label>';
        echo '	<input type="text" id="' . $this->get_field_id( 'scmod_contact_form_from_label' ) . '" name="' . $this->get_field_name( 'scmod_contact_form_from_label' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr( $scmod_contact_form_from_label ) . '">';
        echo '</p>';
        
        // Label / Email - Text
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_contact_form_email_label' ) . '" class="scmod_contact_form_email_label_label">' . __( 'Email Address Label', 'smartcat-modules' ) . '</label>';
        echo '	<input type="text" id="' . $this->get_field_id( 'scmod_contact_form_email_label' ) . '" name="' . $this->get_field_name( 'scmod_contact_form_email_label' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr( $scmod_contact_form_email_label ) . '">';
        echo '</p>';
        
        // Label / Message - Text
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_contact_form_message_label' ) . '" class="scmod_contact_form_message_label_label">' . __( 'Message Label', 'smartcat-modules' ) . '</label>';
        echo '	<input type="text" id="' . $this->get_field_id( 'scmod_contact_form_message_label' ) . '" name="' . $this->get_field_name( 'scmod_contact_form_message_label' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr( $scmod_contact_form_message_label ) . '">';
        echo '</p>';
        
        // Label / Submit - Text
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_contact_form_submit_label' ) . '" class="scmod_contact_form_submit_label_label">' . __( 'Submit Label', 'smartcat-modules' ) . '</label>';
        echo '	<input type="text" id="' . $this->get_field_id( 'scmod_contact_form_submit_label' ) . '" name="' . $this->get_field_name( 'scmod_contact_form_submit_label' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr( $scmod_contact_form_submit_label ) . '">';
        echo '</p>';
        
        // Recipient - Email
        echo '<p>';
        echo '	<label for="' . $this->get_field_id( 'scmod_contact_form_recipient_email' ) . '" class="scmod_contact_form_recipient_email_label">' . __( 'Recipient Email', 'smartcat-modules' ) . '</label>';
        echo '	<input type="email" id="' . $this->get_field_id( 'scmod_contact_form_recipient_email' ) . '" name="' . $this->get_field_name( 'scmod_contact_form_recipient_email' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr( $scmod_contact_form_recipient_email ) . '">';
        echo '</p>';
        
    }

    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['scmod_contact_form_title']           = !empty( $new_instance['scmod_contact_form_title'] ) ? strip_tags( $new_instance['scmod_contact_form_title'] ) : '';
        $instance['scmod_contact_form_width']           = !empty( $new_instance['scmod_contact_form_width'] ) ? strip_tags( $new_instance['scmod_contact_form_width'] ) : '12';
        $instance['scmod_contact_form_detail']          = !empty( $new_instance['scmod_contact_form_detail'] ) ? strip_tags( $new_instance['scmod_contact_form_detail'] ) : '';
        $instance['scmod_contact_form_from_label']      = !empty( $new_instance['scmod_contact_form_from_label'] ) ? strip_tags( $new_instance['scmod_contact_form_from_label'] ) : '';
        $instance['scmod_contact_form_email_label']     = !empty( $new_instance['scmod_contact_form_email_label'] ) ? strip_tags( $new_instance['scmod_contact_form_email_label'] ) : '';
        $instance['scmod_contact_form_message_label']   = !empty( $new_instance['scmod_contact_form_message_label'] ) ? strip_tags( $new_instance['scmod_contact_form_message_label'] ) : '';
        $instance['scmod_contact_form_submit_label']    = !empty( $new_instance['scmod_contact_form_submit_label'] ) ? strip_tags( $new_instance['scmod_contact_form_submit_label'] ) : '';
        $instance['scmod_contact_form_recipient_email'] = !empty( $new_instance['scmod_contact_form_recipient_email'] ) ? strip_tags( $new_instance['scmod_contact_form_recipient_email'] ) : '';

        return $instance;

    }

}