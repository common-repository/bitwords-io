<div
  id="bitwords-settings"
  data-afterarticlesmaxstories="<?php echo $bitwordsAfterArticleMaxStories ?>"
  data-afterarticlesstoresinrow="1"
  data-afterarticlesenabled="1"
  data-publisherId="<?php echo get_option('bitwordsPublisherId', 1) ?>"
  style="display: none"></div>

<section class="bitwords-section" id="bitwords-container" style="display: none">
  <div class="bitwords-header">
    <div class="bitwords-title">
      <?php echo get_option('bitwordsTitleRecommendedArticles', 'Sponsored Content') ?>
    </div>

    <div id="bitwords-generated-list"></div>

    <div class="bitwords-logo-link">
      recommended by
      <a href="https://bitwords.io" target="_blank">
        <img class="bitwords-logo" src="<?php echo $pluginLogo ?>">
      </a>
    </div>
  </div>
<section>