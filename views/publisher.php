<div
  id="bitwords-settings"
  data-afterarticlesmaxstories="<?php echo get_option('bitwordsAfterArticleMaxStories', 6) ?>"
  data-afterarticlesstoresinrow="<?php echo get_option('bitwordsAfterArticleStoriesInRow', 3) ?>"
  data-afterarticlesenabled="<?php echo get_option('bitwordsAfterArticleEnabled', 1) ?>"
  data-publisherId="<?php echo get_option('bitwordsPublisherId', 1) ?>"
  style="display: none"></div>

<section class="bitwords-section" id="bitwords-container" style="display: none">
  <div class="bitwords-header">
    <div class="bitwords-title">
      <?php echo get_option('bitwordsTitleRecommendedArticles', 'Sponsored Content') ?>
    </div>

    <div class="bitwords-logo-link">
      recommended by
      <a href="https://bitwords.io" target="_blank">
        <img class="bitwords-logo" src="<?php echo $pluginLogo ?>">
      </a>
    </div>
  </div>

  <div id="bitwords-generated-list"></div>
<section>