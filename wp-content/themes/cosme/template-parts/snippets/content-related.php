<?php
/**
 * Template part for related post
 *
 * @package cosme
 */

$cosme_related_posts_args = array(
    'no_found_rows'       => true,
    'ignore_sticky_posts' => true,
);

$current_object = get_queried_object();

if ( $current_object instanceof WP_Post ) {
    $current_id = $current_object->ID;
    if ( absint( $current_id ) > 0 ) {
        // Exclude current post.
        $cosme_related_posts_args['post__not_in'] = array( absint( $current_id ) );
        // Include current posts categories.
        $categories = wp_get_post_categories( $current_id );
        if ( ! empty( $categories ) ) {
            $cosme_related_posts_args['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'field'    => 'term_id',
                    'terms'    => $categories,
                    'operator' => 'IN',
                )
            );
        }
    }
}

$cosme_related_posts_query = new WP_Query( $cosme_related_posts_args );
if( $cosme_related_posts_query->have_posts() ): ?>
    <div class="section--related-posts">
        <div class="content--related-inner">
            <div class="section-title">
                <h3><?php echo esc_html__( 'Related Posts', 'cosme' ); ?></h3>
            </div><!-- Section Title  -->
            <div class="related--single-entry">
                <div class="grid">
                    <?php
                    while( $cosme_related_posts_query->have_posts() ) :

                        $cosme_related_posts_query->the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('article post-card grid__item large--one-third medium--one-half small--one-whole'); ?>>
                            <div class="content-inner">
                                <?php cosme_post_thumbnail(); ?>
                                <div class="entry-header">
                                    <?php
                                        if ( 'post' === get_post_type() ) : 
                                            $meta_class = '';
                                            if( ! has_post_thumbnail() ){
                                                $meta_class = 'no-thumbnail-meta';
                                            }
                                        ?>
                                            <div class="entry-meta <?php echo esc_attr( $meta_class, 'cosme' ) ?>">
                                                <?php cosme_posted_on(); ?>
                                            </div><!-- .entry-meta -->
                                    <?php endif; ?>
                                    <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
                                </div>
                                <div class="entry-content">
                                    <?php the_excerpt(); ?>
                                </div><!-- .entry-content -->
                            </div>
                        </article> 
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
endif;