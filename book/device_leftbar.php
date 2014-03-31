<div class="leftbar">
  <div class="sort">
    <h3>sort</h3>
    <ul>
      <li><a href="<?php echo $_SERVER['PHP_SELF']."?word=".$_GET["word"]."&sort=ORDER BY NAME asc" ?>">NAME asc</a></li>
      <li><a href="<?php echo $_SERVER['PHP_SELF']."?word=".$_GET["word"]."&sort=ORDER BY NAME desc" ?>">NAME desc</a></li>
      <li><a href="<?php echo $_SERVER['PHP_SELF']."?word=".$_GET["word"]."&sort=ORDER BY MEMORY asc" ?>">MEMORY asc</a></li>
      <li><a href="<?php echo $_SERVER['PHP_SELF']."?word=".$_GET["word"]."&sort=ORDER BY MEMORY desc" ?>">MEMORY desc</a></li>
      <li><a href="<?php echo $_SERVER['PHP_SELF']."?word=".$_GET["word"]."&sort=ORDER BY OS_VERSION asc" ?>">OS_VERSION asc</a></li>
      <li><a href="<?php echo $_SERVER['PHP_SELF']."?word=".$_GET["word"]."&sort=ORDER BY OS_VERSION desc" ?>">OS desc</a></li>
    </ul>
  </div>
  <div class="category">
    <h3>カテゴリ</h3>
    <ul class="category">
      <?php
      $re2=mysql_query("SELECT DISTINCT NAME FROM DEVICE_CATEGORY ORDER BY NAME ");
      while($value2=mysql_fetch_assoc($re2)){

        echo '<li><a href="./device.php?word='.$value2[NAME].'">'.$value2[NAME].'</a></li>';

      }
      ?>
    </ul>
  </div>
</div>