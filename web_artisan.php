<?php
/*
Plugin Name: Web Artisan
Plugin URI: https://rafiqul.info/web_artisan
Description: to increase your web experience
Version: 1.0.0
Author: Rafiqul Islam
Author URI: https://rafiqul.info/
Text Domain: web_artisan
Domain Path: /lg
*/

    if (!defined('ABSPATH'))
    {
        exit;
    }
class web_artisan
{
    const VERSION=1.0;
    const MINIMUM_ELEMENTOR_VERSION=2.0;
    const MINIMUM_PHP_VERSION=7.0;

    private static $_instance = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    public function __construct() {
        add_action( 'plugins_loaded', [ $this, 'init' ] );
    }
    public function init() {
        load_plugin_textdomain( 'web_artisan' );
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'web_artisan_admin_notice_missing_main_plugin' ] );
            return;
        }
    }

    public function web_artisan_admin_notice_missing_main_plugin() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor */
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-test-extension' ),
            '<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test-extension' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'elementor-test-extension' ) . '</strong>'
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }
    public function includes() {}

}
web_artisan::instance();