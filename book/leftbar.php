<div class="leftbar">
  <div class="sort">
    <h3>sort</h3>
    <ul>
      <li><a href="<?php echo $_SERVER['PHP_SELF']."?word=".$_GET["word"]."&sort=ORDER BY BOOK_NAME asc" ?>">名前 asc</a></li>
      <li><a href="<?php echo $_SERVER['PHP_SELF']."?word=".$_GET["word"]."&sort=ORDER BY BOOK_NAME desc" ?>">名前 desc</a></li>
      <li><a href="<?php echo $_SERVER['PHP_SELF']."?word=".$_GET["word"]."&sort=ORDER BY PUBLISHER asc" ?>">出版社 asc</a></li>
      <li><a href="<?php echo $_SERVER['PHP_SELF']."?word=".$_GET["word"]."&sort=ORDER BY PUBLISHER desc" ?>">出版社 desc</a></li>
      <li><a href="<?php echo $_SERVER['PHP_SELF']."?word=".$_GET["word"]."&sort=ORDER BY AUTHOR_NAME asc" ?>">著者 asc</a></li>
      <li><a href="<?php echo $_SERVER['PHP_SELF']."?word=".$_GET["word"]."&sort=ORDER BY AUTHOR_NAME desc" ?>">著者 desc</a></li>
      <li><a href="<?php echo $_SERVER['PHP_SELF']."?word=".$_GET["word"]."&sort=ORDER BY BOOK_COUNTER asc" ?>">貸出総回数 asc</a></li>
      <li><a href="<?php echo $_SERVER['PHP_SELF']."?word=".$_GET["word"]."&sort=ORDER BY BOOK_COUNTER desc" ?>">貸出総回数 desc</a></li>
    </ul>
  </div>
  <div class="category">
    <h3>カテゴリ</h3>
    <ul class="category">
      <?php
      $re2=mysql_query("SELECT DISTINCT NAME FROM CATEGORY ORDER BY NAME ");
      while($value2=mysql_fetch_assoc($re2)){

        echo '<li><a href="./cate_bookshelf.php?word='.$value2[NAME].'">'.$value2[NAME].'</a></li>';

      }
      ?>
    </ul>
  </div>
</div>