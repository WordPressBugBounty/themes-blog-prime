<?php

/**
 * Blog Prime About Page
 * @package Blog Prime
 *
*/

if( !class_exists('Blog_Prime_About_page') ):

	class Blog_Prime_About_page{

		function __construct(){

			add_action('admin_menu', array($this, 'blog_prime_backend_menu'),999);

		}

		// Add Backend Menu
        function blog_prime_backend_menu(){

            add_theme_page(esc_html__( 'Blog Prime','blog-prime' ), esc_html__( 'Blog Prime','blog-prime' ), 'activate_plugins', 'blog-prime-about', array($this, 'blog_prime_main_page'),1);

        }

        // Settings Form
        function blog_prime_main_page(){

            require get_template_directory() . '/classes/about-render.php';

        }

	}

	new Blog_Prime_About_page();

endif;