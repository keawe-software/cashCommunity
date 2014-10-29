<table id="dist_man">
  <tr>
    <th><?php print t('Id'); ?></th>
  	<th><?php print t('Description'); ?></th>
    <?php if (isset($data['rooms'])) {
    	foreach ($data['rooms'] as $room) {?>
    <th><?php print $room['name']; ?></th>
    <?php } 
    } // if ?>
    <th><?php print t('Actions'); ?></th>
  </tr>
  
  <?php
  if (isset($data['distributions'])) {
  	$even=false; 
  	foreach ($data['distributions'] as $distribution) {
  	  $even=!$even;
  		?>

  	<form action="." method="POST">
  	<?php if ($even) { ?>
  	<tr class="even">
		<?php } else { ?>
  	<tr class="odd">
  	<?php } ?> 
    <td><?php print $distribution['id']; ?><input type="hidden" name="distribution[id]" value="<?php print $distribution['id']; ?>"/></td>
  	<td><input type="text" name="distribution[name]" value="<?php print $distribution['name']; ?>"/></td>
    <?php foreach ($data['rooms'] as $room_id => $room) {?>
    <td><input type="text" name="distribution[rooms][<?php print $room_id; ?>]" value="<?php
    if (isset($distribution['rooms'][$room_id])){ 
    	print $distribution['rooms'][$room_id];
		} else {
  		print '0.0';
		}?>"/></td>
    <?php } ?>
    <td><button type="submit" name="action" value="edit distribution"><?php print t('save'); ?></button></td>
  </tr>  
  </form>
  <?php } // foreach
  } // if
  ?>
  <form action="." method="POST">
  <tr class="new overbubble">
    <td>-</td>
  	<td><input type="text" name="distribution[name]" value="<?php print t('basic distribution by area');?>"/></td>
    <?php if (isset($data['rooms'])) {
    	foreach ($data['rooms'] as $room_id => $room) { ?>
    <td><input type="text" name="distribution[rooms][<?php print $room_id; ?>]" value="<?php print $base_dist['rooms'][$room_id]; ?>"/></td>
    <?php } 
    } // if ?>
    <td><button type="submit" name="action" value="add distribution"><?php print t('save new'); ?></button></td>
  </tr>  
  </form>
  
  <tr>
    <td></td>
  	<td class="bubble"><?php print t('Enter a description in the green area to start creating a new distribution.');?></td>
  	<?php if (isset($data['rooms']) && count($data['rooms'])>0) { ?>
    <td colspan="<?php print count($data['rooms']); ?>" class="bubble"><?php print t('Assign a ratio or fraction of the flat size to each room. By entering "0", a invoice using this distribution will not be assigned to the inhabitants of this room. Fractions of uninhabitated rooms will be shared evenly across all flatmates. The values preset reflect the distribution by room size.'); ?></td>
    <?php } // if?>
    <td></td>
  </tr>
  
  
</table>