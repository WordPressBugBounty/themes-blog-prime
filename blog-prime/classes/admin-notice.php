<?php
if ( !class_exists('Blog_Prime_Dashboard_Notice') ):

    class Blog_Prime_Dashboard_Notice
    {
        function __construct()
        {	
            global $pagenow;

        	if( $this->blog_prime_show_hide_notice() ){

                add_action( 'admin_notices',array( $this,'blog_prime_admin_notice' ) );
                
	        }
	        add_action( 'wp_ajax_blog_prime_notice_dismiss', array( $this, 'blog_prime_notice_dismiss' ) );
			add_action( 'switch_theme', array( $this, 'blog_prime_notice_clear_cache' ) );

            if( isset( $_GET['page'] ) && $_GET['page'] == 'blog-prime-about' ){

                add_action('in_admin_header', array( $this,'blog_prime_hide_all_admin_notice' ),1000 );

            }

        }

        public function blog_prime_hide_all_admin_notice(){

            remove_all_actions('admin_notices');
            remove_all_actions('all_admin_notices');

        }
        
        public static function blog_prime_show_hide_notice(){

            // Check If current Page 
            if ( isset( $_GET['page'] ) && $_GET['page'] == 'blog-prime-about'  ) {
                return false;
            }

        	// Hide if dismiss notice
        	if( get_option('blog_prime_admin_notice') ){
				return false;
			}
            // Hide if all plugin active
            if ( class_exists( 'Booster_Extension_Class' ) &&  class_exists( 'Demo_Import_Kit_Class' )  &&  class_exists( 'Themeinwp_Import_Companion' ) ) {
                return false;
            }

			// Hide On TGMPA pages
			if ( ! empty( $_GET['tgmpa-nonce'] ) ) {
				return false;
			}
			// Hide if user can't access
        	if ( current_user_can( 'manage_options' ) ) {
				return true;
			}
			
        }

        // Define Global Value
        public static function blog_prime_admin_notice(){

            $theme_info      = wp_get_theme();
            $theme_name            = $theme_info->__get( 'Name' ); ?>

            <div class="updated notice is-dismissible twp-blog-prime-notice">

                <p class="notice-text">
                    <?php
                    $current_user = wp_get_current_user();

                    printf(
                    /* Translators: %1$s current user display name., %2$s this theme name., %3$s discount coupon code., %4$s discount percentage. */
                        esc_html__(
                            'Howdy, %1$s! You\'ve been using %2$s theme for a while now, and we hope you\'re happy with it. If you would like to access additional premium features, you can upgrade to the pro version. Your current content and settings will remain unchanged after upgrading. Thank you for choosing %2$s! ',
                            'blog-prime'
                        ),
                        '<strong>' . esc_html( $current_user->display_name ) . '</strong>',
                        $theme_name
                    );

                    ?>
                </p>


                <p>
                    <a target="_blank" class="button button-primary twp-button-primary" href="<?php echo esc_url( 'https://www.themeinwp.com/theme/blog-prime-pro/' ); ?>">
                        <span class="dashicons dashicons-thumbs-up"></span>
                        <span><?php esc_html_e('Upgrade to Pro','blog-prime'); ?></span>
                    </a>

                    <a class="button button-secondary twp-install-active" href="javascript:void(0)">
                        <span class="dashicons dashicons-admin-plugins"></span>
                        <span><?php esc_html_e('Install and enable the recommended plugins','blog-prime'); ?></span>
                    </a>
                    <span class="quick-loader-wrapper"><span class="quick-loader"></span></span>

                    <a target="_blank" class="button button-secondary" href="<?php echo esc_url( 'https://demo.themeinwp.com/blog-prime/' ); ?>">
                        <span class="dashicons dashicons-welcome-view-site"></span>
                        <span><?php esc_html_e('View Demo','blog-prime'); ?></span>
                    </a>

                    <a target="_blank" class="button button-primary" href="<?php echo esc_url('https://wordpress.org/support/theme/blog-prime/reviews/?filter=5'); ?>">
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span><?php esc_html_e('Leave a review', 'blog-prime'); ?></span>
                    </a>

                    <a class="btn-dismiss twp-custom-setup" href="javascript:void(0)"><?php esc_html_e('Dismiss this notice.','blog-prime'); ?></a>

                </p>

            </div>

        <?php
        }

        public function blog_prime_notice_dismiss(){
            check_ajax_referer( 'blog_prime_ajax_nonce', 'security' );
            update_option('blog_prime_admin_notice','hide');
            die();

        }

        public function blog_prime_notice_clear_cache(){

        	update_option('blog_prime_admin_notice','');

        }

    }
    new Blog_Prime_Dashboard_Notice();
endif;