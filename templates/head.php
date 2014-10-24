<html>
  <head>
  	<meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="templates/style.css">
    <?php
      if (isset($_POST['flatmate']) && isset($_POST['flatmate']['name'])){ ?>
      <title><?php print $_POST['flatmate']['name']; ?></title><?php
			} else {?>
			<title><?php print t('cashCommunity - Community management by SRSoftware');?></title><?php
    ?>
  </head>
  <body>
    <h1><?php print t('cashCommunity - Community management by SRSoftware');?></h1>
  
