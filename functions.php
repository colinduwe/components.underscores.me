<?php
/**
 * components functions and definitions
 *
 * @package components
 */

if ( ! function_exists( 'components_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function components_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on components, use a find and replace
	 * to change 'components' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'components', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'top' => esc_html__( 'Top Menu', 'components' ),
		'social'  => esc_html__( 'Social Links Menu', 'components' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'components_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // components_setup
add_action( 'after_setup_theme', 'components_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function components_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'components_content_width', 640 );
}
add_action( 'after_setup_theme', 'components_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function components_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'components' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'components_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function components_scripts() {
	wp_enqueue_style( 'components-style', get_stylesheet_uri() );

	wp_enqueue_script( 'components', get_template_directory_uri() . '/assets/js/main.js', array(), '20120206', true );

	// wp_enqueue_script( 'components-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'components-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( wp_style_is( 'genericons', 'registered' ) ) {
		wp_enqueue_style( 'genericons' );
	} else {
		wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons.css', array(), null );
	}

}
add_action( 'wp_enqueue_scripts', 'components_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
