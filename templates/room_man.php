<table>
  <tr>
    <th><?php print t('Id'); ?></th>
    <th><?php print t('Name'); ?></th>
    <th><?php print t('Size'); ?></th>
    <th><?php print t('Action'); ?></th>
  </tr>
<?php

foreach ($data['rooms'] as $room){
	?>
	<form action="." method="POST">
	<tr>
	  <td><input type="hidden" name="room[id]" value="<?php print $room['id'];?>"/><?php print $room['id'];?></td>
	  <td><input type="text" name="room[name]" value="<?php print $room['name'];?>"/></td>
		<td><input type="text" name="room[size]" value="<?php print $room['size'];?>"/></td>
		<td><input type="submit"/></td>
	</tr>
	</form>
	<?php 
}
?>
	<form action="." method="POST">
	<tr>
	  <td></td>
	  <td><input type="text" name="newroom[name]"/></td>
		<td><input type="text" name="newroom[size]"/></td>
		<td><input type="submit"/></td>
	</tr>
	</form>

</table>
