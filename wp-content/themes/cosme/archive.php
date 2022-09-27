<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Cosme
 */
$cosme_archive_layout	= get_theme_mod( 'cosme_archive_layout', 'simple' );
$cosme_archive_sidebar_layout 			= get_theme_mod( 'cosme_archive_sidebar', 'full' );
$cosme_website_layout 			= get_theme_mod( 'cosme_website_container', 'container' );

/*Main container class*/
$cosme_main_class[] = 'main-container';
if ( $cosme_archive_sidebar_layout  == 'full' ) {
	$cosme_main_class[] = 'no-sidebar';
} else {
	$cosme_main_class[] = $cosme_archive_sidebar_layout  . '-sidebar has-sidebar';
}

$cosme_content_class   = array();
if( $cosme_archive_sidebar_layout == 'none' ) {
	$cosme_content_class[] 		= 'one-whole';
}else{
	$cosme_content_class[] = 'large--three-quarters medium--three-fifths small--one-whole';
}
$cosme_container_class = 'container';
if(  $cosme_website_layout === 'container-fluid' ){
	$cosme_container_class = 'container-fluid';
}

get_header();
?>
<div class="section-archive section--archive-template">
	<?php if ( have_posts() ) : ?>
	<div class="page-header">
		<div class="<?php echo esc_attr( $cosme_container_class ); ?>">
			<div class="grid">
				<div class="grid__item one-whole">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div class="main-content <?php echo esc_attr( implode( ' ', $cosme_main_class ) ); ?>">
		<div class="<?php echo esc_attr( $cosme_container_class ); ?>">
			<div class="grid">
				<div id="primary" class="grid__item <?php echo esc_attr( implode( ' ', $cosme_content_class ) ); ?> content-area">
					<main id="main" class="site-main grid">

						<?php 
							if ( have_posts() ) :

								/* Start the Loop */
								while ( have_posts() ) :
									the_post();

									/*
									* Include the Post-Type-specific template for the content.
									* If you want to override this in a child theme, then include a file
									* called content-___.php (where ___ is the Post Type name) and that will be used instead.
									*/
									get_template_part( 'template-parts/content', get_post_type() );

								endwhile;

								the_posts_navigation();

							else :

								get_template_part( 'template-parts/content', 'none' );

							endif;
						?>

					</main><!-- #main -->
				</div>
				<?php
					if( $cosme_archive_sidebar_layout == 'left' || $cosme_archive_sidebar_layout == 'right' ):
						get_sidebar();
					endif;
				?>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();
