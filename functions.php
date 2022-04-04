<?php
/**
 * Demo Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Demo_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.3' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function demo_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Demo Theme, use a find and replace
		* to change 'demo-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'demo-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	//Register Navigation
	register_nav_menus(
		array(
			'header-menu' => esc_html__( 'Primary', 'demo-theme' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'demo-theme' ),
		)
	);

	//Register Social media menu
	register_nav_menus(
		array(
			'social-top'  => esc_html__( 'Social Top Menu', 'demo-theme' ),
			'social-bottom'  => esc_html__( 'Social Bottom Menu', 'demo-theme' ),
		)
	);

	// Social Top Menu
	function demo_theme_social_top_menu() {
		if ( has_nav_menu( 'social-top' ) ) {
			
			$args = array(
				'theme_location'  => 'social-top',
				'container'       => 'nav',
				'container_id'    => 'menu-social',
				'container_class' => 'menu-social menu-social--white menu-social-top',
				'menu_id'         => 'menu-social-items',
				'menu_class'      => 'menu-items',
				'depth'           => 1,
				'link_before'     => '<span class="screen-reader-text">',
				'link_after'      => '</span>',
				'fallback_cb'     => '',
			);

			wp_nav_menu($args);	
		}
	}

	// Social Bottom Menu
	function demo_theme_social_bottom_menu() {
		if ( has_nav_menu( 'social-bottom' ) ) {
			
			$args = array(
				'theme_location'  => 'social-bottom',
				'container'       => 'nav',
				'container_id'    => 'menu-social',
				'container_class' => 'menu-social menu-social--silver',
				'menu_id'         => 'menu-social-items',
				'menu_class'      => 'menu-items',
				'depth'           => 1,
				'link_before'     => '<span class="screen-reader-text">',
				'link_after'      => '</span>',
				'fallback_cb'     => '',
			);

			wp_nav_menu($args);	
		}
	}

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'demo_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'demo_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function demo_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'demo_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'demo_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function demo_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'demo-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'demo-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

function footer_logo_widget() {
	register_sidebar( 
		array(
			'name'          => esc_html__( 'Footer Logo Widget', 'demo-theme' ),
			'id'            => 'footer_logo_widget',
			'before_widget' => '<div class="logo-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="text-uppercase fw-bold mb-4">',
			'after_title'   => '</h6>',
		) 
	);
}

function copyright_widget() {
	register_sidebar( 
		array(
			'name'          => esc_html__( 'Footer Copyright Widget', 'demo-theme' ),
			'id'            => 'footer_copyright_widget',
			'before_widget' => '<div class="copyright-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="text-uppercase fw-bold mb-4">',
			'after_title'   => '</h6>',
		) 
	);
}

add_action( 'widgets_init', 'demo_theme_widgets_init' );
add_action( 'widgets_init', 'footer_logo_widget' );
add_action( 'widgets_init', 'copyright_widget' );


/**
 * Enqueue scripts and styles.
 */
function demo_theme_scripts() {
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css', array(), _S_VERSION );

	wp_enqueue_style( 'demo-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'demo-theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'demo-theme-sticky', get_template_directory_uri() . '/js/sticky-header.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'demo-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'demo_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

