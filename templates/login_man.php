<form id="loginform" action="." method="POST">
  <input type="text" name="username" value="<?php print t('user name');?>"/>
  <input type="password" name="password"/>
  <button type="submit" name="action" value="login"><?php print t('log in'); ?></button>
<?php print t('Not registered, yet? Get a login!'); ?>
  <button type="submit" name="action" value="register"><?php print t('register now'); ?></button>
</form>
<div class="rbubble" style="width: 850px;">
<?php print t('cashCommunity is a web service allowing you to manage your living communitie\'s invoices and payments. All your data is password protected. We will neither use your data for any purpose other than helping you with calculations, nor will we forward yout data to any third parties.');?>
</div>
<div class="rbubble" style="width: 850px;">
<?php print t('This software is open source. However, it is not completely free:<br/>For a period of 14 days you can test its features freely. After that time, you will be no longer able to edit any data. To continue editing, you will have to <a href="license.php">purchase a license</a>.');?>
</div>
