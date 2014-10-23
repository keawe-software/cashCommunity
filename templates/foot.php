    <?php if (!empty($warnings)){ ?>
    <ul class="warnings">
      <?php
        foreach ($warnings as $warning){
          print '<li>'.$warning.'</li>'.PHP_EOL;
        }
      ?>
    </ul>
    <?php } ?>
<pre>POST:
<?php 
print_r($_POST);
?>DATA:
<?php
print_r($data);
?></pre>
</body>
</html>
