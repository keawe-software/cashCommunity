    <?php if (!empty($warnings)){ ?>
    <ul class="warnings">
      <?php
        foreach ($warnings as $warning){
          print '<li>'.$warning.'</li>'.PHP_EOL;
        }
      ?>
    </ul>
    <?php } 
    if (isset($_SESSION['validity'])){
  		print str_replace('%days',$_SESSION['validity'],t('Your current <a href="license.php">license</a> expires in %days days.'));
  	}
?>
    <br/>
    <div class="footline"><a href="https://github.com/keawe-software/cashCommunity"><?php print t('This software is open source. Find the code at GitHub.')?></a> 
    Version 1.3</div>
</body>
</html>
