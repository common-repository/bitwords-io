<!-- <div id="menu2" class="tab-pane fade in">
	<p>
    All ad revenue will be deposited into your ETH wallet: <b><?php echo get_option('bitwordsEthWithdrawAddess'); ?></b>
  </p>

  <form method="post" action="<?php echo esc_html(admin_url('admin-post.php')); ?>" id="settings">
    <div class="bitwords-input-group">
      <b>Wallet Deposit Address</b><br />
      <span>The ETH address where you'd like to receive ad revenue</span><br />
      <input
        name="bitwordsEthWithdrawAddess" class="text" type="text" placeholder="ETH Wallet address"
        value="<?php echo get_option('bitwordsEthWithdrawAddess'); ?>"/>
    </div>

    <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Payout">
  </form>
</div> -->

<style>
  #menu2 .bitwords-input-group {
    border-bottom: 1px solid #DDD;
    padding-bottom: 10px;
    margin-bottom: 15px
  }


  #menu2 input.text {
    max-width: 300px;
    margin: 5px 0 10px;
    padding: 7px;
    width: 100%;
  }
</style>


<p>
  To manage your payouts, your site needs to be connected with a Bitwords account. Fill in the details
  below and click on the button so that we can create your account and automatically connect it
  with your site.
</p>

<form method="post" action="https://app.bitwords.io/api/v1/publishers/wordpress/verifyEmail" id="settings" target="_blank">
  <div class="bitwords-input-group">
    <span>1. Enter the email you'd like to use with Bitwords</span><br />
    <input
      name="email" class="text" type="text" placeholder="Bitwords Login Email"
      value="<?php echo get_option('admin_email'); ?>"/>

    <input name="publisherId" type="hidden" value="<?php echo get_option('bitwordsPublisherId'); ?>"/>

    <br />
    <input type="submit" name="submit" id="submit" class="button button-primary" value="Get Verification token from Bitwords">
  </div>
</form>

<form method="post" action="<?php echo esc_html(admin_url('admin-post.php')); ?>#menu2" id="settings">
  <div class="bitwords-input-group">
    <!-- <b>Bitwords Account email</b><br /> -->
    <span>2. We'll be sending you a verification token via email. Enter that token  here to finish connecting with your site.</span><br />
    <input name="verificationToken" class="text" type="text" required placeholder="Verification Token" />
    <input name="publisherId" type="hidden" value="<?php echo get_option('bitwordsPublisherId'); ?>"/>

    <br />

    <input type="hidden" name="bitwords_action" value="verify_token" />
    <input type="submit" name="submit" id="submit" class="button" value="Connect with Bitwords">
  </div>
</form>