<?php 

new Smartcat_Position_Meta_Box;

class Smartcat_Position_Meta_Box {

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

        add_meta_box( 'position_meta', __( 'Position / Job Details', 'smartcat-modules' ), array ( $this, 'render_position_metabox' ), 'position', 'normal', 'high' );
        
    }

    public function render_position_metabox( $post ) {

        // Add nonce for security and authentication.
        wp_nonce_field( 'position_meta_box_nonce_action', 'position_meta_box_nonce' );

        // Retrieve an existing value from the database.
        $position_company       = get_post_meta( $post->ID, 'position_meta_company', true );
        $position_start_date    = get_post_meta( $post->ID, 'position_meta_start_date', true );
        $position_end_date      = get_post_meta( $post->ID, 'position_meta_end_date', true );

        // Set default values.
        if ( empty( $position_company ) )       { $position_company = ''; } 
        if ( empty( $position_start_date ) )    { $position_start_date = ''; }
        if ( empty( $position_end_date ) )      { $position_end_date = ''; }
            
        // Form fields.
        echo '<table class="form-table">';

        echo '	<tr>';
        echo '		<th><label for="position_meta_company" class="position_meta_company_label">' . __( 'Organization / Company', 'smartcat-modules' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="text" id="position_meta_company" name="position_meta_company" class="position_meta_company_field" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr__( $position_company ) . '">';
        echo '		</td>';
        echo '	</tr>';

        echo '	<tr>';
        echo '		<th><label for="position_meta_start_date" class="position_meta_start_date_label">' . __( 'Start Date', 'smartcat-modules' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="date" id="position_meta_start_date" name="position_meta_start_date" class="position_meta_start_date_field" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr__( $position_start_date ) . '">';
        echo '		</td>';
        echo '	</tr>';
        
        echo '	<tr>';
        echo '		<th><label for="position_meta_end_date" class="position_meta_end_date_label">' . __( 'End Date', 'smartcat-modules' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="date" id="position_meta_end_date" name="position_meta_end_date" class="position_meta_end_date_field" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr__( $position_end_date ) . '">';
        echo '		</td>';
        echo '	</tr>';
        
        echo '</table>';
        
    }
    
    public function save_metabox( $post_id, $post ) {

        // Add nonce for security and authentication.
        $nonce_name     = isset( $_POST[ 'position_meta_box_nonce' ] ) ? $_POST[ 'position_meta_box_nonce' ] : '';
        $nonce_action   = 'position_meta_box_nonce_action';

        // Check if a nonce is set and valid
        if ( !isset( $nonce_name ) ) { return; }
        if ( !wp_verify_nonce( $nonce_name, $nonce_action ) ) { return; }
            
        // Sanitize user input.
        $position_company       = isset( $_POST[ 'position_meta_company' ] ) ? sanitize_text_field( $_POST[ 'position_meta_company' ] ) : '';
        $position_start_date    = isset( $_POST[ 'position_meta_start_date' ] ) ? sanitize_text_field( $_POST[ 'position_meta_start_date' ] ) : '';
        $position_end_date      = isset( $_POST[ 'position_meta_end_date' ] ) ? sanitize_text_field( $_POST[ 'position_meta_end_date' ] ) : '';

        // Update the meta field in the database.
        update_post_meta( $post_id, 'position_meta_company', $position_company );
        update_post_meta( $post_id, 'position_meta_start_date', $position_start_date );
        update_post_meta( $post_id, 'position_meta_end_date', $position_end_date );
        
    }
    
}