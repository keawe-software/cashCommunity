<?php
print str_replace('%flatmate',$_POST['flatmate']['name'],t('showing the balances of %flatmate.'));
?>
<table>
  <tr>
    <th><?php print t('ID');?></th>
    <th><?php print t('Description');?></th>
    <th><?php print t('Value');?></th>
    <th><?php print t('Allotment');?></th>
		<th><?php print t('Proportional value');?></th>
	</tr>
	
	<?php
	$sum=0; 
	foreach ($balance as $invoice_id => $invoice){
	  $value=ceil($invoice['part']*$invoice['value']*100)/100;
	  $sum+=$value;
	  ?>
		<tr>
			<td><?php print $invoice_id;?></td>
		  <td><?php print $invoice['description'];?></td>
		  <td><?php print $invoice['value'];?></td>
		  <td><?php print $invoice['part'];?></td>
			<td><?php print $value; ?></td>
		</tr>
	<?php			
	}	
	?>
	<tr>
    <th>-</th>
    <th><?php print t('Sum of all positions');?></th>
    <th>-</th>
    <th>-</th>
		<th><?php print $sum;?></th>
	</tr>
	
</table>