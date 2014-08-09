<?php

/*
 * Plugin Name: BigMailChimp
 * Plugin URI: http://bigemployee.com/projects/big-mailchimp-wordpress-plugin/
 * Description: Display your mail chimp capture form on your wordpress site.
 * Author: Arian Khosravi, Norik Davtian
 * Author URI: http://bigemployee.com
 * Version: 2.0.1
 * License: GPL3
 * License URI: http://www.gnu.org/licenses/gpl.html
 */
include plugin_dir_path(__FILE__) . 'includes/functions.php';

class BigMailChimp {

    const BIGMAILCHIMP_DB_VERSION = 2;

    function BigMailChimp() {
        $db_version = get_option('BigMailChimp_DB_version');
        if ($db_version && $db_version < self::BIGMAILCHIMP_DB_VERSION) {
            $this->init_update($db_version);
        }

        define('BIGMAILCHIMP_PATH', plugin_dir_path(__FILE__));
        define('BIGMAILCHIMP_URL', plugins_url('', __FILE__) . '/');
        add_action('init', array(&$this, 'init_BigMailChimp_Scripts'));
        add_action('widgets_init', array(&$this, 'init_BigMailChimp_Widgets'));
        add_action('admin_enqueue_scripts', array(&$this, 'init_BigMailChimp_admin_head'));
        add_action('admin_menu', array(&$this, 'init_BigMailChimp_menu'));
        add_action('load-post.php', array(&$this, 'init_BigMailChimp_MetaBox'));
        add_action('load-post-new.php', array(&$this, 'init_BigMailChimp_MetaBox'));
        add_action('wp_footer', array(&$this, 'print_BigMailChimp_Frontend_Scripts'));
        add_action('wp_print_styles', array(&$this, 'print_BigMailChimp_Frontend_Styles'));
        add_shortcode('BigMailChimp', array(&$this, 'init_BigMailChimp_ShortCode'));
    }

    function init_BigMailChimp_menu() {
        $menu_page = add_menu_page('Big MailChimp', 'Big MailChimp', 'install_plugins', "big-mailchimp", array(&$this, 'init_bigMailChimp'), 'dashicons-megaphone');
        $lists_page = add_submenu_page('big-mailchimp', 'Big Mailchimp', 'MailChimp Lists', 'edit_theme_options', 'big-mailchimp', array(&$this, 'init_BigMailChimp'));
        $settings_page = add_submenu_page('big-mailchimp', 'Big Mailchimp', 'Settings', 'edit_theme_options', 'big-mailchimp-settings', array(&$this, 'init_BigMailChimp_Settings'));
        add_submenu_page('big-mailchimp', 'Big Mailchimp', 'Donate', 'edit_theme_options', 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=89MSWEH4RSBEY');
        add_action('admin_print_styles-' . $lists_page, array(&$this, 'print_BigMailChimp_admin_styles'));
        add_action('load-' . $lists_page, array(&$this, 'init_BigMailChimp_Help_Tab'));
        add_action('load-' . $settings_page, array(&$this, 'init_BigMailChimp_Help_Tab'));
    }

    function init_BigMailChimp() {
        include_once 'library/Loader.php';
        Loader::init();
        include_once 'controllers/bigMailChimpController.php';
    }

    function init_BigMailChimp_Settings() {
        include_once 'library/Loader.php';
        Loader::init();
        include_once 'controllers/adminController.php';
    }

    function init_BigMailChimp_Scripts() {
        $bigMailChimpOptions = bigMailChimp_get_options();
        wp_register_style('bigMailChimp-adimn-style', plugins_url('views/css/admin.min.css', __FILE__), false, '1.0', 'all');
        if ($bigMailChimpOptions['load_css']) {
            wp_register_style('bigMailChimp-style', plugins_url('views/css/bigMailChimp.min.css', __FILE__), false, '1.0', 'all');
        }

        wp_register_script('bigMC-shortcode-script', plugins_url('views/js/bigMC-shortCode.min.js', __FILE__), array('jquery'), '1.0', true);
        if ($bigMailChimpOptions['load_script']) {
            wp_register_script('BigMailChimp-submit-script', plugins_url('views/js/BigMailChimp.min.js', __FILE__), array('jquery'), '1.0', true);
        }
    }

    function print_BigMailChimp_admin_styles() {
        wp_enqueue_style('bigMailChimp-adimn-style');
    }

    function init_BigMailChimp_admin_head($hook) {
        if ('post.php' == $hook || 'post-new.php' == $hook) {
            wp_enqueue_script('jquery');
            wp_enqueue_script('bigMC-shortcode-script');
        }
    }

    function print_BigMailChimp_Frontend_Styles() {
        wp_enqueue_style('bigMailChimp-style');
    }

    function print_BigMailChimp_Frontend_Scripts() {
        wp_enqueue_script('jquery');
        wp_enqueue_script('BigMailChimp-submit-script');
    }

    function init_BigMailChimp_Widgets() {
        include_once 'library/Loader.php';
        Loader::init();
        register_widget("MCFormWidget");
    }

    function init_BigMailChimp_ShortCode($atts, $content = NULL) {
        include_once 'library/Loader.php';
        Loader::init();
        extract(shortcode_atts(array(
            'list' => '',
            'required_fields' => false), $atts));
        $MCMapper = new MCListMapper();
        if ($MClist = $MCMapper->find($list, new MCList())) {
            $api2 = new MCAPI2_Mailchimp($MClist->getApi_key());
            $list_prop = $api2->lists->getList(array('list_id' => $MClist->getList_id()));

            $form = new Forms_MCGenerated($list_prop['data'][0]['web_id'], BIGMAILCHIMP_URL . "includes/mc.php?id=" . $MClist->getId(), 'post', $MClist->getButton_text(), NULL, array('apiKey' => $MClist->getApi_key(),
                'listId' => $MClist->getList_id()));
            return $form->print_form($required_fields);
        }
    }

    function init_BigMailChimp_Help_Tab() {
        $screen = get_current_screen();
        $screen->add_help_tab(array(
            'id' => 'bigMailChimp_overview',
            'title' => 'Overview',
            'content' =>
            '<p>' . 'The main purpose of BigMailChimp plugin is to enable the user to host their MailChimp capture forms on their own website without the need to write a single line of code. Moreover, you can display your capture forms as widgets or as standalone forms on individual posts. Simply create/modify your forms on MailChimp and the effects will take effect on your site instantly.' . '</p>' .
            '<p>' . 'Add your Mailchimp lists and display them on your site in the content area or as a widget.' . '</p>' .
            '<p>' . 'Customize your Mailchimp forms and interaction further by changing the `Subscribe to list` button text, enabling/disabling the <a href="http://kb.mailchimp.com/article/how-does-confirmed-optin-or-double-optin-work/">double opt-in</a> feature and display the entire form or opt for a shorter form by displaying the required fields only.' . '</p>' .
            '<p>' . 'For the list of all features and how-tos visit the <a href="http://bigemployee.com/projects/">plugins page</a>.' . '</p>'
        ));
        $screen->add_help_tab(array(
            'id' => 'bigMailChimp_add',
            'title' => 'Add New List',
            'content' =>
            '<p>' . 'Press Add new and enter API Key/List ID to add a list.' . '</p>' .
            '<p>' . '1. To obtain your API Key visit <a href="http://admin.mailchimp.com/account/api">Mailchimp API Page</a>' . '</p>' .
            '<p>' . '2. To obtain the list id login to your <a href="http://mailchimp.com">MailChimp account</a>, go to `List > Settings > List name & defaults`, and look for the `List ID`.' . '</p>' .
            '<p>' . '3. Customize the `Sing Up` button text.' . '</p>' .
            '<p>' . '4. Enable/Disable the Double Opt In feature. For more information visit <a href="http://kb.mailchimp.com/article/how-does-confirmed-optin-or-double-optin-work/">How does double opt-in work?</a>' . '</p>' .
            '<p>' . 'For the list of all features and how-tos visit the <a href="http://bigemployee.com/projects/">plugins page</a>.' . '</p>'
        ));
        $screen->set_help_sidebar(
                '<p>If you like our plugin, feel free donate some spare change so we can refill our coffee pot and continue working to bring you more awesome plugins and themes.</p>' .
                '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">' .
                '<input type="hidden" name="cmd" value="_s-xclick">' .
                '<input type="hidden" name="hosted_button_id" value="89MSWEH4RSBEY">' .
                '<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">' .
                '<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">' .
                '</form>' .
                '<p>Please <a href="http://wordpress.org/extend/plugins/bigmailchimp/">rate us on WordPress</a></p>' .
                '<p><strong>For more information:</strong></p>' .
                '<p><a href="http://www.bigemployee.com">www.bigemployee.com</a></p>');
    }

    function init_BigMailChimp_MetaBox() {
        include_once 'library/Loader.php';
        Loader::init();
        $screen = get_current_screen();
        $screen->add_help_tab(array(
            'id' => 'bigMailChimp_settings',
            'title' => 'Big Mailchimp Page',
            'content' =>
            '<p>' . 'Simply select one of your Mailchimp lists from the BigMailChimp meta box. Decide wether to display the entire form or just the required fields as indicated on your mailchimp form. Click `Insert Into Page` to add the selected form to your page/post.' . '</p>' .
            '<p>' . 'If BigMailChimp meta box is not available on this page you can enable it from the Screen Options drawer.' . '</p>' .
            '<p>' . 'For the list of all features and how-tos visit the <a href="http://bigemployee.com/projects/">plugins page</a>.' . '</p>' .
            '<p>If you like our plugin, feel free donate some spare change so we can refill our coffee pot and continue working to bring you more awesome plugins and themes.</p>' .
            '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">' .
            '<input type="hidden" name="cmd" value="_s-xclick">' .
            '<input type="hidden" name="hosted_button_id" value="89MSWEH4RSBEY">' .
            '<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">' .
            '<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">' .
            '</form>' .
            '<p>Please <a href="http://wordpress.org/extend/plugins/bigmailchimp/">rate us on WordPress</a></p>' .
            '<p><strong>For more information:</strong></p>' .
            '<p><a href="http://www.bigemployee.com">www.bigemployee.com</a></p>'));
        return new MCShortCodeGen();
    }

    static function installBigMailChimp() {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        global $wpdb;

        $lists_table = $wpdb->prefix . 'big_mailchimp_lists';

        $query = "DROP TABLE IF EXISTS `$lists_table`;

CREATE TABLE IF NOT EXISTS `$lists_table` (
`id` INT NOT NULL AUTO_INCREMENT,
`api_key` VARCHAR(255) NULL,
`list_id` VARCHAR(255) NULL,
`double_opt_in` binary(255) NOT NULL DEFAULT '1',
`button_text` VARCHAR(255) NOT NULL DEFAULT 'Subscribe to list',
PRIMARY KEY (`id`))";
        dbDelta($query);

        update_option("BigMailChimp_DB_version", self::BIGMAILCHIMP_DB_VERSION);
    }

    function init_update($version) {
        global $wpdb;

        $lists_table = $wpdb->prefix . 'big_mailchimp_lists';

        if ((int) $version < 2) {
            $query = "alter table $lists_table "
                    . "add column `double_opt_in` binary(255) NOT NULL DEFAULT '1',"
                    . "add column `button_text` VARCHAR(255) NOT NULL DEFAULT 'Subscribe to list';";
            $wpdb->query($query);
            update_option('bigMailChimp_options', array(
                'load_script' => true,
                'load_css' => true,
                'form_layout' => 'Forms_MC',
            ));
        }
        update_option("BigMailChimp_DB_version", self::BIGMAILCHIMP_DB_VERSION);
    }

}

register_activation_hook(__FILE__, array('BigMailChimp', 'installBigMailChimp'));
$mybackuper = new BigMailChimp(); //instance of the plugin class