<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Cosme
 */

$cosme_page_layout 			= get_theme_mod( 'cosme_page_sidebar', 'none' );
$cosme_website_layout 			= get_theme_mod( 'cosme_website_container', 'container' );

/*Main container class*/
$cosme_main_class[] = 'main-container';
if ( $cosme_page_layout == 'none' ) {
	$cosme_main_class[] = 'no-sidebar';
} else {
	$cosme_main_class[] = $cosme_page_layout . '-sidebar has-sidebar';
}

$cosme_content_class   = array();
if( $cosme_page_layout == 'none' ) {
	$cosme_content_class[] 		= 'one-whole';
}else{
	$cosme_content_class[] = 'large--three-quarters medium--three-quarters small--one-whole';
}

$cosme_container_class = 'container';
if(  $cosme_website_layout === 'container-fluid' ){
	$cosme_container_class = 'container-fluid';
}

get_header();
?>

<div class="section-page section--page-template">
	<?php if( !is_front_page() ): ?>
	<div class="page-header-wrapper">
		<div class="<?php echo esc_attr( $cosme_container_class ); ?>">
			<div class="page-header entry-header">	
				<?php
					the_title( '<h1 class="entry-title">', '</h1>' );
					cosme_breadcrumb();
				?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div class="main-content <?php echo esc_attr( implode( ' ', $cosme_main_class ) ); ?>">
		<div class="<?php echo esc_attr( $cosme_container_class ); ?>">
			<div class="grid">
				<div id="primary" class="grid__item <?php echo esc_attr( implode( ' ', $cosme_content_class ) ); ?> content-area">
					<main id="main" class="site-main">

						<?php
							while ( have_posts() ) :
								the_post();

								get_template_part( 'template-parts/content', 'page' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

							endwhile; // End of the loop.
						?>

					</main><!-- #main -->
				</div>
				<?php
					if( $cosme_page_layout == 'left' || $cosme_page_layout == 'right' ):
						get_sidebar();
					endif;
				?>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
