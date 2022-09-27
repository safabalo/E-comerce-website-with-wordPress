<?php
/**
 * Cosme Theme Customizer
 *
 * @package Cosme
 */

if ( !class_exists( 'Cosme_Customizer' ) ) {
	class Cosme_Customizer {

		/**
		 * Instance
		 */		
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}


		/**
		 * Constructor
		 */
		public function __construct() {	
			add_action( 'customize_register', array( $this, 'cosme_customize_register' ) );	
			add_action( 'customize_preview_init', array( $this, 'cosme_customize_preview_js' ) );
			add_action( 'customize_controls_print_footer_scripts', array( $this, 'cosme_scripts' ) );
		}


		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function cosme_customize_register( $wp_customize ) {
			
			// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			require get_template_directory() . '/includes/customizer/controls/alpha-color/class-control-alpha-color.php';
			require get_template_directory() . '/includes/customizer/controls/description/class-control-description.php';
			require get_template_directory() . '/includes/customizer/controls/divider/class-control-divider.php';
			require get_template_directory() . '/includes/customizer/controls/heading/class-control-heading.php';
			require get_template_directory() . '/includes/customizer/controls/radio-buttons/class-control-radio-buttons.php';
			require get_template_directory() . '/includes/customizer/controls/radio-image/class-control-radio-image.php';
			require get_template_directory() . '/includes/customizer/controls/slider/class-control-slider.php';
			require get_template_directory() . '/includes/customizer/controls/switch/class-control-switch.php';
			require get_template_directory() . '/includes/customizer/controls/tabs/class-control-tabs.php';
			require get_template_directory() . '/includes/customizer/controls/typography/class-control-typography.php';
			require get_template_directory() . '/includes/customizer/controls/class-cosme-premium-control.php';
			// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

			$wp_customize->get_section( 'title_tagline' )->priority 	= 1;
			$wp_customize->get_section( 'colors' )->priority 			= 10;

			// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			require get_template_directory() . '/includes/customizer/sanitizer.php';
			require get_template_directory() . '/includes/customizer/callbacks.php';
			require get_template_directory() . '/includes/customizer/options/general.php';
			require get_template_directory() . '/includes/customizer/options/typography.php';
			require get_template_directory() . '/includes/customizer/options/colors.php';
			require get_template_directory() . '/includes/customizer/options/header.php';
			require get_template_directory() . '/includes/customizer/options/layout.php';
			require get_template_directory() . '/includes/customizer/options/socials.php';
			require get_template_directory() . '/includes/customizer/options/footer.php';
			// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

			$wp_customize->register_section_type( 'Cosme_Customize_Control_Premium' );
			
			$wp_customize->add_section( new Cosme_Customize_Control_Premium( $wp_customize, 'premium', array(
						'title'  	=> esc_html__('Want More Features?', 'cosme'),
						'button' 	=> esc_html__( 'Upgrade to Pro','cosme' ),
						'link'   	=> esc_url( 'https://codegearthemes.com/products/cosme-pro' ),
						'priority' 	=> 0,
					)
				)
			);

			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial(
					'blogname',
					array(
						'selector'        => '.site-title a',
						'render_callback' => array( $this, 'cosme_customize_partial_blogname' ),
					)
				);
				
				$wp_customize->selective_refresh->add_partial(
					'blogdescription',
					array(
						'selector'        => '.site-description',
						'render_callback' => array( $this, 'cosme_customize_partial_blogdescription' ),
					)
				);
			}
		}

		/**
		 * Render the site title for the selective refresh partial.
		 *
		 * @return void
		 */
		function cosme_customize_partial_blogname() {
			bloginfo( 'name' );
		}

		/**
		 * Render the site tagline for the selective refresh partial.
		 *
		 * @return void
		 */
		function cosme_customize_partial_blogdescription() {
			bloginfo( 'description' );
		}


		/**
		 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
		 */
		public function cosme_customize_preview_js() {
			wp_enqueue_script( 'cosme-customizer', get_template_directory_uri() . '/assets/admin/js/customizer.js', array( 'customize-preview' ), COSME_THEME_VERSION, true );
		}

		public function cosme_scripts() {
			wp_enqueue_style( 'cosme-customizer-styles', get_template_directory_uri() . '/assets/admin/css/admin-style.css' );

			wp_enqueue_script( 'cosme-customizer-scripts', get_template_directory_uri() . '/assets/admin/js/customizer-scripts.js', array( 'jquery', 'jquery-ui-core' ), COSME_THEME_VERSION, true );
		}

	}
}

Cosme_Customizer::get_instance();