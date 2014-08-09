<?php 
/**
 * unhitched functions and definitions
 *
 * @package unhitched
 */

    // function wpbootstrap_scripts_with_jquery()
    // {
        // // Register the script like this for a theme:
        // wp_register_script( 'custom-script', get_template_directory_uri() . '/livingUnhitched/js/bootstrap.js', array( 'jquery' ) );
        // // For either a plugin or a theme, you can then enqueue the script:
        // wp_enqueue_script( 'custom-script' );
    // }
    // add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );
//     
//     
    // if ( function_exists('register_sidebar') )
        // register_sidebar(array(
            // 'before_widget' => '',
            // 'after_widget' => '',
            // 'before_title' => '<h3>',
            // 'after_title' => '</h3>',
        // ));
//     

if ( ! isset( $content_width ) ) {
    $content_width = 640; /* pixels */
}

if ( ! function_exists( 'unhitched_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function unhitched_setup() {

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on my-simone, use a find and replace
     * to change 'my-simone' to the name of your theme in all the template files
     */
    load_theme_textdomain( 'unhitched', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    //add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'unhitched' ),
    ) );

    // Enable support for Post Formats.
    add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

    // Setup the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'unhitched_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) ) );

    // Enable support for HTML5 markup.
    add_theme_support( 'html5', array(
        'comment-list',
        'search-form',
        'comment-form',
        'gallery',
    ) );
}
endif; // my_simone_setup
add_action( 'after_setup_theme', 'unhitched_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function unhitched_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'unhitched' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ) );
}
add_action( 'widgets_init', 'unhitched_widgets_init' );

   
    // Enqueueing scripts, styles and fonts
    
     function unhitched_scripts() {
        wp_enqueue_style( 'unhitched-style', get_stylesheet_uri() );
        
        wp_enqueue_style( 'unhitched-fonts', '//fonts.googleapis.com/css?family=Josefin+Sans:400,600|Raleway:400,300|Open+Sans:400italic,400' );
        
        wp_enqueue_script( 'bootstrapCDN', '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' );

        wp_enqueue_script( 'bootstrapJS', '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' );
    

    }
     
 add_action( 'wp_enqueue_scripts', 'unhitched_scripts' );       
    
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

 
    
    
?>