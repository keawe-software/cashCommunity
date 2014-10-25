<div class="management">
<h2><?php print t('Room association manager');?></h2>
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
    <th><?php print t('Id'); ?></th>
  	<th><?php print t('From'); ?></th>
    <th><?php print t('Till'); ?></th>
    <th><?php print t('Flatmate'); ?></th>
    <th><?php print t('Actions'); ?></th>
  </tr>

  <?php
  $assoc=array('till'=>0); // initialize in case $room[associations] is empty
  if (isset($data['associations'])){
  	$even=false;
    foreach ($data['associations'] as $assoc) {
      if ($assoc['room'] != $room_id){
      	continue;
      }
    	$even=!$even;
      ?>
  <form action="." method="POST">
  <input type="hidden" name="association[id]" value="<?php print $assoc['id']; ?>"/>
  <input type="hidden" name="association[room]" value="<?php print $assoc['room']; ?>"/>
  <?php if ($even) { ?>
  <tr class="even">
	<?php } else { ?>
  <tr class="odd">
  <?php } ?>    
    <td><?php print $assoc['id']; ?></td>
	  <td><input type="text" name="association[from]" value="<?php print daysToDate($assoc['from']); ?>"/></td>
    <td><input type="text" name="association[till]" value="<?php print daysToDate($assoc['till']); ?>"/></td>
    <td><?php flatmateSelector($assoc['flatmate']); ?></td>
    <td><button type="submit" name="action" value="edit association"><?php print t('save');?></button>
  </tr>
  </form>  
  
  
  <?php } // foreach 
  }// if 
  ?>
  <form action="." method="POST">
  <input type="hidden" name="association[room]" value="<?php print $room['id']; ?>"/>
  <tr class="new">
    <td>-</td>
    <td><input type="text" name="association[from]" value="<?php print daysToDate(1+$assoc['till']); ?>"/></td>
    <td><input type="text" name="association[till]"/></td>
    <td><?php flatmateSelector(); ?></td>
    <td><button type="submit" name="action" value="add association"><?php print t('save new');?></button>
  </tr>
  </form>  
</table>
</div>