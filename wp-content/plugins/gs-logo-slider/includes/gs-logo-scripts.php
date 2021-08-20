<?php

/**
 * Protect direct access
 */
if ( ! defined( 'ABSPATH' ) ) die( GSL_HACK_MSG );

if ( ! class_exists( 'GS_Logo_Scripts' ) ) {

    final class GS_Logo_Scripts {

		private static $_instance = null;
		
		public $styles = [];

		public $scripts = [];
        
        public static function get_instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new GS_Logo_Scripts();
            }

            return self::$_instance;
            
        }

        public function __construct() {

			$this->add_assets();

			add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_logo_scripts' ] );
			
			add_action( 'admin_head', [ $this, 'print_plugin_icon_css' ] );

			return $this;
            
		}

		public function add_assets() {

			// Styles
			$this->add_style( 'gs-bootstrap-grid', GSL_PLUGIN_URI . '/assets/libs/bootstrap-grid/bootstrap-grid.min.css', [], GSL_VERSION, 'all' );
			$this->add_style( 'gs-swiper', GSL_PLUGIN_URI . '/assets/libs/swiper-js/swiper.min.css', [], GSL_VERSION, 'all' );
			$this->add_style( 'gs-tippyjs', GSL_PLUGIN_URI . '/assets/libs/tippyjs/tippy.css', [], GSL_VERSION, 'all' );
			
			// Scripts
			$this->add_script( 'gs-swiper', GSL_PLUGIN_URI . '/assets/libs/swiper-js/swiper.min.js', ['jquery'], GSL_VERSION, true );
			$this->add_script( 'gs-images-loaded', GSL_PLUGIN_URI . '/assets/libs/images-loaded/images-loaded.min.js', ['jquery'], GSL_VERSION, true );
			$this->add_script( 'gs-tippyjs', GSL_PLUGIN_URI . '/assets/libs/tippyjs/tippy-bundle.umd.min.js', [], GSL_VERSION, true );
			
			if ( ! gs_logo_is_pro_active() ) {
				$this->add_style( 'gs-logo-public', GSL_PLUGIN_URI . '/assets/css/gs-logo.min.css', [], GSL_VERSION, 'all' );
				$this->add_script( 'gs-logo-public', GSL_PLUGIN_URI . '/assets/js/gs-logo.min.js', ['jquery', 'gs-images-loaded'], GSL_VERSION, true );
			}
			
			// For Divi fix
			$this->add_style( 'gs-logo-divi-public', GSL_PLUGIN_URI . '/assets/css/gs-logo-divi.min.css', ['gs-logo-public'], GSL_VERSION, 'all' );

			do_action( 'gs_logo__add_assets', $this );

		}

		public function add_style( $handler, $src, $deps = [], $ver = false, $media ='all' ) {

			$this->styles[$handler] = [
				'src' => $src,
				'deps' => $deps,
				'ver' => $ver,
				'media' => $media
			];

		}

		public function add_script( $handler, $src, $deps = [], $ver = false, $in_footer = false ) {

			$this->scripts[$handler] = [
				'src' => $src,
				'deps' => $deps,
				'ver' => $ver,
				'in_footer' => $in_footer
			];

		}

		public function get_style( $handler ) {

			if ( empty( $style = $this->styles[$handler] ) ) return false;

			return $style;

		}

		public function get_script( $handler ) {

			if ( empty( $script = $this->scripts[$handler] ) ) return false;

			return $script;

		}

		public function wp_register_style( $handler ) {

			$style = $this->get_style( $handler );

			if ( ! $style ) return;

			$deps = (array) apply_filters( $handler . '--style', $style['deps'] );

			wp_register_style( $handler, $style['src'], $deps, $style['ver'], $style['media'] );

		}

		public function wp_register_script( $handler ) {

			$script = $this->get_script( $handler );

			if ( ! $script ) return;

			$deps = (array) apply_filters( $handler . '--script', $script['deps'] );

			wp_register_script( $handler, $script['src'], $deps, $script['ver'], $script['in_footer'] );

		}

		public function _get_public_style_all() {

			return (array) apply_filters( 'gs_logo_get_public_style_all', [
				'gs-swiper',
				'gs-tippyjs',
				'gs-logo-public',
				'gs-logo-divi-public',
			]);

		}

		public function _get_public_script_all() {

			return (array) apply_filters( 'gs_logo_get_public_script_all', [
				'gs-swiper',
				'gs-tippyjs',
				'gs-images-loaded',
				'gs-logo-public'
			]);

		}

		public function _get_admin_style_all() {

			return (array) apply_filters( 'gs_logo_get_admin_style_all', [] );

		}

		public function _get_admin_script_all() {

			return (array) apply_filters( 'gs_logo_get_admin_script_all', [] );

		}

		public function _get_assets_all( $asset_type, $group, $excludes = [] ) {

			if ( !in_array($asset_type, ['style', 'script']) || !in_array($group, ['public', 'admin']) ) return;

			$get_assets = sprintf( '_get_%s_%s_all', $group, $asset_type );

			$assets = $this->$get_assets();

			if ( ! empty($excludes) ) $assets = array_diff( $assets, $excludes );

			return (array) apply_filters( sprintf( 'gs_logo_%s__%s_all', $group, $asset_type ), $assets );

		}

		public function _wp_load_assets_all( $function, $asset_type, $group, $excludes = [] ) {

			if ( !in_array($function, ['enqueue', 'register']) || !in_array($asset_type, ['style', 'script']) ) return;

			$assets = $this->_get_assets_all( $asset_type, $group, $excludes );

			$function = sprintf( 'wp_%s_%s', $function, $asset_type );

			foreach( $assets as $asset ) $this->$function( $asset );

		}

		public function wp_register_style_all( $group, $excludes = [] ) {

			$this->_wp_load_assets_all( 'register', 'style', $group, $excludes );

		}

		public function wp_enqueue_style_all( $group, $excludes = [] ) {

			$this->_wp_load_assets_all( 'enqueue', 'style', $group, $excludes );

		}

		public function wp_register_script_all( $group, $excludes = [] ) {

			$this->_wp_load_assets_all( 'register', 'script', $group, $excludes );

		}

		public function wp_enqueue_script_all( $group, $excludes = [] ) {

			$this->_wp_load_assets_all( 'enqueue', 'script', $group, $excludes );

		}

		// Use to direct enqueue
		public function wp_enqueue_style( $handler ) {

			$style = $this->get_style( $handler );

			if ( ! $style ) return;

			$deps = (array) apply_filters( $handler . '--style-enqueue', $style['deps'] );

			wp_enqueue_style( $handler, $style['src'], $deps, $style['ver'], $style['media'] );

		}

		public function wp_enqueue_script( $handler ) {

			$script = $this->get_script( $handler );

			if ( ! $script ) return;

			$deps = (array) apply_filters( $handler . '--script-enqueue', $script['deps'] );

			wp_enqueue_script( $handler, $script['src'], $deps, $script['ver'], $script['in_footer'] );

		}

		public function print_plugin_icon_css() {

			echo "<style>#adminmenu .toplevel_page_gs-logo-slider .wp-menu-image img, #adminmenu .menu-icon-gs-logo-slider .wp-menu-image img{padding-top:7px;width:20px;opacity:.8;height:auto;}</style>";

		}

		public function enqueue_logo_scripts() {
			
			$enqueue_style = false;
			
			// Register Styles
			$this->wp_register_style_all( 'public' );
		
			// Register Scripts
			$this->wp_register_script_all( 'public' );
	
			// Allow loading script on gs_logo single page
			if ( is_singular('gs_logo') ) $enqueue_style = true;
			
			// Support for Archive page
			if ( ! $enqueue_style && is_post_type_archive( 'gs_logo' ) ) $enqueue_style = true;
			
			// Support for Taxonomy Archive pages
			if ( ! $enqueue_style && is_tax(['logo-category']) ) $enqueue_style = true;
	
			// Abort loading script if not allowed
			if ( ! $enqueue_style ) return;
			
			// Enqueue Styles - This should get called through add_shortcode
			wp_enqueue_style( 'gs-logo-public' );
	
		}

		public static function add_dependency_scripts( $handle, $scripts ) {

			add_action( 'wp_footer', function() use( $handle, $scripts ) {
				
				global $wp_scripts;
	
				if ( empty($scripts) || empty($handle) ) return;
				if ( ! isset($wp_scripts->registered[$handle]) ) return;
	
				$wp_scripts->registered[$handle]->deps = array_unique( array_merge( $wp_scripts->registered[$handle]->deps, $scripts ) );
	
			});
	
		}

		public static function add_dependency_styles( $handle, $styles ) {
            
			global $wp_styles;
			
			if ( empty($styles) || empty($handle) ) return;
			if ( ! isset($wp_styles->registered[$handle]) ) return;
			
			$wp_styles->registered[$handle]->deps = array_unique( array_merge( $wp_styles->registered[$handle]->deps, $styles ) );
	
		}

    }

}

GS_Logo_Scripts::get_instance();