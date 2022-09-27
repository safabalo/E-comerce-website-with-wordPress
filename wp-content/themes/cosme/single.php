<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Cosme
 */

get_header();

$cosme_single_layout 			= get_theme_mod( 'cosme_single_sidebar', 'none' );
$cosme_website_layout 			= get_theme_mod( 'cosme_website_container', 'container' );

/*Main container class*/
$cosme_main_class[] = 'main-container';
if ( $cosme_single_layout == 'full' ) {
	$cosme_main_class[] = 'no-sidebar';
} else {
	$cosme_main_class[] = $cosme_single_layout . '-sidebar has-sidebar';
}

$cosme_content_class   = array();
if( $cosme_single_layout == 'full' ) {
	$cosme_content_class[] 		= 'one-whole';
}elseif( $cosme_single_layout == 'centered' ){
	$cosme_content_class[] = 'large--three-quarters medium--three-fifths small--one-whole';
}else{
	$cosme_content_class[] = 'large--three-quarters medium--three-fifths small--one-whole';
	if( $cosme_single_layout === 'left' ){
		$cosme_content_class[] = 'omega';
	}else{
		$cosme_content_class[] = 'alpha';
	}
}

$cosme_container_class = 'container';
if(  $cosme_website_layout === 'container-fluid' ){
	$cosme_container_class = 'container-fluid';
}

?>
<div class="section-single section--single-template">
	<div class="main-content <?php echo esc_attr( implode( ' ', $cosme_main_class ) ); ?>">
		<div class="<?php echo esc_attr( $cosme_container_class ); ?>">
			<div class="grid">
				<div id="primary" class="grid__item <?php echo esc_attr( implode( ' ', $cosme_content_class ) ); ?> content-area">
					<main id="main" class="site-main">

						<?php
							while ( have_posts() ) :
								the_post();

								get_template_part( 'template-parts/single/content', get_post_type() );
								the_post_navigation(
									array(
										'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous', 'cosme' ) . '</span> <span class="nav-title">%title</span>',
										'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next', 'cosme' ) . '</span> <span class="nav-title">%title</span>',
									)
								);
								

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

							endwhile; // End of the loop.
						?>

					</main><!-- #main -->
				</div>
							
				<?php
					if( $cosme_single_layout == 'left' || $cosme_single_layout == 'right' ):
						get_sidebar();
					endif;
				?>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();
