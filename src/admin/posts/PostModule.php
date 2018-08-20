<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 */

namespace WPBulkInsert\admin\posts;

use WPBulkInsert\admin\WPBulkInsert;

class PostModule extends WPBulkInsert
{
    public function __construct()
    {
        $this->initialize();
    }

    protected function initialize()
    {
        $this->page_slug = 'bulk-insert-posts';
    }

    public function register()
    {
        $this->add_menu();
        $this->add_hooks();
    }

    public function add_menu()
    {
        add_menu_page(
            __('Bulk Insert', 'wp-bulk-insert'),
            __('Bulk Insert', 'wp-bulk-insert'),
            $this->capability,
            $this->page_slug,
            [$this, 'render_page'],
            'dashicons-admin-page',
            26
        );
    }

    public function render_page()
    {
    }

    public function add_hooks()
    {
    }
}
