<div id="menu3" class="tab-pane fade in">
  <form method="post" action="<?php echo esc_html(admin_url('admin-post.php')); ?>" id="settings">
    <div class="bitwords-input-group">
      <b>Title to show for the recommended articles:</b>
      <input
        name="bitwordsTitleRecommendedArticles"
        type="text"
        placeholder
        value="<?php echo get_option('bitwordsTitleRecommendedArticles', 'Sponsored Content') ?>" />
      <br />
    </div>
    <div class="bitwords-input-group">
      <b>Show recommended stories right below the article:</b>
      <input
        name="bitwordsAfterArticleEnabled"
        type="checkbox"
        <?php echo get_option('bitwordsAfterArticleEnabled', 1) == '0' ? '' : 'checked'; ?> />
      <br />
    </div>

    <div class="bitwords-input-group">
      <b>Number of recommended stories right below the article:</b>
      <input
        name="bitwordsAfterArticleMaxStories"
        type="number" min="0" max="10" placeholder="6"
        value="<?php echo get_option('bitwordsAfterArticleMaxStories', 6) ?>" />

      <br />
      <br />

      <b>Number of stories in a row:</b><br />
      <span>In desktop mode, how many stories should be there in a single row?</span>
      <input
        name="bitwordsAfterArticleStoriesInRow"
        type="number" min="1" max="4" placeholder="3"
        value="<?php echo get_option('bitwordsAfterArticleStoriesInRow', 3) ?>" />
      <br />
    </div>


    <div class="bitwords-input-group">
      <b>Blacklist domains:</b><br />
      <span>Here you can specify which domains you'd like to blacklist. Ads from these sites will not be
      displayed on this website. </span>
      <br />
      <input
        style="min-width: 300px"
        name="bitwordsBlacklistDomains" type="text" placeholder="example1.com,example2.com"
        value="<?php echo $dataForPublisher->blacklistedDomains; ?>"/>
    </div>

    <!-- <div class="bitwords-input-group">
      <b>Custom CSS</b><br />
      <span>Custom CSS that you can use to customise the look and feel of the ads.</span><br />
      <textarea style="font-family: monospace;" rows="10" name="bitwordsCustomCSS"><?php echo $options['custom_css']; ?></textarea>
    </div> -->

    <input type="hidden" name="bitwords_action" value="save_settings" />
    <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Settings">
    <!-- <input
      id="reset-button"
      onclick="resetEverything()"
      type="submit" name="submit" id="submit" class="button button-secondary" value="Reset Everything"> -->
  </form>
</div>

<script>
  var btn = document.getElementById("reset-button")
  btn.onclick = function (event) {
    event.preventDefault()
    var r = confirm("Are you sure you want to reset everything? Your site will get re-registered with Bitwords.");
    if (r == true) {
      txt = "You pressed OK!";
    } else {
      txt = "You pressed Cancel!";
    }
  }
</script>