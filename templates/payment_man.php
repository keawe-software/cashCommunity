<?php
print str_replace('%name', $_POST['flatmate']['name'], t('Showing the payments of %name.'));
?>
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
    foreach ($data['payments'][$mate_id] as $id => $payment){
    	?>
    	
  <form action="." method="POST">
  <input type="hidden" name="flatmate" value="<?php print $mate_id; ?>"/>
  <input type="hidden" name="payment[id]" value="<?php print $id; ?>"/>
    <tr>
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
  <form action="." method="POST">
  <input type="hidden" name="flatmate" value="<?php print $_POST['flatmate']['id']; ?>"/>
  <tr>
    <td>-</td>
    <td><input type="text" name="payment[description]" value="<?php print t('Description');?>"/></td>
    <td><input type="text" name="payment[date]" value="<?php print date('Y-m-d');?>"/></td>
    <td><input type="text" name="payment[value]" value="0.00"/></td>
    <td><button type="submit" name="action" value="add payment"><?php print t('save new');?></buton></td>
  </tr>
  </form>
</table>