<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 */

namespace WPBulkInsert\admin;

use WPBulkInsert\admin\posts\PostModule;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the WP Bulk Insert, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @author     Rajan V <rajanit2000@gmail.com>
 */
class WPBulkInsert
{
    /**
     * Slug of WP Bulk Insert.
     */
    const BULK_WP_MENU_SLUG = 'wp-bulk-insert';

    /**
     * Path to main plugin file.
     *
     * @var string
     */
    protected $plugin_file;

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     *
     * @var string The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     *
     * @var string The current version of this plugin.
     */
    private $version;

    /**
     * Page Slug.
     *
     * @var string
     */
    protected $page_slug;

    /**
     * Hook Suffix of the current page.
     *
     * @var string
     */
    protected $hook_suffix;

    /**
     * Current screen.
     *
     * @var \WP_Screen
     */
    protected $screen;

    /**
     * Minimum capability needed for viewing this page.
     *
     * @var string
     */
    protected $capability = 'manage_options';

    /**
     * Labels used in this page.
     *
     * @var array
     */
    protected $label = [
        'page_title' => '',
        'menu_title' => '',
    ];

    /**
     * List of Primary Admin pages.
     *
     * @var BasePage[]
     */
    private $primary_pages = [];

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version     The version of this plugin.
     */
    public function __construct()
    {
    }

    /**
     * Main WPBulkInsert Instance.
     *
     * Insures that only one instance of WPBulkInsert exists in memory at any one
     * time. Also prevents needing to define globals all over the place.
     *
     * @static
     * @staticvar array $instance
     *
     * @return WPBulkInsert The one true instance of WPBulkInsert.
     */
    public static function get_instance()
    {
        if (!isset(self::$instance) && !(self::$instance instanceof self)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function add_admin_menu()
    {
        foreach ($this->get_primary_pages() as $page) {
            $page->register();
        }
    }

    /**
     * Get the list of registered admin pages.
     */
    public function get_primary_pages()
    {
        if (empty($this->primary_pages)) {
            $posts_page = $this->get_insert_posts_admin_page();

            $this->primary_pages[$posts_page->get_page_slug()] = $posts_page;
        }

        return $this->primary_pages;
    }

    private function get_insert_posts_admin_page()
    {
        $posts_page = new PostModule();

        return $posts_page;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /*
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in WPBulkInsert_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The WPBulkInsert_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__).'css/wp-bulk-insert-admin.css', [], $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /*
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in WPBulkInsert_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The WPBulkInsert_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__).'js/wp-bulk-insert-admin.js', ['jquery'], $this->version, false);
    }

    /**
     * Getter for screen.
     *
     * @return \WP_Screen Current screen.
     */
    public function get_screen()
    {
        return $this->screen;
    }

    /**
     * Getter for page_slug.
     *
     * @return string Slug of the page.
     */
    public function get_page_slug()
    {
        return $this->page_slug;
    }

    /**
     * Getter for Hook Suffix.
     *
     * @return string Hook Suffix of the page.
     */
    public function get_hook_suffix()
    {
        return $this->hook_suffix;
    }

    /**
     * Get the url to the plugin directory.
     *
     * @return string Url to plugin directory.
     */
    protected function get_plugin_dir_url()
    {
        return plugin_dir_url($this->plugin_file);
    }
}
