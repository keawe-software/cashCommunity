<form id="registerform" action="." method="POST">
  <?php print t('user name');?>:<input type="text" name="newuser[nick]" value="<?php print $_POST['username']; ?>"/><br/>
  <?php print t('password');?>:<input type="password" name="newuser[password]"/><br/>
  <?php print t('repeat password');?>:<input type="password" name="newuser[password2]"/><br/>
  <button type="submit" name="action" value="register"><?php print t('register now'); ?></button>
</form>
<div class="rbubble"><?php print t('Please be responsible and use a very secure password. This password is everything that keeps intruders away from your and your flatmates\' data.'); ?></div>