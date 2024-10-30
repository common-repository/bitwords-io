<?php

/**
 * Performs all sanitization functions required to save the option values to
 * the database.
 *
 * @package Bitwords
 */
class BitwordsSerializer {
    /**
     * Initializes the function by registering the save function
     */
    public function init() {
        add_action('admin_post', array($this, 'save'));
    }


    /**
     * Save POST data
     */
    public function save() {
        $api = new BitwordsAPI();

        switch ($_POST['bitwords_action']) {
            case 'verify_token':
                if (!isset($_POST['verificationToken'])) break;

                $response = $api->connect(array('verificationToken' => $_POST['verificationToken']));

                if ($response->publisher)
                    update_option('bitwordsUserId', $response->publisher);

                if ($response->publisherWalletAddress)
                    update_option('bitwordsEthWithdrawAddess', $response->publisherWalletAddress);
                break;


            case 'agree_license':
                add_option('bitwordsLicense', 1);
                break;


            case 'save_payout':
                if (!isset($_POST['bitwordsEthWithdrawAddess'])) break;
                $walletAddress = sanitize_text_field($_POST['bitwordsEthWithdrawAddess']);

                $api->saveWalletAddress($walletAddress);
                add_option('bitwordsEthWithdrawAddess', $walletAddress);
                break;


            case 'save_settings':
                if (isset($_POST['bitwordsAfterArticleEnabled'])) {
                    $afterArticleEnabled = sanitize_text_field($_POST['bitwordsAfterArticleEnabled']);
                    add_option('bitwordsAfterArticleEnabled', $afterArticleEnabled == 'on' ? 1 : 0);
                }

                if (isset($_POST['bitwordsTitleRecommendedArticles'])) {
                    $titleRecommendedArticles = sanitize_text_field($_POST['bitwordsTitleRecommendedArticles']);
                    add_option('bitwordsTitleRecommendedArticles', $titleRecommendedArticles);
                }

                if (isset($_POST['bitwordsAfterArticleMaxStories']) && is_numeric($_POST['bitwordsAfterArticleMaxStories'])) {
                    $afterArticleMaxStories = intval($_POST['bitwordsAfterArticleMaxStories']);
                    add_option('bitwordsAfterArticleMaxStories', $afterArticleMaxStories);
                }

                if (isset($_POST['bitwordsAfterArticleStoriesInRow']) && is_numeric($_POST['bitwordsAfterArticleStoriesInRow'])) {
                    $afterArticleStoriesInRow = intval($_POST['bitwordsAfterArticleStoriesInRow']);
                    add_option('bitwordsAfterArticleStoriesInRow', $afterArticleStoriesInRow);
                }

                if (isset($_POST['bitwordsCustomCSS'])) {
                    $customCSS = sanitize_text_field($_POST['bitwordsCustomCSS']);
                    add_option('bitwordsCustomCSS', $customCSS);
                }

                if (isset($_POST['bitwordsBlacklistDomains'])) {
                    $bitwordsBlacklistDomains = sanitize_text_field($_POST['bitwordsBlacklistDomains']);
                    $api->updatePlugin(array('blacklistedDomains' => $bitwordsBlacklistDomains));
                }

                break;
        }


        $this->redirect();
    }


    /**
     * Redirect to the admin page
     * @access private
     */
    private function redirect() {
        $url = get_home_url() . '/wp-admin/admin.php?page=bitwords-page';
        wp_safe_redirect(urldecode($url));
        exit;
    }
}
