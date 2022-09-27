<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Cosme
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */

function cosme_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

}
add_action( 'after_setup_theme', 'cosme_woocommerce_setup' );

function cosme_woocommerce_hooks(){

	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

	//Move sale tag
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash' );
	add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_sale_flash', 99 );
}
add_action( 'wp', 'cosme_woocommerce_hooks' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function cosme_woocommerce_scripts() {
	wp_enqueue_style( 'cosme-woocommerce-style', COSME_THEME_URI . '/assets/public/css/woocommerce.css', array(), COSME_THEME_VERSION );
	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'cosme-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'cosme_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function cosme_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'cosme_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function cosme_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'cosme_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'cosme_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function cosme_woocommerce_wrapper_before() {
		$cosme_website_layout 			= get_theme_mod( 'cosme_website_container', 'container' );
		$cosme_container_class = 'container';
		if(  $cosme_website_layout === 'container-fluid' ){
			$cosme_container_class = 'container-fluid';
		}
		?>
			<main id="primary" class="site-main">
				<div class="<?php echo esc_attr( $cosme_container_class ); ?>">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'cosme_woocommerce_wrapper_before' );

if ( ! function_exists( 'cosme_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function cosme_woocommerce_wrapper_after() {
		?>	
				</div>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'cosme_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	
 */

if ( ! function_exists( 'cosme_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function cosme_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		cosme_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'cosme_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'cosme_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function cosme_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'cosme' ); ?>">
			<?php
				$item_count_text = sprintf(
					/* translators: number of items in the mini cart. */
					_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'cosme' ),
					WC()->cart->get_cart_contents_count()
				);
			?>
			<svg width="24" height="24" fill="#000" xmlns="http://www.w3.org/2000/svg">
				<path d="M7.5 21.75a1.5 1.5 0 100-3 1.5 1.5 0 000 3zM17.25 21.75a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
				<path fill-rule="evenodd" d="M0 3a.75.75 0 01.75-.75h1.577A1.5 1.5 0 013.77 3.338L4.53 6h16.256a.75.75 0 01.72.956l-2.474 8.662a2.25 2.25 0 01-2.163 1.632H7.88a2.25 2.25 0 01-2.163-1.632l-2.47-8.645a.738.738 0 01-.01-.033l-.91-3.19H.75A.75.75 0 010 3zm4.959 4.5l2.201 7.706a.75.75 0 00.721.544h8.988a.75.75 0 00.72-.544L19.792 7.5H4.96z"></path>
			</svg>
			<span class="count"><?php echo absint ( WC()->cart->get_cart_contents_count() ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'cosme_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function cosme_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item nav--cart-item';
		} else {
			$class = 'nav--cart-item';
		}
		?>
		<ul class="widget--header-items">
			<li class="search--widget-block">
				<?php get_search_form(); ?>
			</li>
			<li class="account-widget-block">
				<a class="header--account-item wc-account-link" href=" <?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ) ?> " title=" <?php echo esc_html__( 'Account', 'cosme' ) ?> ">
					<svg width="21" height="21" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M8.29686 33.1524C11.0027 30.4302 14.1724 28.4421 17.8061 27.1881C15.912 25.8834 14.4023 24.1638 13.2767 22.029C12.1512 19.8943 11.5923 17.5948 11.6 15.1306C11.6079 12.5999 12.2646 10.2459 13.5702 8.06884C14.8757 5.89176 16.6294 4.15731 18.8312 2.86549C21.0997 1.57388 23.5243 0.932114 26.105 0.940188C28.6858 0.948262 31.0647 1.60506 33.2417 2.91058C35.4188 4.2161 37.1366 5.96973 38.3951 8.17148C39.72 10.44 40.3784 12.873 40.3703 15.4704C40.3627 17.9013 39.7728 20.1805 38.6007 22.3081C37.5287 24.336 36.0248 26.0629 34.0889 27.4888C37.5823 28.4987 40.7398 30.4233 43.5614 33.2627C45.9515 35.6678 47.7911 38.3958 49.0803 41.4468C50.3695 44.4978 51.0088 47.6883 50.9984 51.0183L47.0024 51.0058C47.0144 47.1763 46.0599 43.6102 44.1388 40.3075C42.2838 37.1715 39.7775 34.6661 36.6198 32.7914C33.3622 30.9164 29.8271 29.973 26.0142 29.961C22.2014 29.9491 18.6603 30.8871 15.391 32.775C12.2217 34.6299 9.71625 37.1528 7.87475 40.3439C5.96656 43.568 5.00652 47.0782 4.99464 50.8744L0.998659 50.8619C1.00929 47.4653 1.63539 44.2538 2.87696 41.2274C4.11854 38.2009 5.92517 35.5093 8.29686 33.1524ZM36.6241 15.4587C36.6299 13.5939 36.1608 11.8525 35.2168 10.2345C34.2728 8.61646 32.9948 7.33041 31.3827 6.37631C29.7707 5.42221 28.0239 4.94221 26.1425 4.93633C24.261 4.93044 22.5113 5.3995 20.8933 6.34349C19.2753 7.28748 17.9892 8.56552 17.0351 10.1776C16.081 11.7897 15.601 13.5364 15.5951 15.4179C15.5892 17.2993 16.0583 19.049 17.0023 20.6671C17.9463 22.2851 19.2243 23.5711 20.8364 24.5252C22.4485 25.4793 24.1953 25.951 26.0767 25.9402C27.9582 25.9295 29.708 25.4604 31.3259 24.5331C32.9439 23.6057 34.2299 22.336 35.184 20.7239C36.1381 19.1119 36.6181 17.3568 36.6241 15.4587Z" fill="black"/>
					</svg>
				</a>
			</li>
			<li class="cart-widget-block">
				<ul id="site-header-cart"  class="site-header-cart">
					<li class="<?php echo esc_attr( $class ); ?>">
						<?php cosme_woocommerce_cart_link(); ?>
					</li>
					<li class="cart-container">
						<?php
							$instance = array('title' => '');
							the_widget( 'WC_Widget_Cart', $instance );
						?>
					</li>
				</ul>
			</li>
		</ul>
		<?php
	}
}

/**
 * Page header
 */
function cosme_woocommerce_header() {
	
	if ( !is_shop() && !is_product_category() && !is_product_tag() ) {
		return;
	}

	//Remove elements
	add_filter( 'woocommerce_show_page_title', '__return_false' );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description' );
	remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description' );
	$cosme_website_layout 			= get_theme_mod( 'cosme_website_container', 'container' );
	$cosme_container_class = 'container';
	if(  $cosme_website_layout === 'container-fluid' ){
		$cosme_container_class = 'container-fluid';
	}
	?>
		<header class="woocommerce-page-header woocommerce-page-header-layout-default">
			<div class="<?php echo esc_attr( $cosme_container_class ); ?>">
				<?php if ( ( is_shop() || is_product_category() || is_product_tag() ) || !is_shop() && !is_product_category() && !is_product_tag() ) : ?>
					<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
				<?php endif; ?>
				<?php woocommerce_breadcrumb(); ?>

				<?php if( ( is_shop() || is_product_category() || is_product_tag() ) || !is_shop() && !is_product_category() && !is_product_tag() ) {
					woocommerce_taxonomy_archive_description();
					woocommerce_product_archive_description();
				} ?>

				<?php if( is_shop() ) : ?>
					<div class="<?php echo esc_attr( $cosme_container_class ); ?>">
						<div class="categories-wrapper">
							<?php  
							$args = array(
								'taxonomy' => 'product_cat',
								'fields'   => 'id=>name',
								'parent'   => 0
							);
							$categories = get_terms( $args );
							
							foreach( $categories as $cat_id => $cat_name ) {
								$cat_link = get_term_link( $cat_id );
								echo '<a href="'. esc_url( $cat_link ) .'" class="category-button" role="button">'. esc_html( $cat_name ) .'</a>';
							} ?>
						</div>
				<?php endif; ?>

				<?php if( is_product_category() || is_product_tag() ) : ?>
					<div class="<?php echo esc_attr( $cosme_container_class ); ?>">
						<div class="categories-wrapper">
							<?php 
							$category = get_category( $GLOBALS['wp_query']->get_queried_object() );
							$args = array(
								'taxonomy' => 'product_cat',
								'parent'   => $category->term_id,
								'fields'   => 'id=>name'
							);
							$categories = get_terms( $args );

							foreach( $categories as $cat_id => $cat_name ) {
								$cat_link = get_term_link( $cat_id );
								echo '<a href="'. esc_url( $cat_link ) .'" class="category-button" role="button">'. esc_html( $cat_name ) .'</a>';
							} ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</header>
	<?php
}
add_action( 'cosme_after_header', 'cosme_woocommerce_header' );


/**
 * Wrap products results and ordering before
 */
function cosme_products_results_ordering_before() {
	echo '<div class="woocommerce-sorting-wrapper">';
		echo '<div class="grid">';
			echo '<div class="grid__item one-half">';
		
}
add_action( 'woocommerce_before_shop_loop', 'cosme_products_results_ordering_before', 19 );

/**
 * Add a button to toggle filters on shop archives
 */
function cosme_woocommerce_filters_button() {
	echo '</div>';
	echo '<div class="grid__item one-half text-right">';
}
add_action( 'woocommerce_before_shop_loop', 'cosme_woocommerce_filters_button', 22 );

/**
 * Wrap products results and ordering after
 */
function cosme_products_results_ordering_after() {
			echo '</div>';
		echo '</div>';
	echo '</div>';
}
add_action( 'woocommerce_before_shop_loop', 'cosme_products_results_ordering_after', 31 );

/**
 * Products Grid starts
 */

function cosme_products_grid_start(){
	echo '<div class="woocommerce-products-wrapper">';
		echo '<div class="grid">';
			echo '<div class=" grid__item large--one-whole medium--one-whole small--one-whole">';
}

add_action( 'woocommerce_before_shop_loop', 'cosme_products_grid_start', 41 );

/**
 * Products Grid Ends
 */

function cosme_products_grid_end(){
			echo '</div>';
		echo '</div>';
}
add_action( 'woocommerce_after_shop_loop', 'cosme_products_grid_end', 15 );

/**
 * Checkout wrapper
 */
function cosme_woocommerce_order_review_before() {
	echo '<div class="checkout-wrapper">';
}
add_action( 'woocommerce_checkout_before_order_review_heading', 'cosme_woocommerce_order_review_before', 5 );

/**
 * Checkout wrapper end
 */
function cosme_woocommerce_order_review_after() {
	echo '</div>';
}
add_action( 'woocommerce_checkout_after_order_review', 'cosme_woocommerce_order_review_after', 15 );

/**
 * Woocommerce tabs titles
 */
add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );
add_filter( 'woocommerce_product_description_heading', '__return_false' );

function cosme_change_breadcrumb_delimiter( $defaults ) {
	$defaults['delimiter'] = '<span class="trail"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="14" height="11"><path d="M 14.980469 2.980469 C 14.164063 2.980469 13.433594 3.476563 13.128906 4.230469 C 12.820313 4.984375 13.003906 5.847656 13.585938 6.414063 L 32.171875 25 L 13.585938 43.585938 C 13.0625 44.085938 12.851563 44.832031 13.035156 45.535156 C 13.21875 46.234375 13.765625 46.78125 14.464844 46.964844 C 15.167969 47.148438 15.914063 46.9375 16.414063 46.414063 L 36.414063 26.414063 C 37.195313 25.632813 37.195313 24.367188 36.414063 23.585938 L 16.414063 3.585938 C 16.035156 3.199219 15.519531 2.980469 14.980469 2.980469 Z"></path></svg></span>';
	return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'cosme_change_breadcrumb_delimiter' );

/**
 * Single product top area wrapper
 */
function cosme_single_product_wrap_before() {
	echo '<div class="product-gallery-summary gallery-default">';
}
add_action( 'woocommerce_before_single_product_summary', 'cosme_single_product_wrap_before', -99 );

/**
 * Single product top area wrapper
 */
function cosme_single_product_wrap_after() {
	echo '</div>';
}
add_action( 'woocommerce_after_single_product_summary', 'cosme_single_product_wrap_after', 9 );

/**
 * Single product top area wrapper
 */

add_filter('woocommerce_sale_flash', 'cosme_custom_sale_text', 10, 3);
function cosme_custom_sale_text($text, $post, $_product)
{
	return '<span class="onsale">Sale</span>';
}

/**
 * Filter single product Flexslider options
 */
function cosme_product_carousel_options( $options ) {

	$options['controlNav'] = 'thumbnails';
	$options['directionNav'] = true;

	return $options;
}
add_filter( 'woocommerce_single_product_carousel_options', 'cosme_product_carousel_options' );