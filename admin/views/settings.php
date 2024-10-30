<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
  .bitwords-container {
    margin-right: 30px;
  }

  h2 {
    margin-bottom: 25px
  }

  .tab-content {
    background: #f6f6f6;
    padding: 15px;
    border: 1px solid #DDD;
    border-top: 0
  }

  .tab-content input[type='checkbox'] {
    margin: 0
  }

  p.submit {
    margin: 0;
    padding-bottom: 0;
  }

  input.text, textarea {
    margin-top: 5px;
    padding: 7px;
    width: 100%;
  }

  .bitwords-input-group {
    border-bottom: 1px solid #DDD;
    padding-bottom: 10px;
    margin-bottom: 15px
  }

  .bitwords-input-group span {
    color: #777
  }
</style>

<div class="bitwords-container">
  <h2>Bitwords.io Settings</h2>

  <ul class="nav nav-tabs" id="bitwords-tab">
    <!-- <li class="active"><a data-toggle="tab" href="#menu1">Statistics</a></li> -->
    <li class="active"><a data-toggle="tab" href="#menu2">Payout</a></li>
    <li><a data-toggle="tab" href="#menu3">Settings</a></li>
  </ul>

  <div class="tab-content">
    <!-- <?php include_once('tab_statistics.php'); ?> -->
    <?php include_once('tab_payouts.php'); ?>
    <?php include_once('tab_settings.php'); ?>
  </div>

  <br />
  <div class="bitwords-input-group">
    For any issues, please contact <a href="mailto:support@bitwords.io">support@bitwords.io</a> with your plugin id:
    <b><?php echo get_option('bitwordsPublisherId') ?></b>
    <br />
  </div>
</div>

<script>
  $('#bitwords-tab a').click(function(e) {
    e.preventDefault();
    $(this).tab('show');
  });

  // store the currently selected tab in the hash value
  $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
    var id = $(e.target).attr("href").substr(1);
    window.location.hash = id;
  });

  // on load of the page: switch to the currently selected tab
  var hash = window.location.hash;
  $('#bitwords-tab a[href="' + hash + '"]').tab('show');
</script>