<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cosme
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Mobile Specific Metas -->
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="640">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	<?php wp_head(); ?>
</head>
<?php 
	$cosme_website_layout 		= get_theme_mod( 'cosme_website_container', 'container' );
	$cosme_container_class = 'container';
	if(  $cosme_website_layout === 'container-fluid' ){
		$cosme_container_class = 'container-fluid';
	} 
?>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'cosme' ); ?></a>
    <div class="wrapper">
		<?php do_action( 'cosme_before_header' ); ?>
		<header id="masthead" class="site-header">
			<div class="<?php echo esc_attr( $cosme_container_class ); ?>">
				<?php get_template_part( 'template-parts/header/layout', 'default' ); ?>
			</div>
			<?php if ( function_exists( 'cosme_woocommerce_header_cart' ) ): ?>
				<div class="mobile-product-search">
					<?php get_search_form(); ?>
				</div>
			<?php endif; ?>
		</header><!-- #masthead -->
		<?php do_action( 'cosme_after_header' ); ?>

		<div id="content" class="site-content">