<?php

$args = array (
    'post_type' => array ( 'project' ),
    'post_status' => array ( 'publish' ),
    'order' => 'DESC',
    'orderby' => 'date',
    'posts_per_page' => ( !empty( $instance['scmod_projects_limit'] ) ? (int)$instance['scmod_projects_limit'] : -1 ),
);

// The Query
$projects = new WP_Query( $args );

// The Loop
if ( $projects->have_posts() ) : ?>

    <div class="<?php echo isset( $instance['scmod_projects_widget_width'] ) ? 'col-sm-' . $instance['scmod_projects_widget_width'] : 'col-sm-12'; ?>">
        
        <h2 class="widget-title">
            <?php echo !empty( $instance['scmod_projects_title'] ) ? esc_html( $instance['scmod_projects_title'] ) : ''; ?>
        </h2>
        
        <div class="row">

            <?php while ( $projects->have_posts() ) :

                $projects->the_post(); ?>

                <div class="single-project">

                    <?php if ( has_post_thumbnail() ) : ?>

                        <a class="image" href="<?php echo esc_url( get_the_permalink( get_the_ID() ) ); ?>">
                            <img src="<?php echo get_the_post_thumbnail_url(); ?>"/>
                        </a>

                    <?php endif; ?>

                    <div class="project-card">
                        
                        <h4 class="project-title">    
                            <a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'project_meta_url', true ) ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
                        </h4>
                        
                        <p class="project-subtitle">
                            <?php echo get_post_meta( get_the_ID(), 'project_meta_subtitle', true ); ?>
                        </p>
                        
                        <?php if( get_post_meta( get_the_ID(), 'project_meta_video_url', true ) != '' ) : ?>
                            <a class="button" href="<?php echo esc_url( get_post_meta( get_the_ID(), 'project_meta_video_url', true ) ); ?>">
                                <?php _e( 'Video', 'smartcat-modules' ); ?>
                            </a>
                        <?php endif; ?>
                        
                        <h5 class="project-date"><?php echo esc_html( date( 'F Y', strtotime( get_post_meta( get_the_ID(), 'project_meta_complete_date', true ) ) ) ); ?></h5>
                        
                    </div>

                </div>            

            <?php endwhile; ?>

        </div>
        
    </div>

<?php else : ?>

    <h4 class="none-to-display"><?php _e( 'There are currently no projects to display, please check again at a later time.', 'smartcat-modules' ); ?></h4>

<?php endif; ?>

<?php wp_reset_postdata(); ?>

<div class="clear"></div>