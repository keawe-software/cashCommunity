<div class="management">
<h2><?php print t('Flatmate manager');?></h2>
<table>
  <tr>
    <th><?php print t('Id'); ?></th>
    <th><?php print t('Name'); ?></th>
    <th><?php print t('Action'); ?></th>
  </tr>
<?php

if (isset($data)){
	if (isset($data['flatmates'])){
		$even=false;
		foreach ($data['flatmates'] as $flatmate){
			$even=!$even;
	?>
	<form action="." method="POST">
  <?php if ($even) { ?>
  <tr class="even">
	<?php } else { ?>
  <tr class="odd">
  <?php } ?> 
	  <td><input type="hidden" name="flatmate[id]" value="<?php print $flatmate['id'];?>"/><?php print $flatmate['id'];?></td>
	  <td><input type="text" name="flatmate[name]" value="<?php print $flatmate['name'];?>"/></td>
		<td><button name="action" value="edit flatmate" type="submit"><?php print t('save')?></button>
				<button name="action" value="show payments" type="submit"><?php print t('payments')?></button>
				<button name="action" value="show balance" type="submit"><?php print t('balance')?></button></td>
	</tr>
	</form>
	<?php 
} // foreach
} // if
} // if
?>
	<form action="." method="POST">
	<tr class="new">
	  <td>-</td>
	  <td><input type="text" name="flatmate[name]"/></td>
		<td><button type="submit" name="action" value="add flatmate"><?php print t('save new');?></button></td>
	</tr>
	</form>
</table>
</div>