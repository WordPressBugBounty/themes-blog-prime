<?php
/**
* About Rencer Content.
*
* @package Blog Prime
*/


$base_url = home_url();

$blog_prime_panels_sections = array(

    'theme_general_settings' => array(

        'title' => esc_html__('General Settings','blog-prime'),
        'sections' => array(

            array(
                'title' => esc_html__('Logo & Site Identity','blog-prime'),
                'url'   => esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bcontrol%5D=custom_logo'),
                'icon'  => 'dashicons-format-image',
            ),
            array(
                'title' => esc_html__('Header Media','blog-prime'),
                'url'   => esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=header_image'),
                'icon'  => 'dashicons-desktop',
            ),
            array(
                'title' => esc_html__('Background Image','blog-prime'),
                'url'   => esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=background_image'),
                'icon'  => 'dashicons-desktop',
            ),
            array(
                'title' => esc_html__('Menu Settings','blog-prime'),
                'url'   => esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bpanel%5D=nav_menus'),
                'icon'  => 'dashicons-menu',
            ),

        ),

    ),
    'theme_colors_panel' => array(

        'title' => esc_html__('Color Settings','blog-prime'),
        'sections' => array(

            array(
                'title' => esc_html__('Color Options','blog-prime'),
                'url'   => esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=colors'),
                'icon'  => 'dashicons-admin-customizer',
            ),

        ),

    ),
    'theme_option_panel' => array(

        'title' => esc_html__('Theme Options','blog-prime'),
        'sections' => array(

            array(
                'title' => esc_html__('Header Settings','blog-prime'),
                'url'   => esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=header_mid_header_bar'),
                'icon'  => 'dashicons-align-center',
            ),
            array(
                'title' => esc_html__('Pagination Settings','blog-prime'),
                'url'   => esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=pagination_section'),
                'icon'  => 'dashicons-ellipsis',
            ),
            array(
                'title' => esc_html__('SIngle Post Settings','blog-prime'),
                'url'   => esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=single_post_setting'),
                'icon'  => 'dashicons-admin-settings',
            ),
            array(
                'title' => esc_html__('Layout Settings','blog-prime'),
                'url'   => esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=layout_setting'),
                'icon'  => 'dashicons-layout',
            ),
            array(
                'title' => esc_html__('Footer Setting','blog-prime'),
                'url'   => esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=footer_setting'),
                'icon'  => 'dashicons-admin-generic',
            ),

        ),

    ),
    'theme_home_panel' => array(

        'title' => esc_html__('Homepage Options','blog-prime'),
        'sections' => array(

            array(
                'title' => esc_html__('Layout Settings','blog-prime'),
                'url'   => esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=home_layout_setting'),
                'icon'  => 'dashicons-align-center',
            ),

        ),
        'title' => esc_html__('Homepage Options','blog-prime'),
        'sections' => array(

            array(
                'title' => esc_html__('Layout Settings','blog-prime'),
                'url'   => esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=home_layout_setting'),
                'icon'  => 'dashicons-admin-generic',
            ),
            array(
                'title' => esc_html__('Featured Post Settings','blog-prime'),
                'url'   => esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=featured_post_setting'),
                'icon'  => 'dashicons-admin-generic',
            ),
            array(
                'title' => esc_html__('Slider Settings','blog-prime'),
                'url'   => esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=slider_setting'),
                'icon'  => 'dashicons-admin-generic',
            ),
            array(
                'title' => esc_html__('Recommended Post Settings','blog-prime'),
                'url'   => esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=recommended_post_setting'),
                'icon'  => 'dashicons-admin-generic',
            ),

        ),

    ),

);

include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
$rec_plugins = Blog_Prime_Getting_started::blog_prime_recommended_plugins();
$theme_version = wp_get_theme()->get( 'Version' );
$theme_info      = wp_get_theme();
$theme_name            = $theme_info->__get( 'Name' );
$free_theme_url = 'https://www.themeinwp.com/theme/blog-prime';
$pro_theme_url = 'https://www.themeinwp.com/theme/blog-prime-pro';
?>
<div class="twp-about-main">

    <div class="about-page-header">
        <div class="about-wrapper">
            <div class="about-wrapper-inner">
                <div class="about-header-left">
                    <h1 class="about-theme-title">
                        <a href="<?php echo esc_url($free_theme_url); ?>">
                            <img src="<?php echo esc_url( get_template_directory_uri().'/assets/images/blog-prime-logo.png' ); ?>" class="about-theme-logo">
                            <span class="theme-version"><?php echo esc_html( $theme_version ); ?></span>
                        </a>
                    </h1>
                </div>
                <div class="about-header-right">
                    <div class="about-header-navigation">
                        <a target="_blank" class="about-header-links header-links-home" href="<?php echo esc_url($free_theme_url); ?>">
                            <?php esc_html_e('Theme Details', 'blog-prime'); ?>
                        </a>
                        <a target="_blank" class="about-header-links header-links-preview" href="<?php echo esc_url('https://demo.themeinwp.com/blog-prime'); ?>">
                            <?php esc_html_e('View Demo', 'blog-prime'); ?>
                        </a>
                        <a target="_blank" class="about-header-links header-links-review" href="<?php echo esc_url('https://wordpress.org/support/theme/blog-prime/reviews/?filter=5'); ?>">
                            <?php esc_html_e('Rate This Theme', 'blog-prime'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about-page-content">
        <div class="about-wrapper">
            <div class="about-wrapper-inner">

                <div class="about-content-left">

                    <?php
                    foreach( $blog_prime_panels_sections as $panels ){ ?>

                        <div class="about-content-panel">

                            <?php if( isset( $panels['title'] ) && $panels['title'] ){ ?>

                                <h2 class="about-panel-title"><?php echo esc_html( $panels['title'] );  ?></h2>

                            <?php } ?>
                            <div class="about-panel-items about-panel-2-columns">
                            <?php

                            if( isset( $panels['sections'] ) && $panels['sections'] ){

                                foreach( $panels['sections'] as $section ){ ?>


                                    <div class="about-items-wrap">
                                        <?php if( isset( $section['icon'] ) && $section['icon'] ){ ?>
                                            <span class="about-items-icon dashicons <?php echo esc_attr( $section['icon'] ); ?>"></span>
                                        <?php } ?>

                                        <?php if( isset( $section['title'] ) && $section['title'] && isset( $section['url'] ) && $section['url'] ){ ?>
                                            <span class="about-items-title">
                                                <a href="<?php echo esc_url( $section['url'] ); ?>"><?php echo esc_html( $section['title'] ); ?></a>
                                            </span>
                                        <?php } ?>
                                    </div>


                            <?php }

                            } ?>
                            </div>
                        </div>

                    <?php } ?>

                    <div class="about-content-panel">

                        <h2 class="about-panel-title"><?php esc_html_e('Recommended Plugins','blog-prime'); ?></h2>

                        <div class="about-panel-items about-panel-1-columns">

                            <?php foreach ($rec_plugins as $key => $plugin) {

                                $plugin_info = plugins_api(
                                    'plugin_information',
                                    array(
                                        'slug' => sanitize_key(wp_unslash($key)),
                                        'fields' => array(
                                            'sections' => false,
                                        ),
                                    )
                                );

                                $plugin_status = Blog_Prime_Getting_started::blog_prime_plugin_status($plugin['class'], $key, $plugin['PluginFile']); ?>

                                <div id="<?php echo 'blog-prime-' . esc_attr($key); ?>" class="about-items-wrap">
                                    <div class="theme-recommended-plugin <?php if ($plugin_status['status'] == 'active') { echo 'recommended-plugin-active'; } ?>">

                                        <?php if (isset($plugin_info->name)) { ?>
                                            <a href="javascript:void(0)"><?php echo esc_html($plugin_info->name); ?></a>
                                        <?php } ?>

                                        <?php if (isset($plugin_status['status']) && isset($plugin_status['string'])) { ?>

                                            <a class="recommended-plugin-status <?php echo 'twp-plugin-' . esc_attr($plugin_status['status']); ?>"
                                               plugin-status="<?php echo esc_attr($plugin_status['status']); ?>"
                                               plugin-file="<?php echo esc_attr($plugin['PluginFile']); ?>"
                                               plugin-folder="<?php echo esc_attr($key); ?>"
                                               plugin-slug="<?php echo esc_attr($key); ?>"
                                               plugin-class="<?php echo esc_attr($plugin['class']); ?>"
                                               href="javascript:void(0)"><?php echo esc_html($plugin_status['string']); ?></a>

                                        <?php } ?>

                                    </div>

                                </div>

                            <?php } ?>

                        </div>

                    </div>

                </div>

                <div class="about-content-right">

                    <div class="about-content-panel">
                        <h2 class="about-panel-title"><span class="dashicons dashicons-sos"></span> <?php esc_html_e('Looking for help?','blog-prime'); ?></h2>
                        <div class="about-content-info">
                            <p><?php esc_html_e('We have some resources available to help you in the right direction.','blog-prime'); ?></p>
                            <ul>
                                <li>
                                    <a href="<?php echo esc_url( 'https://www.themeinwp.com/support/' ); ?>" target="_blank" rel="noopener"><?php esc_html_e('Create a Ticket','blog-prime'); ?> &#187;</a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url( 'https://www.themeinwp.com/knowledgebase/' ); ?>" target="_blank" rel="noopener"><?php esc_html_e('Knowledge Base','blog-prime'); ?> &#187;</a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url( 'https://docs.themeinwp.com/docs/blog-prime' ); ?>" target="_blank" rel="noopener"><?php esc_html_e('Theme Documentation','blog-prime'); ?> &#187;</a>
                                </li>
                            </ul>
                            <p><?php esc_html_e('Behind every single customer support question stands a real person ready to fix the problem in real-time and guide you through.','blog-prime'); ?></p>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="about-wrapper">
            <div class="about-wrapper-inner">
                <div class="about-content-full">
                    <div class="about-wrapper-footer">
                        <h2 class="about-panel-title"><?php printf( __( 'Unlock all the Features with %1$s Pro', 'blog-prime' ), esc_html( $theme_name ) ); ?></h2>
                        <div class="about-footer-leftside">
                            <ul>
                                <li><span class="dashicons dashicons-yes"></span><?php esc_html_e('Color Options','blog-prime'); ?></li>
                                <li><span class="dashicons dashicons-yes"></span><?php esc_html_e('800+ Font Families','blog-prime'); ?></li>
                                <li><span class="dashicons dashicons-yes"></span><?php esc_html_e('More Custom Widgets','blog-prime'); ?></li>
                                <li><span class="dashicons dashicons-yes"></span><?php esc_html_e('More Customizer controls','blog-prime'); ?></li>
                                <li><span class="dashicons dashicons-yes"></span><?php esc_html_e('More page/post meta options','blog-prime'); ?></li>
                                <li><span class="dashicons dashicons-yes"></span><?php esc_html_e('Webmaster Tools','blog-prime'); ?></li>
                                <li><span class="dashicons dashicons-yes"></span><?php esc_html_e('Remove Footer Attribution (copyright)','blog-prime'); ?></li>
                                <li><span class="dashicons dashicons-yes"></span><?php esc_html_e('VIP priority Support','blog-prime'); ?></li>
                                <li><span class="dashicons dashicons-plus"></span><?php esc_html_e('much more stuff...','blog-prime'); ?></li>
                            </ul>
                        </div>
                        <div class="about-footer-rightside">
                            <div class="about-footer-upgrade">
                                <h3 class="footer-upgrade-title">
                                    <?php esc_html_e('Upgrade to Pro','blog-prime'); ?>
                                </h3>
                                <div class="footer-upgrade-price">
                                    <sup><?php esc_html_e('$','blog-prime'); ?></sup>
                                    <span><?php esc_html_e('49','blog-prime'); ?></span>
                                </div>
                                <div class="footer-upgrade-link">
                                    <a target="_blank" class="button button-primary button-primary-upgrade"  <a href="<?php echo esc_url($pro_theme_url); ?>"><?php esc_html_e('Upgrade to Pro','blog-prime'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>