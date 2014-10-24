<h2><?php print t('Payment manager')?></h2>
<?php
$mate_id=$_POST['flatmate']['id'];
$mate_name=$_POST['flatmate']['name'];
print str_replace('%name', $mate_name, t('Showing the payments of %name.'));
?>
<form action="." method="POST">
  <input type="hidden" name="flatmate[id]" value="<?php print $mate_id; ?>" />
  <input type="hidden" name="flatmate[name]" value="<?php print $mate_name; ?>" />
  <button type="submit" name="action" value="show balance"><?php print t('show balance');?></button>  
</form> 
<table>
  <tr>
    <th><?php print t('Id');?></th>
    <th><?php print t('Description');?></th>
    <th><?php print t('Date');?></th>
    <th><?php print t('Value');?></th>
    <th><?php print t('Actions');?></th>
  </tr>
  <?php
    $mate_id=$_POST['flatmate']['id'];
    $even=false;
    $payment=array();
    $payment['date']=date('Y-m-d');
    $payments=array_reverse($data['payments'][$mate_id],true);
    if (!empty($payments)){
			$payment=reset($payments);
		}
    ?>
    
  <form action="." method="POST">
  	<input type="hidden" name="flatmate[id]" value="<?php print $_POST['flatmate']['id']; ?>"/>
   	<input type="hidden" name="flatmate[name]" value="<?php print $_POST['flatmate']['name']; ?>"/>
   		<tr class="new">
    		<td>-</td>
    		<td><input type="text" name="payment[description]" value="<?php print t('Description');?>"/></td>
    		<td><input type="text" name="payment[date]" value="<?php print $payment['date'];?>"/></td>
    		<td><input type="text" name="payment[value]" value="0.00"/></td>
    		<td><button type="submit" name="action" value="add payment"><?php print t('save new');?></buton></td>
  		</tr>
  	</form>
    
    <?php
    foreach ($payments as $id => $payment){
    	$even=!$even;
    	?>
    	
  <form action="." method="POST">
  <input type="hidden" name="flatmate" value="<?php print $mate_id; ?>"/>
  <input type="hidden" name="payment[id]" value="<?php print $id; ?>"/>
  <?php if ($even) { ?>
  <tr class="even">
	<?php } else { ?>
  <tr class="odd">
  <?php } ?> 
    <td><?php print $id; ?></td>
    <td><input type="text" name="payment[description]" value="<?php print $payment['description']; ?>"/></td>
    <td><input type="text" name="payment[date]" value="<?php print $payment['date']; ?>"/></td>
    <td><input type="text" name="payment[value]" value="<?php print $payment['value'];?>"/></td>
    <td><button type="submit" name="action" value="edit payment"><?php print t('save');?></buton></td>
  </tr>
  </form>
    	
    	
    	<?php
    }
  ?>

</table>