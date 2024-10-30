<?php
/**
 * The plugin for Bitwords.io
 *
 * @wordpress-plugin
 * Plugin Name:       Bitwords.io
 * Description:       Show ads from the Bitwords.io site
 * Version:           1.4.1
 */
if (!defined('WPINC')) die;


// Include the admin dependencies needed to instantiate the plugin.
include_once plugin_dir_path(__FILE__) . "lib/BitwordsAPI.php";

include_once plugin_dir_path(__FILE__) . "admin/BitwordsMenu.php";
include_once plugin_dir_path(__FILE__) . "admin/BitwordsMenuPage.php";
include_once plugin_dir_path(__FILE__) . "admin/BitwordsSerializer.php";

include_once plugin_dir_path(__FILE__) . "include/shortcode.php";
// include_once plugin_dir_path(__FILE__) . "include/widget.php";


function bitwordsInsertAfterContent ($content) {
    // bail if the user has not accepted the license and the T&C
    if (get_option('bitwordsLicense') != '1') return $content;

    if (!is_single()) return $content;

    $publisherId = get_option('bitwordsPublisherId');
    if (!$publisherId) return $content;

    $pluginLogo = plugin_dir_url(__FILE__) . 'assets/logo.png';

    // process the php view file and capture the output in a variable
    ob_start();
    include(plugin_dir_path(__FILE__) . 'views/publisher.php');
    $output = ob_get_contents();
    ob_end_clean(); // Clear the buffer.

    return $content . $output; // Print everything.
}
add_filter('the_content', 'bitwordsInsertAfterContent');


/**
 * Starts the plugin.
 */
function bitwordsAdminSettings() {
    $serializer = new BitwordsSerializer();
    $serializer->init();

    $plugin = new BitwordsMenu(new BitwordsMenuPage());
    $plugin->init();
}
add_action('plugins_loaded', 'bitwordsAdminSettings');


/**
 * get data about the publisher
 */
function getBitwordsPublisherData() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'options';

    // get data from the db (mysql)
    $sql = "SELECT *
        FROM  $table_name
        WHERE option_name in ('siteurl', 'blogname', 'blogdescription', 'admin_email')
    ";
    $data = $wpdb->get_results($sql);

    $publisherData = new StdClass();

    // convert the data into a class object (encodable to json)
    for ($i = 0; $i < count($data); $i++) {
        $publisherData = (object) array_merge(
            (array) $publisherData,
            array($data[$i]->option_name => $data[$i]->option_value)
        );
    }

    return $publisherData;
}


/**
 * Proper way to enqueue scripts and styles
 */
function bitwordsScripts() {
    wp_enqueue_style('bitwords_style', plugin_dir_url(__FILE__) . 'assets/style.v3.min.css', array(), '1.3.0');
    wp_enqueue_script('bitwords_script', plugin_dir_url(__FILE__) . 'assets/script.v4.min.js', array(), '1.3.0', true);
}
add_action('wp_enqueue_scripts', 'bitwordsScripts');


/**
 * Execute after activate
 */
function bitwordsAdminSettingsActivate() {
    $api = new BitwordsAPI();

    // If the site is already registered, we bail
    // TODO: Verify if the verification token is still valid. If it's not then we re-register the server
    if(get_option('bitwordsPublisherId') != NULL) return;

    /**
     * On activation of plugin, make POST request to the bitwords server for
     * registering the publisher and saving the publisher id and secret obtained
     * in response in db
     */
    $response = $api->registerPlugin(getBitwordsPublisherData());

    // save the publisher key and publisher id that is obtained from bitwords to the publisher db
    add_option('bitwordsPublisherKey', $response->token);
    add_option('bitwordsPublisherId', $response->id);
}
register_activation_hook(__FILE__, 'bitwordsAdminSettingsActivate');


/**
 * send the article data to bitwords on publish or update of post
 */
function bitwordsOnArticlePublishOrUpdate($new, $old, $post) {
    $api = new BitwordsAPI();

    // Only process published posts
    if ($new != 'publish') return

    // get the content of post without tags
    $content = wp_strip_all_tags($post->post_content);
    // get the url of post thumbnail
    $thumbnailUrl = get_the_post_thumbnail_url($post);

    // fields for advertisment
    $data = array(
        'authorId' => intval($post->post_author),
        'comments' => intval($post->comment_count),
        'content' => $content,
        'guid' => $post->guid,
        'imageUrl' => get_the_post_thumbnail_url($post),
        'postId' => intval($post->ID),
        'publishedAt' => $post->post_date,
        'title' => $post->post_title,
        'url' => get_post_permalink($post),
    );

    // send this data to bitwords
    $api->sendPost($data);
}

add_action('transition_post_status', 'bitwordsOnArticlePublishOrUpdate', 10, 3);
