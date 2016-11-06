<?php 

new Smartcat_Project_Meta_Box;

class Smartcat_Project_Meta_Box {

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

        add_meta_box( 'project_meta', __( 'Project Details', 'smartcat-modules' ), array ( $this, 'render_project_metabox' ), 'project', 'normal', 'high' );
        
    }

    public function render_project_metabox( $post ) {

        // Add nonce for security and authentication.
        wp_nonce_field( 'project_meta_box_nonce_action', 'project_meta_box_nonce' );

        // Retrieve an existing value from the database.
        $project_subtitle       = get_post_meta( $post->ID, 'project_meta_subtitle', true );
        $project_url            = get_post_meta( $post->ID, 'project_meta_url', true );
        $project_video_url      = get_post_meta( $post->ID, 'project_meta_video_url', true );
        $project_complete_date  = get_post_meta( $post->ID, 'project_meta_complete_date', true );

        // Set default values.
        if ( empty( $project_subtitle ) )       { $project_subtitle = ''; } 
        if ( empty( $project_url ) )            { $project_url = ''; }
        if ( empty( $project_video_url ) )      { $project_video_url = ''; }
        if ( empty( $project_complete_date ) )  { $project_complete_date = ''; }
            
        // Form fields.
        echo '<table class="form-table">';

        echo '	<tr>';
        echo '		<th><label for="project_meta_subtitle" class="project_meta_subtitle_label">' . __( 'Subtitle', 'smartcat-modules' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="text" id="project_meta_subtitle" name="project_meta_subtitle" class="project_meta_subtitle_field" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr__( $project_subtitle ) . '">';
        echo '		</td>';
        echo '	</tr>';

        echo '	<tr>';
        echo '		<th><label for="project_meta_url" class="project_meta_url_label">' . __( 'Project URL', 'smartcat-modules' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="url" id="project_meta_url" name="project_meta_url" class="project_meta_url_field" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr__( $project_url ) . '">';
        echo '		</td>';
        echo '	</tr>';

        echo '	<tr>';
        echo '		<th><label for="project_meta_video_url" class="project_meta_video_url_label">' . __( 'Video URL', 'smartcat-modules' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="url" id="project_meta_video_url" name="project_meta_video_url" class="project_meta_video_url_field" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr__( $project_video_url ) . '">';
        echo '		</td>';
        echo '	</tr>';

        echo '	<tr>';
        echo '		<th><label for="project_meta_complete_date" class="project_meta_complete_date_label">' . __( 'Completion Date', 'smartcat-modules' ) . '</label></th>';
        echo '		<td>';
        echo '			<input type="date" id="project_meta_complete_date" name="project_meta_complete_date" class="project_meta_complete_date_field" placeholder="' . esc_attr__( '', 'smartcat-modules' ) . '" value="' . esc_attr__( $project_complete_date ) . '">';
        echo '		</td>';
        echo '	</tr>';
      
        echo '</table>';
        
    }
    
    public function save_metabox( $post_id, $post ) {

        // Add nonce for security and authentication.
        $nonce_name     = isset( $_POST[ 'project_meta_box_nonce' ] ) ? $_POST[ 'project_meta_box_nonce' ] : '';
        $nonce_action   = 'project_meta_box_nonce_action';

        // Check if a nonce is set and valid
        if ( !isset( $nonce_name ) ) { return; }
        if ( !wp_verify_nonce( $nonce_name, $nonce_action ) ) { return; }
            
        // Sanitize user input
        $project_subtitle       = isset( $_POST[ 'project_meta_subtitle' ] ) ? sanitize_text_field( $_POST[ 'project_meta_subtitle' ] ) : '';
        $project_url            = isset( $_POST[ 'project_meta_url' ] ) ? sanitize_text_field( $_POST[ 'project_meta_url' ] ) : '';
        $project_video_url      = isset( $_POST[ 'project_meta_video_url' ] ) ? sanitize_text_field( $_POST[ 'project_meta_video_url' ] ) : '';
        $project_complete_date  = isset( $_POST[ 'project_meta_complete_date' ] ) ? sanitize_text_field( $_POST[ 'project_meta_complete_date' ] ) : '';

        // Update the meta field in the database
        update_post_meta( $post_id, 'project_meta_subtitle', $project_subtitle );
        update_post_meta( $post_id, 'project_meta_url', $project_url );
        update_post_meta( $post_id, 'project_meta_video_url', $project_video_url );
        update_post_meta( $post_id, 'project_meta_complete_date', $project_complete_date );
     
    }
    
}