<?php
/**
 *
 * Footer Widget
 *
 * @author      CodeGearThemes
 * @category    WordPress
 * @package     Cosme
 * @version     1.0.0
 *
 */
if( is_active_sidebar('footer-column-1') || is_active_sidebar('footer-column-2') || is_active_sidebar('footer-column-3') || is_active_sidebar('footer-column-4') ): ?>
	<div class="section-footer section--footer-widget">
		<div class="grid">
			<div class="grid__item large--two-fifths medium--two-quarters small--one-whole footer-block-one ">
				<?php dynamic_sidebar('footer-column-1'); ?>
			</div>
			<div class="grid__item large--one-fifth medium--two-quarters small--one-whole footer-block-two ">
				<?php dynamic_sidebar('footer-column-2'); ?>
			</div>
			<div class="grid__item large--one-fifth medium--two-quarters small--one-whole footer-block-three ">
				<?php dynamic_sidebar('footer-column-3'); ?>
			</div>
			<div class="grid__item large--one-fifth medium--two-quarters small--one-whole footer-block-four ">
				<?php 
					dynamic_sidebar('footer-column-4');
					do_action( 'footer_social' ); 
				?>
			</div>
		</div>
	</div>
<?php endif;
