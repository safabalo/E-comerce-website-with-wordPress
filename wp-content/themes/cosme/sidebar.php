<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cosme
 */

if ( ! is_active_sidebar( 'sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="grid__item large--one-quarter medium--two-fifths small--one-whole sidebar sidebar-widget widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar' ); ?>
</aside><!-- #secondary -->
