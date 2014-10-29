<form action="." method="post">

<table class="overview">  
  <tr>
		<td><button type="submit" name="action" value="manage rooms"><?php print t('manage rooms'); ?></button></td>  	
  	<td><button type="submit" name="action" value="manage flatmates"><?php print t('manage flatmates'); ?></button></td>
  	<td><button type="submit" name="action" value="manage distributions"><?php print t('manage distributions'); ?></button></td>
		<td><button type="submit" name="action" value="manage invoices"><?php print t('manage invoices'); ?></button></td>
	</tr>
	<?php if (!isset($_POST['action'])) {?>
	<tr>
	  <td class="bubble"><?php print t('Here, you should maintain a list of the rooms of your flat. Each room gan be given a name and a size.'); ?></td>
	  <td class="bubble"><?php print t('Here, you should maintain the list your flat mates. Each flatmate will have his/her own list of payments and a balance sheet.'); ?></td>
	  <td class="bubble"><?php print t('This allows you to create various distributions for bills invoiced. Each distribution defines how a certain invoice is shared by your flat mates.'); ?></td>
	  <td class="bubble"><?php print t('Manage a list of the invoices related to your living community.'); ?></td>
	</tr>
	<?php } // if ?>
</table>
</form>