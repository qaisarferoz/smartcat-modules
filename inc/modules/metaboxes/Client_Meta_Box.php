<?php 

new Smartcat_Client_Meta_Box;

class Smartcat_Client_Meta_Box {

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

        add_meta_box( 'client_meta', __( 'Client Details', 'smartcat-modules' ), array ( $this, 'render_client_metabox' ), 'client', 'normal', 'high' );
        
    }

    public function render_client_metabox( $post ) {

        // Add nonce for security and authentication.
        wp_nonce_field( 'client_meta_box_nonce_action', 'client_meta_box_nonce' );

        // Retrieve an existing value from the database.
        $client_org_url     = get_post_meta( $post->ID, 'client_meta_org_url', true );
        $client_location    = get_post_meta( $post->ID, 'client_meta_location', true );

        // Set default values.
        if ( empty( $client_org_url ) )     { $client_org_url = ''; } 
        if ( empty( $client_location ) )    { $client_location = ''; }
            
        // Form fields
        echo '<table class="form-table">';

        echo '	<tr>';
        echo '		<th><label for="client_meta_org_url" class="client_meta_org_url_label">' . __( 'Organization / Company - URL', 'smartcat-modules' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="url" id="client_meta_org_url" name="client_meta_org_url" class="client_meta_org_url_field" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr__( $client_org_url ) . '">';
        echo '		</td>';
        echo '	</tr>';

        echo '	<tr>';
        echo '		<th><label for="client_meta_location" class="client_meta_location_label">' . __( 'Location', 'smartcat-modules' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="text" id="client_meta_location" name="client_meta_location" class="client_meta_location_field" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr__( $client_location ) . '">';
        echo '		</td>';
        echo '	</tr>';

        echo '</table>';
        
    }
    
    public function save_metabox( $post_id, $post ) {

        // Add nonce for security and authentication.
        $nonce_name     = isset( $_POST[ 'client_meta_box_nonce' ] ) ? $_POST[ 'client_meta_box_nonce' ] : '';
        $nonce_action   = 'client_meta_box_nonce_action';

        // Check if a nonce is set and valid
        if ( !isset( $nonce_name ) ) { return; }
        if ( !wp_verify_nonce( $nonce_name, $nonce_action ) ) { return; }
            
        // Sanitize user input.
        $client_org_url     = isset( $_POST[ 'client_meta_org_url' ] ) ? sanitize_text_field( $_POST[ 'client_meta_org_url' ] ) : '';
        $client_location    = isset( $_POST[ 'client_meta_location' ] ) ? sanitize_text_field( $_POST[ 'client_meta_location' ] ) : '';

        // Update the meta field in the database
        update_post_meta( $post_id, 'client_meta_org_url', $client_org_url );
        update_post_meta( $post_id, 'client_meta_location', $client_location );
        
    }
    
}
