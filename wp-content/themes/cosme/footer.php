<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cosme
 */
 $cosme_footer_layout		= get_theme_mod( 'footer_section_layout' , 'simple' );
 $cosme_website_layout 		= get_theme_mod( 'cosme_website_container', 'container' );

/*Main container class*/
$cosme_container_class = 'container';
if(  $cosme_website_layout === 'container-fluid' ){
	$cosme_container_class = 'container-fluid';
}

?>
	</div><!--wrapper-->
</div><!-- #page -->
<footer id="colophon" class="site-footer">
	<div class="<?php echo esc_attr( $cosme_container_class ); ?>">
		<?php
			if( $cosme_footer_layout === 'simple' ){
				get_template_part( 'template-parts/footer/footer', 'column' );
			}
		?>
	</div>
		<div class="footer-bottom">
			<div class="<?php echo esc_attr( $cosme_container_class ); ?>">
				<div class="wrapper">
					<?php 
						get_template_part( 'template-parts/footer/footer', 'copyright' );					
					?>
				</div>
				
			</div>
		</div>
	</div>
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>   
</html>
