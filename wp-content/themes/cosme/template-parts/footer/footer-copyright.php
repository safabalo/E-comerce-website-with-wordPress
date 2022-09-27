<?php
/**
 *
 * Footer copyright
 *
 * @author      CodeGearThemes
 * @category    WordPress
 * @package     Cosme
 * @version     1.0.0
 *
 */
 $cosme_footer_copyright   	= cosme_copyright();

?>
<div class="section-copyright text-center">
	<div class="site-info ">
		<?php 
			if( !empty( $cosme_footer_copyright ) ): ?>
				<p class="copyright no-margin">
					<?php echo wp_kses_post($cosme_footer_copyright); ?>
				</p>
			<?php endif; ?>
	</div><!-- .site-info -->
	
</div>
