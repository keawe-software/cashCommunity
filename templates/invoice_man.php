<?php 
  function distributionSelector($dist_id=null){
  	global $data;
  	if (!isset($data['distributions'])){
  		return;
  	}
  	?>
  	<select name="invoice[distribution]">
  	<?php
  	
		foreach ($data['distributions'] as $distribution){
			if ($dist_id==$distribution['id']){
				print '<option selected value="'.$distribution['id'].'">'.$distribution['name'].'</option>'.PHP_EOL;
			} else {
				print '<option value="'.$distribution['id'].'">'.$distribution['name'].'</option>'.PHP_EOL;
			}
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
  
  <?php 
  	if (isset($data['invoices'])){
      foreach ($data['invoices'] as $invoice){?>
  <form action="." method="POST">
  <tr>
    <td><input type="hidden" name="invoice[id]" value="<?php print $invoice['id']; ?>"/><?php print $invoice['id']; ?></td>
    <td><input type="text" name="invoice[description]" value="<?php print $invoice['description']; ?>"/></td>
    <td><input type="text" name="invoice[value]" value="<?php print $invoice['value']; ?>"/></td>
    <td><input type="text" name="invoice[from]" value="<?php print $invoice['from']; ?>"/></td>
    <td><input type="text" name="invoice[till]" value="<?php print $invoice['till']; ?>"/></td>
    <td><?php distributionSelector($invoice['distribution']); ?></td>
    <td><button type="submit" name="action" value="edit invoice"><?php print t('save');?></button></td>
  </tr>
  </form>
			<?php } // foreach
		} // if
  ?>
  
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