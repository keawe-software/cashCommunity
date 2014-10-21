<?php
  $room_id=$_POST['room']['id'];
	$room=$data['rooms'][$room_id];
	
	print str_replace('%name',$room['name'],t('editing the assiciations of %name'));
	
  function flatmateSelector($mate=null){ 
    global $data; ?>
  	<select name="association[flatmate]">
  	<?php
  	  foreach ($data['flatmates'] as $flatmate){
			  if ($mate==$flatmate['id']){
					print '<option selected value="'.$flatmate['id'].'">'.$flatmate['name'].'</option>'.PHP_EOL;
				} else {
					print '<option value="'.$flatmate['id'].'">'.$flatmate['name'].'</option>'.PHP_EOL;
				}
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

  <?php 
  if (isset($room['associations'])){
    foreach ($room['associations'] as $from => $assoc) {?>

  <form action="." method="POST">
  <tr>
    <td><input type="hidden" name="association[room]" value="<?php print $room['id']; ?>"/>
        <input type="text" name="association[from]" value="<?php print $from; ?>"/></td>
    <td><input type="text" name="association[till]" value="<?php print $assoc['till']; ?>"/></td>
    <td><?php flatmateSelector($assoc['flatmate']); ?></td>
    <td><button type="submit" name="action" value="edit association"><?php print t('save');?></button>
  </tr>
  </form>  
  
  
  <?php } // foreach 
  } // if
  ?>
  <form action="." method="POST">
  <tr>
    <td><input type="hidden" name="association[room]" value="<?php print $room['id']; ?>"/>
        <input type="text" name="association[from]" value="<?php print date('Y-m-d'); ?>"/></td>
    <td><input type="text" name="association[till]" value="<?php print date('Y-m-d'); ?>"/></td>
    <td><?php flatmateSelector(); ?></td>
    <td><button type="submit" name="action" value="add association"><?php print t('save new');?></button>
  </tr>
  </form>  
</table>
<pre><?php print_r($data);?></pre>