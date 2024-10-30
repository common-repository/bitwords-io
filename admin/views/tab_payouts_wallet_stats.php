<p>
  All ad revenue will be deposited into your ETH wallet every week: <b><?php echo $dataForPublisher->walletAddress; ?></b>
</p>

<div><b>Total clicks: </b> <?php echo $dataForPublisher->totalClicks; ?></div>
<div><b>Total impressions: </b> <?php echo $dataForPublisher->totalImpressions; ?></div>
<div><b>Average CTR: </b> <?php echo ($dataForPublisher->totalClicks / ($dataForPublisher->totalImpressions + 1)); ?>%</div>
<div><b>Revenue Generated: </b> <?php echo $dataForPublisher->totalRevenue; ?> E</div>

<br />

<form method="post" action="<?php echo esc_html(admin_url('admin-post.php')); ?>" id="settings">
  <div class="bitwords-input-group">
    <b>Wallet Deposit Address</b><br />
    <span>The ETH address where you'd like to receive ad revenue</span><br />
    <input
      name="bitwordsEthWithdrawAddess" class="text" type="text" placeholder="ETH Wallet address"
      value="<?php echo $dataForPublisher->walletAddress; ?>"/>
  </div>

  <input type="hidden" name="bitwords_action" value="save_payout" />
  <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Payout">
</form>