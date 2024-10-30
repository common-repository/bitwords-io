<?php

/**
 * Creates the menu item for the plugin.
 *
 * @package Bitwords
 */
class BitwordsMenu {
    /**
     * A reference the class responsible for rendering the menu page.
     */
    private $menu;


    /**
     * Constructor
     * @param type $menu
     */
    public function __construct($menu) {
        $this->menu = $menu;
    }


    /**
     * Adds a menu for the plugin to the admin menu.
     */
    public function init() {
        add_action('admin_menu', array($this, 'add_bitwords_page'));
    }


    /**
     * Creates the menu item and calls on the menu Page object to render
     */
    public function add_bitwords_page() {
        add_menu_page(
            'Bitwords.io Settings',
            'Bitwords.io',
            'manage_options',
            'bitwords-page',
            array($this->menu, 'render'),
            'dashicons-editor-bold'
        );
    }
}
