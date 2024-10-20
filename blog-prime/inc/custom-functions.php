<?php
/**
* Custom Functions.
*
* @package Blog Prime
*/
if (!function_exists('blog_prime_fonts_url')) :

    //Google Fonts URL
    function blog_prime_fonts_url()
    {

        $font_families = array(
            'Roboto:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700',
            'Barlow:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700',
            'Playfair+Display:ital,wght@0,400;0,700;1,400;1,700'
        );

        $fonts_url = add_query_arg(array(
            'family' => implode('&family=', $font_families),
            'display' => 'swap',
        ), 'https://fonts.googleapis.com/css2');

        return esc_url_raw($fonts_url);
    }

endif;

if( !function_exists( 'blog_prime_post_category_list' ) ) :

    // Post Category List.
    function blog_prime_post_category_list(){

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $post_cat_cat_array = array();
        $post_cat_cat_array[''] = esc_html__( '--Select Category--','blog-prime' );

        foreach ( $post_cat_lists as $post_cat_list ) {

            $post_cat_cat_array[$post_cat_list->slug] = $post_cat_list->name;

        }

        return $post_cat_cat_array;
    }

endif;

if( !function_exists( 'blog_prime_sanitize_sidebar_option' ) ) :

    // Sidebar Option Sanitize.
    function blog_prime_sanitize_sidebar_option( $input ){
        $metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $input,$metabox_options ) ){
            return $input;
        }
        else{
            return '';
        }
    }

endif;

if( !function_exists( 'blog_prime_posts_navigation' ) ) :

     // Posts Navigations.
    function blog_prime_posts_navigation(){

        $default = blog_prime_get_default_theme_options();
        $pagination_layout = esc_html( get_theme_mod( 'pagination_layout',$default['pagination_layout'] ) );

        if( $pagination_layout == 'classic' ){
            the_posts_navigation();
        }else{
            the_posts_pagination();
        }

    }

endif;

if( !function_exists( 'blog_prime_breadcrumb' ) ) :

    // Trail Breadcrumb.
    function blog_prime_breadcrumb(){ ?>

        <div class="twp-inner-banner">
            <div class="wrapper">

                <?php 
                $default = blog_prime_get_default_theme_options();
                $breadcrumb_layout = get_theme_mod('breadcrumb_layout',$default['breadcrumb_layout']);
                if( $breadcrumb_layout != 'disable' && !is_front_page() ):
                        breadcrumb_trail();
                endif; ?>

                <div class="twp-banner-details">

                    <?php
                    if( is_single() || is_page() ){

                        while (have_posts()) :
                            the_post();

                            if ( 'post' === get_post_type() ){
                                echo '<div class="entry-meta entry-meta-category">';
                                blog_prime_entry_footer( $cats = true,$tags = false,$edits = false );
                                echo '</div>';
                            }

                            echo '<header class="entry-header">';
                            
                                echo '<h1 class="entry-title entry-title-big">';
                                the_title();
                                echo '</h1>';

                                if ( 'post' === get_post_type() ){ ?>

                                    <div class="entry-meta">
                                        <?php
                                        blog_prime_posted_by();
                                        echo "<span class='sep-date-author'><i class='ion ion-ios-remove'></i></span>";
                                        blog_prime_posted_on();
                                        ?>
                                    </div><!-- .entry-meta -->

                                <?php }

                                echo "</header>";

                            blog_prime_post_thumbnail();

                            if( has_excerpt() ){
                                echo '<div class="twp-banner-excerpt">';
                                the_excerpt();
                                echo '</div>';
                            }

                        endwhile;

                    }

                    if( is_archive() ){ ?>
                        
                        <header class="page-header">
                            <?php
                            the_archive_title( '<h1 class="page-title">', '</h1>' );
                            the_archive_description( '<div class="archive-description">', '</div>' );
                            ?>
                        </header><!-- .page-header -->

                    <?php 
                    }

                    if( is_search() ){ ?>

                        <header class="page-header">
                            <h1 class="page-title">
                                <?php
                                /* translators: %s: search query. */
                                printf( esc_html__( 'Search Results for: %s', 'blog-prime' ), '<span>' . get_search_query() . '</span>' );
                                ?>
                            </h1>
                        </header><!-- .page-header -->

                    <?php } ?>

                </div>

            </div>
        </div>
    <?php
    }

endif;
add_action( 'blog_prime_header_banner_x','blog_prime_breadcrumb',20 );

if( !function_exists('blog_prime_post_formate_icon') ):

    // Post Formate Icon.
    function blog_prime_post_formate_icon( $formate ){

        if( $formate == 'video' ){
            $icon = 'ion-ios-play';
        }elseif( $formate == 'audio' ){
            $icon = 'ion-ios-musical-notes';
        }elseif( $formate == 'gallery' ){
            $icon = 'ion-md-images';
        }elseif( $formate == 'quote' ){
            $icon = 'ion-md-quote';
        }elseif( $formate == 'image' ){
            $icon = 'ion-ios-camera';
        }else{
            $icon = '';
        }

        return $icon;
    }

endif;

if( !function_exists('blog_prim_single_author_section') ):

    // Single Page Bottom Author Section.
    function blog_prim_single_author_section(){

        $default = blog_prime_get_default_theme_options();
        $ed_author_section = absint( get_theme_mod( 'ed_author_section', $default['ed_author_section'] ) );
        
        if (is_singular('post') && $ed_author_section) {

            $author_img = get_avatar_url( get_the_author_meta('ID'), array('size' => '400') );
            $author_name = esc_html( get_the_author_meta('display_name') );
            $author_user_url = esc_url( get_the_author_meta('user_url') );
            $author_description = esc_html( get_the_author_meta('description') );
            $author_email = esc_html( get_the_author_meta('user_email') );
            $author_post_url = esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>

            <div class="twp-author-details">
                <div class="author-details-wrapper">
                    <div class="twp-row">
                        <div class="column column-two">
                            <div class="author-image">
                                <img alt="<?php echo esc_attr( $author_name ); ?>" src="<?php echo esc_url( $author_img ); ?>">
                            </div>
                        </div>

                        <div class="column column-eight">
                            <div class="author-details">
                                <h4 class="author-name">
                                    <a href="<?php echo esc_url( $author_post_url ); ?>">
                                        <?php echo esc_html( $author_name ); ?>
                                    </a>
                                </h4>

                                <?php if ( $author_description ) { ?>
                                    <div class="author-description"><?php echo esc_html( $author_description ); ?></div>
                                <?php } ?>

                                <?php if ($author_email) { ?>
                                    <div class="author-email">
                                        <a href="mailto: <?php echo esc_html( $author_email ); ?>">
                                            <i class="author-ion ion-ios-mail"></i> <?php echo esc_html( $author_email ); ?>
                                        </a>
                                    </div>
                                <?php } ?>

                                <?php if ($author_user_url) { ?>
                                    <div class="author-url">
                                        <a href="<?php echo esc_url( $author_user_url ); ?>" target="_blank">
                                            <i class="author-ion ion-ios-globe"></i> <?php echo esc_url( $author_user_url ); ?>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }

    }
endif;

if( !function_exists('blog_prime_check_woocommerce_page') ):
    
    // Check if woocommerce pages.
    function blog_prime_check_woocommerce_page(){

        if( !class_exists( 'WooCommerce' ) ):
            return false;
        endif;

        if( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ){
            return true;
        }else{
            return false;
        }

    }
endif;

if ( ! function_exists( 'blog_prime_menu_toggle_button' ) ) :

    function blog_prime_menu_toggle_button( $args, $item, $depth ) {

        if ( $args->theme_location == 'twp-primary-menu' ) {
            if ( in_array( 'menu-item-has-children', $item->classes ) ) {
                $args->before = '<div class="link-icon-wrapper">';
                $args->after  = '</div>';
            } else {
                $args->before = '';
                $args->after  = '';
            }
        }
        return $args;

    }

    add_filter( 'nav_menu_item_args', 'blog_prime_menu_toggle_button', 10, 3 );

endif;

add_filter('booster_extension_filter_ss_ed', function () {
    return false;
});

if( class_exists( 'Booster_Extension_Class' ) ){

    add_filter('booster_extemsion_content_after_filter','blog_prime_after_content_pagination');

}

if( !function_exists('blog_prime_after_content_pagination') ):

    function blog_prime_after_content_pagination($after_content){

        $pagination_single = wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blog-prime' ),
                    'after'  => '</div>',
                    'echo' => false
                ) );

        $after_content =  $pagination_single.$after_content;

        return $after_content;

    }

endif;

if( !function_exists('blog_prime_post_floating_nav') ):

    function blog_prime_post_floating_nav(){

        $default = blog_prime_get_default_theme_options();
        $ed_floating_next_previous_nav = get_theme_mod( 'ed_floating_next_previous_nav',$default['ed_floating_next_previous_nav'] );

        if( 'post' === get_post_type() && $ed_floating_next_previous_nav ){

            $next_post = get_next_post();
            $prev_post = get_previous_post();

            if( isset( $prev_post->ID ) ){

                $prev_link = get_permalink( $prev_post->ID );?>

                <div class="floating-post-navigation floating-navigation-prev">
                    <?php if( get_the_post_thumbnail( $prev_post->ID,'medium' ) ){ ?>
                            <?php echo wp_kses_post( get_the_post_thumbnail( $prev_post->ID,'medium' ) ); ?>
                    <?php } ?>
                    <a href="<?php echo esc_url( $prev_link ); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Previous post', 'blog-prime'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
                    </a>
                </div>

            <?php }

            if( isset( $next_post->ID ) ){

                $next_link = get_permalink( $next_post->ID );?>

                <div class="floating-post-navigation floating-navigation-next">
                    <?php if( get_the_post_thumbnail( $next_post->ID,'medium' ) ){ ?>
                        <?php echo wp_kses_post( get_the_post_thumbnail( $next_post->ID,'medium' ) ); ?>
                    <?php } ?>
                    <a href="<?php echo esc_url( $next_link ); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Next post', 'blog-prime'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
                    </a>
                </div>

            <?php
            }

        }

    }

endif;

add_action( 'blog_prime_navigation_action','blog_prime_post_floating_nav',10 );