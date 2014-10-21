<?php
  print str_replace('%name',$_POST['room']['name'],t('editing the assiciations of %name'));

  function flatmateSelector(){ 
    global $data; ?>
  	<select name="association[flatmate]">
  	<?php
  	  foreach ($data['flatmates'] as $flatmate){
				print '<option value="'.$flatmate['id'].'">'.$flatmate['name'].'</option>'.PHP_EOL;
			} 
  	?>
  	</select>
<?php }
?>
<table>
  <tr>
    <th><?php print t('From'); ?></th>
    <th><?php print t('Till'); ?></th>
    <th><?php print t('Flatmate'); ?></th>
    <th><?php print t('Action'); ?></th>
  </tr>

  <form action="." method="POST">
  <tr>
    <td><input type="hidden" name="association[room]" value="<?php print $_POST['room']['id']; ?>"/>
        <input type="text" name="association[from]" value="<?php print date('Y-m-d'); ?>"/></td>
    <td><input type="text" name="association[till]" value="<?php print date('Y-m-d'); ?>"/></td>
    <td><?php flatmateSelector(); ?></td>
    <td><button type="submit" name="action" value="new association"><?php print t('save');?></button>
  </tr>
  </form>  
</table>
<pre><?php print_r($data);?></pre>