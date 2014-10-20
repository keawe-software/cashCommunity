<form action="." method="POST">
<input name="newdistribution[from]" value="<?php print date('Y-m-d'); ?>"/>
<input name="newdistribution[till]" value="<?php print date('Y-m-d'); ?>"/>
<table>
  <tr>
    <th><?php print t('Id'); ?></th>
    <th><?php print t('Name'); ?></th>
    <th><?php print t('Allotment'); ?></th>
  </tr>
<?php

if (isset($data)){
	if (isset($data['flatmates'])){
		foreach ($data['flatmates'] as $flatmate){
      $room=$data['rooms'][$flatmate['room']];
	?>
	<tr>
	  <td><?php print $room['id'];?></td>
	  <td><?php print $room['name'];?></td>
		<td><input type="text" name="newdistribution[rooms][<?php print $room['id']; ?>]" value="<?php print $base_dist[$room['id']];?>"/>%</td>
	</tr>
	<?php 
} // foreach
} // if
} // if
?>
</table>
<input type="submit" />
</form>
<form action="." method="post">
<ul class="menu">
  <li><input type="submit" name="home" value="<?php print t('home');?>"/></li>
</ul>
</form>
