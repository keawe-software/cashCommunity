<?php 
  function distributionSelector(){
  	global $data;
  	if (!isset($data['distributions'])){
  		return;
  	}
  	?>
  	<select name="invoice[distribution]">
  	<?php
  	
		foreach ($data['distributions'] as $distribution){
			print '<option value="'.$distribution['id'].'">'.$distribution['name'].'</option>'.PHP_EOL;
		}
  	
  	?>
  	</select>
  	<?php  	
  }
?>
<table>
  <tr>
    <th><?php print t('Id'); ?></th>
    <th><?php print t('Description'); ?></th>
    <th><?php print t('Value'); ?></th>
    <th><?php print t('From'); ?></th>
    <th><?php print t('Till'); ?></th>
    <th><?php print t('Distribution'); ?></th>
    <th><?php print t('Action'); ?></th>
  </tr>
  
  <form action="." method="POST">
  <tr>
    <td>-</td>
    <td><input type="text" name="invoice[description]" value="<?php print t('Description'); ?>"/></td>
    <td><input type="text" name="invoice[value]" value="0.00"/></td>
    <td><input type="text" name="invoice[from]" value="<?php print date('Y-m-d'); ?>"/></td>
    <td><input type="text" name="invoice[till]" value="<?php print date('Y-m-d'); ?>"/></td>
    <td><?php distributionSelector(); ?></td>
    <td><button type="submit" name="action" value="add invoice"><?php print t('save new');?></button></td>
  </tr>
  </form>
</table>