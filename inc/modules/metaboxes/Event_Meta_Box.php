<?php

new Smartcat_Event_Meta_Box;

class Smartcat_Event_Meta_Box {

    public function __construct() {

        if ( is_admin() ) {
            add_action( 'load-post.php',        array ( $this, 'init_metabox' ) );
            add_action( 'load-post-new.php',    array ( $this, 'init_metabox' ) );
        }
        
    }

    public function init_metabox() {

        add_action( 'add_meta_boxes',           array ( $this, 'add_metabox' ) );
        add_action( 'save_post',                array ( $this, 'save_metabox' ), 10, 2 );
        
    }

    public function add_metabox() {

        add_meta_box( 'event_meta', __( 'Event Details', 'smartcat-modules' ), array ( $this, 'render_event_metabox' ), 'event', 'normal', 'high' );
        
    }

    public function render_event_metabox( $post ) {

        // Add nonce for security and authentication.
        wp_nonce_field( 'event_meta_box_nonce_action', 'event_meta_box_nonce' );

        // Retrieve an existing value from the database.
        $event_date         = get_post_meta( $post->ID, 'event_meta_date', true );
        $event_time_start   = get_post_meta( $post->ID, 'event_meta_time_start', true );
        $event_time_end     = get_post_meta( $post->ID, 'event_meta_time_end', true );
        $event_location     = get_post_meta( $post->ID, 'event_meta_location', true );

        // Set default values.
        if ( empty( $event_date ) )         { $event_date = ''; } 
        if ( empty( $event_time_start ) )   { $event_time_start = ''; }
        if ( empty( $event_time_end ) )     { $event_time_end = ''; }
        if ( empty( $event_location ) )     { $event_location = ''; }
            
        // Form fields.
        echo '<table class="form-table">';

        echo '	<tr>';
        echo '		<th><label for="event_meta_date" class="event_meta_date_label">' . __( 'Date', 'smartcat-modules' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="date" id="event_meta_date" name="event_meta_date" class="event_meta_date_field" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr__( $event_date ) . '">';
        echo '		</td>';
        echo '	</tr>';

        echo '	<tr>';
        echo '		<th><label for="event_meta_time_start" class="event_meta_time_start_label">' . __( 'Time Start', 'smartcat-modules' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="time" id="event_meta_time_start" name="event_meta_time_start" class="event_meta_time_start_field" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr__( $event_time_start ) . '">';
        echo '		</td>';
        echo '	</tr>';

        echo '	<tr>';
        echo '		<th><label for="event_meta_time_end" class="event_meta_time_end_label">' . __( 'Time End', 'smartcat-modules' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="time" id="event_meta_time_end" name="event_meta_time_end" class="event_meta_time_end_field" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr__( $event_time_end ) . '">';
        echo '		</td>';
        echo '	</tr>';

        echo '	<tr>';
        echo '		<th><label for="event_meta_location" class="event_meta_location_label">' . __( 'Location', 'smartcat-modules' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="text" id="event_meta_location" name="event_meta_location" class="event_meta_location_field" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr__( $event_location ) . '">';
        echo '		</td>';
        echo '	</tr>';

        echo '</table>';
        
    }
    
    public function save_metabox( $post_id, $post ) {

        // Add nonce for security and authentication.
        $nonce_name = isset( $_POST[ 'event_meta_box_nonce' ] ) ? $_POST[ 'event_meta_box_nonce' ] : '';
        $nonce_action = 'event_meta_box_nonce_action';

        // Check if a nonce is set and valid
        if ( !isset( $nonce_name ) ) { return; }
        if ( !wp_verify_nonce( $nonce_name, $nonce_action ) ) { return; }
            
        // Sanitize user input.
        $event_date = isset( $_POST[ 'event_meta_date' ] ) ? sanitize_text_field( $_POST[ 'event_meta_date' ] ) : '';
        $event_time_start = isset( $_POST[ 'event_meta_time_start' ] ) ? sanitize_text_field( $_POST[ 'event_meta_time_start' ] ) : '';
        $event_time_end = isset( $_POST[ 'event_meta_time_end' ] ) ? sanitize_text_field( $_POST[ 'event_meta_time_end' ] ) : '';
        $event_location = isset( $_POST[ 'event_meta_location' ] ) ? sanitize_text_field( $_POST[ 'event_meta_location' ] ) : '';

        // Update the meta field in the database.
        update_post_meta( $post_id, 'event_meta_date', $event_date );
        update_post_meta( $post_id, 'event_meta_time_start', $event_time_start );
        update_post_meta( $post_id, 'event_meta_time_end', $event_time_end );
        update_post_meta( $post_id, 'event_meta_location', $event_location );
        
    }
    
}