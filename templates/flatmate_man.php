<table>
  <tr>
    <th><?php print t('Id'); ?></th>
    <th><?php print t('Name'); ?></th>
    <th><?php print t('Action'); ?></th>
  </tr>
<?php

if (isset($data)){
	if (isset($data['flatmates'])){
		foreach ($data['flatmates'] as $flatmate){
	?>
	<form action="." method="POST">
	<tr>
	  <td><input type="hidden" name="flatmate[id]" value="<?php print $flatmate['id'];?>"/><?php print $flatmate['id'];?></td>
	  <td><input type="text" name="flatmate[name]" value="<?php print $flatmate['name'];?>"/></td>
		<td><button name="action" value="edit flatmate" type="submit"><?php print t('save')?></button></td>
	</tr>
	</form>
	<?php 
} // foreach
} // if
} // if
?>
	<form action="." method="POST">
	<tr>
	  <td></td>
	  <td><input type="text" name="flatmate[name]"/></td>
		<td><button type="submit" name="action" value="new flatmate"><?php print t('save new');?></button></td>
	</tr>
	</form>
</table>