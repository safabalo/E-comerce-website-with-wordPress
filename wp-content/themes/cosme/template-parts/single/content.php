<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Cosme
 */
 
 
$cosme_single_title_align	= get_theme_mod( 'cosme_single_heading_alignment', 'center');
if( $cosme_single_title_align == 'left' ) {
	$cosme_alignment_class = "text-left";
}else{
	$cosme_alignment_class = "text-center";
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('article-content'); ?>>
	<?php cosme_post_thumbnail(); ?>
	<header class="entry-header">
		<?php
			if ( 'post' === get_post_type() ) :
				cosme_single_postmeta();
			endif; 

			if ( is_singular() ) :
				the_title( '<h1 class="entry-title '.$cosme_alignment_class.'">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title '.$cosme_alignment_class.'"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
		?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'cosme' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cosme' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php cosme_entry_footer(); ?>
	</footer><!-- .entry-footer -->

	<?php
		get_template_part( 'template-parts/snippets/content', 'author' );
		get_template_part( 'template-parts/snippets/content', 'related' );
		
	?>

</article><!-- #post-<?php the_ID(); ?> -->
