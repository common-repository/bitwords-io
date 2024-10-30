<div class="wrap">
  <h1>Terms &amp; Conditions</h1>
  <p>
    To use Bitwords, we require you to agree to our terms &amp; conditions. Please read through
    the terms and conditions given below and click on 'I agree' once done. If you can't read
    the document below, you can open it by clicking <a href="https://s3.amazonaws.com/bitwords/legal/terms-conditions.pdf" target="_blank">here.</a>
  </p>
  <form method="post" action="<?php echo esc_html(admin_url('admin-post.php')); ?>" id="licenseform">
    <iframe width="100%" height="400px" src="https://s3.amazonaws.com/bitwords/legal/terms-conditions.pdf"></iframe>

    <p> I agree that I've read the above Terms &amp; Conditions.</p>
    <input type="hidden" name="bitwords_action" value="agree_license" />
    <input type="submit" name="submit" id="submit" class="button button-primary" value="I Agree"></input>
  </form>
</div>