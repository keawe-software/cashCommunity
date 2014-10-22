<h2><?php print t('Room manager');?></h2>
<table>
  <tr>
    <th><?php print t('Id'); ?></th>
    <th><?php print t('Name'); ?></th>
    <th><?php print t('Size (m²)'); ?></th>
    <th><?php print t('Actions'); ?></th>
  </tr>
<?php
if (isset($data) && isset($data['rooms'])){
	$even=false;
foreach ($data['rooms'] as $room){
	$even=!$even;
	?>
	<form action="." method="POST">
	<?php if ($even){ ?>
		<tr class="even">
	<?php } else { ?>
	  <tr class="odd">
	<?php } ?>
	  <td><input type="hidden" name="room[id]" value="<?php print $room['id'];?>"/><?php print $room['id'];?></td>
	  <td><input type="text" name="room[name]" value="<?php print $room['name'];?>"/></td>
		<td><input type="text" name="room[size]" value="<?php print $room['size'];?>"/></td>
		<td><button name="action" value="edit room" type="submit"><?php print t('save');?></button>
		    <button name="action" value="manage associations" type="submit"><?php print t('room association...')?></button></td>
	</tr>
	</form>
	<?php 
} //foreach
} // if
?>
	<form action="." method="POST">
	<tr class="new">
	  <td></td>
	  <td><input type="text" name="room[name]"/></td>
		<td><input type="text" name="room[size]"/></td>
		<td><button type="submit" name="action" value="add room"><?php print t('save new');?></button></td>
	</tr>
	</form>
  <tr class="collation">
    <td>-</td>
    <td><?php print t('overall flat size'); ?></td>
    <td><?php print $flat_size; ?></td>
    <td></td>
  </tr>
</table>