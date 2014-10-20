<?php print str_replace('%name',$_POST['flatmate']['name'],t('editing the assiciations of %name'))?>
<table>
  <tr>
    <th><?php print t('Id'); ?></th>
    <th><?php print t('Name'); ?></th>
    <th><?php print t('Action'); ?></th>
  </tr>
<?php

if (isset($data)){
	if (isset($data['flatmates'])){
		foreach ($data['flatmates'] as $flatmate){
	?>
	<form action="." method="POST">
	<tr>
	  <td><input type="hidden" name="flatmate[id]" value="<?php print $flatmate['id'];?>"/><?php print $flatmate['id'];?></td>
	  <td><input type="text" name="flatmate[name]" value="<?php print $flatmate['name'];?>"/></td>
		<td><button name="edit" value="flatmate" type="submit"><?php print t('submit')?></button>
		    <button name="edit" value="association" type="submit"><?php print t('room association...')?></button></td>
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

<pre>
<?php print_r($data);?></pre>