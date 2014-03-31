<?php
include './DB.php';
include'./api_search.php';

//カテゴリ削除
if(isset($_POST["DEL"])){
  $sql = "DELETE FROM CATEGORY WHERE CATEGORY.BOOK_ID = $_POST[DEL] AND CATEGORY.NAME = '$_POST[DEL_CATE]' ";
  mysql_query( $sql );
  echo '<script type="text/javascript">';
  echo 'alert( "カテゴリを消去しました" )';
  echo '</script>' ;
}
//cate追加
if(isset($_POST["category"])){
  $category = $_POST["category"];
  $isbn = $_GET["isbn"];
  $res = mysql_query("SELECT * FROM CATEGORY LEFT JOIN BOOK ON CATEGORY.BOOK_ID = BOOK.ID WHERE BOOK.ISBN = ".$isbn);
  $value=mysql_fetch_assoc($res);
  $bookId = $value[ID];
  $num = mysql_query("SELECT COUNT( DISTINCT BOOK_ID ) FROM CATEGORY");
  $res2 = mysql_query("SELECT * FROM CATEGORY WHERE BOOK_ID = ".$bookId." AND CATEGORY.NAME = '$category'");
  $value2= mysql_fetch_assoc($res2);
  if($value2 or $num > 5){
    echo '<script type="text/javascript">';
    echo 'alert( "この本には既に同じ名前のカテゴリが存在するか、カテゴリが上限数を超えてしまうため追加できません" )';
    echo '</script>' ;
  }else{
    $flag=mysql_query("INSERT INTO CATEGORY (NAME , BOOK_ID) VALUES ('$category' , '$bookId')");
    if($flag){
      echo '<script type="text/javascript">';
      echo 'alert( "カテゴリを追加できました" )';
      echo '</script>' ;
    }else{
      echo '<script type="text/javascript">';
      echo 'alert( "カテゴリ追加できませんでした" )';
      echo '</script>' ;
    }
  }
}
?>
<html>
<head>
 <meta charset="utf-8">
 <link href="../book_css/detail.css" rel="stylesheet" type="text/css">  <!-- cssの指定 -->
 <link href="../book_css/allpage.css" rel="stylesheet" type="text/css">
</head>
<body>
  <?php include'./siteheader.php';?>
  <div class="sitebox">
    <div class = "header">
     <h1>詳細</h1>
   </div>
   <div class="main">
    <?php
    $re=mysql_query("SELECT * FROM BOOK WHERE BOOK.ISBN = ".$_GET["isbn"]);
    $value=mysql_fetch_assoc($re);
    $items = array();
    $reTest = apiSearch($value[ISBN], $items);
    $imageUrlText = $items[1]['largeImageUrl'];
    $cont = $items[1]['itemCaption'];
    $num = $value[BOOK_NUMBER] - $value[RENT_NUM];
          //div book_area
    echo'<div class=book_area>';
    echo '<div class="item_img">';
    echo '<IMG SRC="'.$imageUrlText.'" style="height:200px;width:170px;">';
    echo '<form method="post" action="./confirm.php">';
    echo '<input type="hidden" name="book" value="'.$value[ID].'">';
    echo '<input type="submit" value="借りる">';
    echo '</form>';
    echo '</div>';
    echo '<div class="item_cont">';
    echo '<div class="item_title">';
    echo '<a href="'.$value[LINK].'">'.$value[BOOK_NAME].'</a>';
    echo '</div>';
    echo '<div class="item_info">';
    echo '<div class="category">';
    echo '<h5>登録カテゴリ<a href="./add_category.php">(追加)</a></h5>';
    echo '<ul class="cate">';
    $re2=mysql_query("SELECT * FROM CATEGORY WHERE CATEGORY.BOOK_ID = ".$value[ID]);
    while($value2=mysql_fetch_assoc($re2)){
      echo '<li class="cate">●<a href="./cate_bookshelf.php?word='.$value2[NAME].'">'.$value2[NAME].'</a>';
      echo '<form method="post" style="display: inline"　action="'.$_SERVER['PHP_SELF'].'?isbn='.$_GET["isbn"].'">';
      echo "<input type='hidden' name='DEL' value = '$value[ID]'>";
      echo "<input type='hidden' name='DEL_CATE' value = '$value2[NAME]'>";
      echo "<input type='submit' value='削除'>";
      echo "</form></li>";
      $cate_name = $value2[NAME];

    }
    echo '</ul>';
    echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'?isbn='.$_GET["isbn"].'">';
    echo '<select name = "category">';
    echo '<option value = '.$category.'>'.$category.'';
    $re2=mysql_query("SELECT DISTINCT NAME FROM CATEGORY ");
    while($value2=mysql_fetch_assoc($re2)){

      echo '<option value = '.$value2[NAME].'>'.$value2[NAME];

    }
    echo '</select>';
    echo '<input type="submit" value="追加">'; 
    echo '</div>';
    echo '<ul class="info_list">';
    echo '<li class="author">著者：'.$value[AUTHOR_NAME].'</li>';
    echo '<li class="publisher">出版社：'.$value[PUBLISHER].'</li>';
    echo '</ul>';
    echo '</div>';
    echo '<div class="item_data">';
    echo '<ul class="data_list">';
    echo '<li class="book_num">在庫：'.$num.'</li>';
    echo '<li class ="book_count">貸出総回数：'.$value[BOOK_COUNTER].'</li>';
    echo '</ul>';
    echo '<p>購入費：'.$value[BOOK_PURCHASE].'</p>';
    echo '</div>';
    echo '<div class="item_ex">';
    echo '内容説明';
    echo '<p>'.$cont.'</p>';
    echo '</div>';
    echo '</div>';
    echo'</div>';
          //div category_area
    echo'<div class="category_area">';
    echo '<h2>同じカテゴリの人気本</h2>';
    echo '<ul calss="item_list"style="margin-top: 0px;padding-left: 0px;margin-bottom: 0px;">';
    $re3=mysql_query("SELECT * FROM CATEGORY WHERE CATEGORY.BOOK_ID IS NOT NULL AND CATEGORY.NAME = '$cate_name' LIMIT 5");
    while($value3 = mysql_fetch_assoc($re3)){
      $re4=mysql_query("SELECT * FROM BOOK WHERE BOOK.ID = ".$value3[BOOK_ID]);
      $value4 = mysql_fetch_assoc($re4);
      $items = array();
      $reTest = apiSearch($value4[ISBN], $items);
      $imageUrlText = $items[1]['mediumImageUrl'];
      echo'<li class="item">';
      echo '<div class="non_check">';
      echo '<div class="item_img">';
      echo '<IMG SRC="'.$imageUrlText.'" style="height:150px;width:130px;">';
      echo '</div>';
      echo '<div class="item_cont">';
      echo '<div class="item_title">';
      echo '<a href="./detail.php?isbn='.$value4[ISBN].'">'.$value4[BOOK_NAME].'</a>';
      echo '</div>';
      echo '<div class="item_info">';
      echo '<ul class="info_list">';
      echo '<li class="author">著者：'.$value4[AUTHOR_NAME].'</li>';
      echo '<li class="publisher">出版社：'.$value4[PUBLISHER].'</li>';
      echo '</ul>';
      echo '</div>';
      echo '<div class="item_data">';
      echo '<ul class="data_list">';
      echo '<li class="book_num">在庫：'.$num.'</li>';
      echo '<li class ="book_count">貸出総回数：'.$value4[BOOK_COUNTER].'</li>';
      echo '</ul>';
      
      echo '</div>';
      echo '</div>';
      echo '</li>';
    }
    echo'</div>';
    echo '</ul>';

    ?>
  </div>
  <?php include'footer.php';?>
</div>

</body>
</html>