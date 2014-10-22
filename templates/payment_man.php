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