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
	<form action="." method="POST">
	<tr>
	  <td><input type="hidden" name="allotment[id]" value="<?php print $room['id'];?>"/><?php print $flatmate['id'];?></td>
	  <td><?php print $room['name'];?></td>
		<td><input type="text" name="allotment[percentage]" value="<?php print $base_dist[$room['id']];?>"/>%</td>
	</tr>
	</form>
	<?php 
} // foreach
} // if
} // if
?>
</table>
<form action="." method="post">
<ul class="menu">
  <li><input type="submit" name="home" value="<?php print t('home');?>"/></li>
</ul>
</form>
