<?php 
  function distributionSelector($dist_id=null){
  	global $data;
  	if (!isset($data['distributions'])){
  		print '<button type="submit" name="action" value="manage distributions">'.t('please add a distribution first!').'</button>';
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
<h2><?php print t('Invoice manager');?></h2>
<table>
  <tr>
    <th><?php print t('Id'); ?></th>
    <th><?php print t('Description'); ?></th>
    <th><?php print t('From'); ?></th>
    <th><?php print t('Till'); ?></th>
    <th><?php print t('Distribution'); ?></th>
    <th><?php print t('Value'); ?></th>
    <th><?php print t('Actions'); ?></th>
  </tr>


  <?php
  	$from=date('Y-m-d');
  	$till=$from;  
  	if (isset($data['invoices'])){
  		$invoices=array_reverse($data['invoices'],true);
  		if (!empty($invoices)){
				$invoice=reset($invoices);
				$from=daysToDate($invoice['from']);
				$till=daysToDate($invoice['till']);
			}
    }				
  		?>
    <form action="." method="POST">
  		<tr class="new">
    		<td>-</td>
    		<td><input type="text" name="invoice[description]" value="<?php print t('Description'); ?>"/></td>
    		<td><input type="text" name="invoice[from]" value="<?php print $from; ?>"/></td>
    		<td><input type="text" name="invoice[till]" value="<?php print $till; ?>"/></td>
    		<td><?php distributionSelector(); ?></td>
    		<td><input type="text" name="invoice[value]" value="0.00"/></td>
    		<td><button type="submit" name="action" value="add invoice"><?php print t('save new');?></button></td>
  		</tr>
  	</form>
  
  <?php 
  	if (isset($data['invoices'])){
			$even=false;			
  		foreach ($invoices as $invoice){
      $even=!$even;
      ?>      
  <form action="." method="POST">
  	<?php if ($even) { ?>
  	<tr class="even">
		<?php } else { ?>
  	<tr class="odd">
  	<?php } ?> 
    <td><input type="hidden" name="invoice[id]" value="<?php print $invoice['id']; ?>"/><?php print $invoice['id']; ?></td>
    <td><input type="text" name="invoice[description]" value="<?php print $invoice['description']; ?>"/></td>
    <td><input type="text" name="invoice[from]" value="<?php print daysToDate($invoice['from']); ?>"/></td>
    <td><input type="text" name="invoice[till]" value="<?php print daysToDate($invoice['till']); ?>"/></td>
    <td><?php distributionSelector($invoice['distribution']); ?></td>
    <td><input type="text" name="invoice[value]" value="<?php print $invoice['value']; ?>"/></td>
    <td><button type="submit" name="action" value="edit invoice"><?php print t('save');?></button></td>
  </tr>
  </form>
			<?php } // foreach
		} // if
  ?>
  <tr class="overbubble">
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>    
  </tr>  
  <tr>
    <td></td>
    <td class="bubble"><?php print t('To add a new invoice, start by entering a description in the green field above.'); ?></td>
    <td class="bubble"><?php print t('Enter the first day of the timespan the invoice is for here. Use the format yyyy-mm or yyyy-mm-dd.'); ?></td>
    <td class="bubble"><?php print t('Enter the last day of the timespan the invoice is for here. If you leave the start date blank, it will be adjusted to span the whole month.'); ?></td>
    <td class="bubble"><?php print t('Choose whilch distribution shall be used to assign the invoice to your flat mates.'); ?></td>
    <td class="bubble"><?php print t('Each invoice needs to have a numeric value. This can be positive or negative, but must not be zero!'); ?></td>
    <td></td>
  </tr>  
</table>