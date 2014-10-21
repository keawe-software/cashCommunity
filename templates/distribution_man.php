<table id="dist_man">
  <tr>
    <th><?php print t('Id'); ?></th>
  	<th><?php print t('Name'); ?></th>
    <?php foreach ($data['rooms'] as $room) {?>
    <th><?php print $room['name']; ?></th>
    <?php } ?>
    <th><?php print t('Action'); ?></th>
  </tr>
  
  <?php
  if (isset($data['distributions'])) { 
  	foreach ($data['distributions'] as $distribution) { ?>
  	<form action="." method="POST">
  <tr>
    <td><?php print $distribution['id']; ?><input type="hidden" name="distribution[id]" value="<?php print $distribution['id']; ?>"/></td>
  	<td><input type="text" name="distribution[name]" value="<?php print $distribution['name']; ?>"/></td>
    <?php foreach ($data['rooms'] as $room_id => $room) {?>
    <td><input type="text" name="distribution[rooms][<?php print $room_id; ?>]" value="<?php
    if (isset($distribution['rooms'][$room_id])){ 
    	print $distribution['rooms'][$room_id];
		} else {
  		print '0.0';
		}?>"/>%</td>
    <?php } ?>
    <td><button type="submit" name="action" value="edit distribution"><?php print t('save'); ?></button></td>
  </tr>  
  </form>
  <?php } // foreach
  } // if
  ?>
  <form action="." method="POST">
  <tr>
    <td>-</td>
  	<td><input type="text" name="distribution[name]" value="Name"/></td>
    <?php foreach ($data['rooms'] as $room_id => $room) {?>
    <td><input type="text" name="distribution[rooms][<?php print $room_id; ?>]" value="<?php print $base_dist['rooms'][$room_id]; ?>"/></td>
    <?php } ?>
    <td><button type="submit" name="action" value="add distribution"><?php print t('save new'); ?></button></td>
  </tr>  
  </form>
</table>