<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Cosme
 */
$cosme_content_class   = cosme_archive_grid();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('article post-card grid__item '.esc_attr( implode( ' ', $cosme_content_class ) ) );?>  >
	<div class="content-inner">
		<?php cosme_post_thumbnail(); ?>
		<header class="entry-header">
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
			<?php 
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;
			?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
			the_excerpt();
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cosme' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
