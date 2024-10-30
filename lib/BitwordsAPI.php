<?php

/**
 * Helper class to communicate with the Bitwords API
 *
 * @author enamakel@cryptocontrol.io
 * @author ditesh@cryptocontrol.io
 */
class BitwordsAPI {
    /**
     * Creates a new request
     *
     * @param string $url The URL to make the call to
     * @param array $data The data to send to
     * @return type
     */
    private function _api($url, $data = array()) {
        $HOST = "https://app.bitwords.io/api/v1";
        // $HOST = "http://192.168.10.204:5999/api/v1";

        // Find the publisher's key so that we can authenticate with the server
        $apiKey = get_option('bitwordsPublisherKey');

        $options = array(
            'method' => 'POST',
            'timeout' => 5,
            'redirection' => 2,
            'blocking' => true,
            'headers' => array(
                'User-Agent' => 'Bitwords WP plugin',
                'x-plugin' => "$apiKey"
            ),
            'body' => $data
        );

        $response = wp_remote_post($HOST . $url, $options);

        if (is_wp_error($response)) return NULL;

        if ($response["response"]["code"] == 200) {
            $responseBody = json_decode($response["body"]);
            return $responseBody;
        }
    }


    /**
     * Registers the plugin with the given site data
     */
    public function registerPlugin ($data) {
        return $this->_api('/publishers/wordpress', $data);
    }


    /**
     * Connects a plugin with a given user
     */
    public function connect ($data) {
        return $this->_api('/publishers/wordpress/connect', $data);
    }


    /**
     * Get a summary of the plugin's progress
     */
    public function summary () {
        return $this->_api('/publishers/wordpress/summary');
    }


    /**
     * Sets the wallet address for the given plugin
     */
    public function saveWalletAddress ($walletAddress) {
        $this->_api('/publishers/wordpress/walletAddress', array("walletAddress" => $walletAddress));
    }


    /**
     * Send published or updated articles to bitwords
     */
    public function sendPost ($post) {
        $this-> _api('/publishers/wordpress/post', $post);
    }


    /**
     * Update the plublisher's plugin
     */
    public function updatePlugin ($plugin) {
        $this-> _api('/publishers/wordpress/update', $plugin);
    }
}
