<form id="loginform" action="." method="POST">
  <input type="text" name="username" value="<?php print t('user name');?>"/>
  <input type="password" name="password"/>
  <button type="submit" name="action" value="login"><?php print t('log in'); ?></button>
<?php print t('Not registered, yet? Get a login!'); ?>
  <button type="submit" name="action" value="register"><?php print t('register now'); ?></button>
</form>
