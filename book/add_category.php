<?php
include './DB.php';
include'./api_search.php';
?>
<html>
<head>
 <meta charset="utf-8">
 <script type="text/javascript" src="../book_js/jquery-1.2.6.js"></script>

 <!-- ui tabs.js -->
 <script type="text/javascript" src="../book_js/ui.core.js"></script>
 <script type="text/javascript" src="../book_js/ui.tabs.js"></script>
 <script type="text/javascript" src="./smoothscroll.js"></script> 
 <link href="../book_css/add_book.css" rel="stylesheet" type="text/css" />
 <link href="../book_css/detail.css" rel="stylesheet" type="text/css">  <!-- cssの指定 -->
 <link href="../book_css/allpage.css" rel="stylesheet" type="text/css">

 <script type="text/javascript">
 $(function() {
  $('#ui-tab > ul').tabs();
});
 </script>
</head>
<title>本の管理サイト</title>
<body>
  <?php include'./siteheader.php';?>
  <div class="sitebox">
    <div class = "header">
     <h1>カテゴリ</h1>
   </div>
   <div class="main">

   </div>
   <div id="ui-tab">
    <ul>  <!-- タブの表示文字 -->
      <li><a href="#fragment-1"><span>カテゴリの追加</span></a></li>
      <li><a href="#fragment-2"><span>カテゴリの削除</span></a></li>
    </ul>

    <!-- タブ１の内容 -->
    <!-- 情報入力欄はかけないようにする -->
    <div id="fragment-1">
     <?php
     $category = $_POST["new"];
     if(isset($_POST["new"])){
      $res = mysql_query("SELECT * FROM CATEGORY WHERE CATEGORY.NAME = '$category'");
      $value = mysql_fetch_assoc($res);
      if($value){
        echo '<script type="text/javascript">';
        echo 'alert( "データベースに同じ名前のカテゴリが存在します" )';
        echo '</script>' ;
      }else{
        $flag=mysql_query("INSERT INTO CATEGORY (NAME) VALUES ('$category')");
        if($flag){
          echo '<script type="text/javascript">';
          echo 'alert( "データベースに追加できました" )';
          echo '</script>' ;
        }else{
          echo '<script type="text/javascript">';
          echo 'alert( "データベースに追加できませんでした" )';
          echo '</script>' ;
        }
      }
    }
    echo'<p align="center">追加したいカテゴリ名を書いてください</p>';
    echo '<p align="center">カテゴリ一覧</p>';
    echo '<p align="center"><select name = "category">';
    $re2=mysql_query("SELECT DISTINCT NAME FROM CATEGORY");
    while($value2=mysql_fetch_assoc($re2)){

      echo '<option value = '.$value2[NAME].'>'.$value2[NAME];

    }
    echo '</select></p>';
    ?>
    <FORM METHOD="post" ACTION="add_category.php"> 
      <input type="text" name="new">
      <input type="submit" value="カテゴリの追加">
      <p align="center"><a href="./add_book.php">本の追加へ戻る</a></p>
    </form>
  </div>

  <!-- タブ２の内容 -->
  <div id="fragment-2">
   <?php
   $category = $_POST["del_category"];
   if(isset($_POST["del_category"])){
    $res = mysql_query("DELETE FROM CATEGORY WHERE CATEGORY.NAME = '$category'");
    $value = mysql_fetch_assoc($res);
    if($value){
      echo '<script type="text/javascript">';
      echo 'alert( "削除しました" )';
      echo '</script>' ;
    }else{
      echo '<script type="text/javascript">';
      echo 'alert( "削除できませんでした" )';
      echo '</script>' ;
    }

  }
  echo'<p align="center">追加したいカテゴリ名を書いてください</p>';
  echo '<p align="center">カテゴリ一覧</p>';
  echo '<p align="center"><select name = "del_category">';
  $re2=mysql_query("SELECT DISTINCT NAME FROM CATEGORY");
  while($value2=mysql_fetch_assoc($re2)){

    echo '<option value = '.$value2[NAME].'>'.$value2[NAME];

  }
  echo '</select></p>';
  ?>
  <FORM METHOD="post" ACTION="add_category.php"> 
    <input type="submit" value="カテゴリの削除">
    <p align="center"><a href="./add_book.php">本の追加へ戻る</a></p>
  </form>
</div>

</div>
<?php include'footer.php';?>
</div>

</body>
</html>