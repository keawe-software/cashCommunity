<table>
  <tr>
    <th><?php print t('Id'); ?></th>
    <th><?php print t('Start'); ?></th>
    <th><?php print t('End'); ?></th>
    <?php foreach ($base_dist as $mate_id => $percentage){ ?>
      <th><?php print $data['flatmates'][$mate_id]['name']; ?></th>
    <?php } ?>
    <th><?php print t('Action'); ?></th>
  </tr>
<?php

if (isset($data)){
	if (isset($data['flatmates'])){
    foreach ($data['distributions'] as $id => $distribution){ ?>
<form action="." method="POST">
  <tr>
    <td><input type="hidden" name="distribution[id]" value="<?php print $id; ?>"/><?php print $id; ?></td>
	  <td><input type="text" name="distribution[from]" value="<?php print $distribution['from'];?>"/></td>
	  <td><input type="text" name="distribution[till]" value="<?php print $distribution['till'];?>"/></td>
    <?php foreach ($distribution['rooms'] as $mate_id => $percentage){ ?>
      <td><input type="text" name="distribution[rooms][<?php print $mate_id; ?>]" value="<?php print $percentage; ?>"/></td>
    <?php } ?>
    <td><input type="submit" /></td>
	</tr>
  </form>
	<?php 
} // foreach
} // if
} // if
?>
<form action="." method="POST">
  <tr>
    <td><?php print t('new'); ?></td>
    <td><input type="text" name="newdistribution[from]" value="<?php print date('Y-m-d'); ?>"/></td>
    <td><input type="text" name="newdistribution[till]" value="<?php print date('Y-m-d'); ?>"/></td>
    <?php foreach ($base_dist as $id => $percentage) { ?>
      <td><input type="text" name="newdistribution[rooms][<?php print $id; ?>]" value="<?php print $percentage; ?>"/></td>
    <?php } ?>
    <td><input type="submit" /></td>
  </tr>
  </form>
</table>
<form action="." method="post">
<ul class="menu">
  <li><input type="submit" name="home" value="<?php print t('home');?>"/></li>
</ul>
</form>
