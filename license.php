<?php
include 'init.php';
include 'templates/head.php';
print t('The license to use this software costs 10€ for 365 days. That is less than 1€ per month.');

  if (isset($_SESSION['user'])){ 
        print ' '.t('To apply for a license, type your mail address and press the button below!'); ?><br/>
	<form action="." method="POST">
		<?php print t('Your email address:'); ?> <input type="text" name="mail" /> (<?php print t('Will not be stored'); ?>)<br/>
		<button type="submit" name="action" value="send account mail"><?php print t('mail me the account data!'); ?></button>
	</form>
<?php
  } else {
		print ' '.t('To get a license, you first have to <a href=".">register and log in</a>.');
  }

include 'templates/foot.php'; 
?>
