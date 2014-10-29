    <?php if (!empty($warnings)){ ?>
    <ul class="warnings">
      <?php
        foreach ($warnings as $warning){
          print '<li>'.$warning.'</li>'.PHP_EOL;
        }
      ?>
    </ul>
    <?php } 
  print str_replace('%days',$_SESSION['validity'],t('Your current license expires in %days days.'));
?>
    <br/>
    <div class="footline"><a href="https://github.com/SRSoftware/cashCommunity"><?php print t('This software is open source. Find the code at GitHub.')?></a> Version 1.0</div>
</body>
</html>
