<div id="menu2" class="tab-pane fade in active">

<?php
if (get_option('bitwordsUserId') != NULL) {
  include_once('tab_payouts_wallet_stats.php');
} else {
  include_once('tab_payouts_connect.php');
}
?>
</div>