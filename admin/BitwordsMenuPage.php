<?php


/**
 * Creates the menu for the plugin.
 *
 * @package Bitwords
 */
class BitwordsMenuPage {
    /**
     * This function renders the contents of the page associated with the menu
     * that invokes the render method. In the context of this plugin, this is the
     * Menu class.
     */
    public function render() {
        $api = new BitwordsAPI();
        $dataForPublisher = $api->summary();

        if (empty(get_option('bitwordsLicense'))) include_once('views/agreement.php');
        else include_once('views/settings.php');
    }
}
