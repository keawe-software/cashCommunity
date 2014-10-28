    <?php if (!empty($warnings)){ ?>
    <ul class="warnings">
      <?php
        foreach ($warnings as $warning){
          print '<li>'.$warning.'</li>'.PHP_EOL;
        }
      ?>
    </ul>
    <?php } ?>
<pre>SESSION:
<?php 
print_r($_SESSION);
?>POST:
<?php 
print_r($_POST);
?>DATA:
<?php
print_r($data);
?></pre>
</body>
</html>
