<?php

$args = array (
    'post_type' => array ( 'news' ),
    'post_status' => array ( 'publish' ),
    'posts_per_page' => ( !empty( $instance['scmod_news_limit'] ) ? (int)$instance['scmod_news_limit'] : -1 ),
);

// The Query
$news = new WP_Query( $args );

// The Loop
if ( $news->have_posts() ) : ?>

    <?php $ctr = 0; ?>

    <div class="vivita-news <?php echo isset( $instance['scmod_news_widget_width'] ) ? 'col-sm-' . $instance['scmod_news_widget_width'] : 'col-sm-12'; ?>">

        <h2 class="widget-title cpt-widget-title">
            <?php echo !empty( $instance['scmod_news_title'] ) ? esc_html( $instance['scmod_news_title'] ) : ''; ?>
        </h2>

        <div class="row">

            <?php while ( $news->have_posts() ) :

                $ctr++;

                $news->the_post();
                ?>

                <div class="col-sm-4">

                    <div class="news-item">

                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="image">
                                <a href="<?php echo esc_url( get_the_permalink() ); ?>">
                                    <?php the_post_thumbnail( 'large' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="inner">

                            <h3 class="title">
                                <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a>
                            </h3>

                            <div class="date"><?php echo get_the_date( 'd M, Y'); ?></div>

                        </div>

                    </div>     

                </div>

            <?php endwhile; ?>

            <div class="clear"></div>

        </div>

    </div>

<?php endif;

// Restore original Post Data
wp_reset_postdata();