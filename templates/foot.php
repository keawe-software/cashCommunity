    <?php if (!empty($warnings)){ ?>
    <ul class="warnings">
      <?php
        foreach ($warnings as $warning){
          print '<li>'.$warning.'</li>'.PHP_EOL;
        }
      ?>
    </ul>
    <?php } ?>
    <br/>
    <div class="footline"><a href="https://github.com/SRSoftware/cashCommunity"><?php print t('This software is open source. Find the code at GitHub.')?></a></div>
</body>
</html>
