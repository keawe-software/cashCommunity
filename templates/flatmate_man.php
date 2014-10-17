<table>
  <tr>
    <th><?php print t('Id'); ?></th>
    <th><?php print t('Name'); ?></th>
    <th><?php print t('From'); ?></th>
    <th><?php print t('Till'); ?></th>
    <th><?php print t('Room'); ?></th>
    <th><?php print t('Action'); ?></th>
  </tr>
<?php

foreach ($flatmates as $flatmate){
	?>
	<form action="." method="POST">
	<tr>
	  <td><input type="hidden" name="flatmate[id]" value="<?php print $flatmate['id'];?>"/><?php print $flatmate['id'];?></td>
	  <td><input type="text" name="flatmate[name]" value="<?php print $flatmate['name'];?>"/></td>
		<td><input type="text" name="flatmate[start]" value="<?php print $flatmate['start'];?>"/></td>
	  <td><input type="text" name="flatmate[end]" value="<?php print $flatmate['end'];?>"/></td>
		<td><input type="text" name="flatmate[room]" value="<?php print $flatmate['room'];?>"/></td>
		<td><input type="submit"/></td>
	</tr>
	</form>
	<?php 
}
?>
	<form action="." method="POST">
	<tr>
	  <td></td>
	  <td><input type="text" name="newflatmate[name]"/></td>
		<td><input type="text" name="newflatmate[start]"/></td>
	  <td><input type="text" name="newflatmate[end]" /></td>
		<td><input type="text" name="newflatmate[room" /></td>
		<td><input type="submit"/></td>
	</tr>
	</form>

</table>