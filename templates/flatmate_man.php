<table>
  <tr>
    <th><?php print t('Id'); ?></th>
    <th><?php print t('Name'); ?></th>
    <th><?php print t('Action'); ?></th>
  </tr>
<?php

function roomlist($select=null){
	global $data;
	if ($select==null){
		print '<select name="newflatmate[room]">'.PHP_EOL;
	} else {
		print '<select name="flatmate[room]">'.PHP_EOL;
	}
	if (isset($data['rooms'])){
		foreach ($data['rooms'] as $room){
      if ($select!=null && $room['id']==$select){
      	print '<option selected vaule="'.$room['id'].'">'.$room['name'].'</option>'.PHP_EOL;
      } else {
				print '<option value="'.$room['id'].'">'.$room['name'].'</option>'.PHP_EOL;
      }
		}
	}
	print '</select>'.PHP_EOL;	
}

if (isset($data)){
	if (isset($data['flatmates'])){
		foreach ($data['flatmates'] as $flatmate){
	?>
	<form action="." method="POST">
	<tr>
	  <td><input type="hidden" name="flatmate[id]" value="<?php print $flatmate['id'];?>"/><?php print $flatmate['id'];?></td>
	  <td><input type="text" name="flatmate[name]" value="<?php print $flatmate['name'];?>"/></td>
		<td><input type="submit"/></td>
	</tr>
	</form>
	<?php 
} // foreach
} // if
} // if
?>
	<form action="." method="POST">
	<tr>
	  <td></td>
	  <td><input type="text" name="newflatmate[name]"/></td>
		<td><input type="submit"/></td>
	</tr>
	</form>
</table>
<form action="." method="post">
<ul class="menu">
  <li><input type="submit" name="home" value="<?php print t('home');?>"/></li>
</ul>
</form>
