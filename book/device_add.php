<?php
include './DB.php';
include './api_search.php'; //関数呼び出しより手前に記述する



	//確認画面からとんできたときにurlにaleの値が入っている
	//aleに値が入っていたらメッセージを出す
	if($_GET['ale'] == 1) {		//本の追加
		//scriptでメーセージを出す
		echo '<script type="text/javascript">' ;
		echo 'alert( "登録しました!" )' ;
		echo '</script>' ;
	}else if($_GET['ale'] == 2){	//本の冊数追加
		echo '<script type="text/javascript">' ;
		echo 'alert( "同じISBNの本の情報があったので冊数を追加しました!" )' ;
		echo '</script>' ;
	}

	//前のページ(自分自身)の入力データを変数に持っておきvalueの初期値にする
	$device_nameText = @$_POST["device_name"];			//name
	$device_numberText = @$_POST["device_number"];	//追加数
	$assetText = @$_POST["asset"]; //asset
	$manufactureText = @$_POST["manufacture"]; //製造
	$serialText = @$_POST["serial"]; //シリアルナンバー
	$os_versionText = @$_POST["os_version"]; //osversion
	$cpuText = @$_POST["cpu"]; //cpu
	$memoryText = @$_POST["memory"]; //メモリ
	$strageText = @$_POST["stage"]; //ストレージ
	$wifiText = @$_POST["wifi"]; //wifi
	$vm_wareText = @$_POST["vm_ware"]; //vmware
	$vm_lisenceText = @$_POST["vm_lisence"]; //vmライセンス
	$ms_officeText = @$_POST["ms_office"]; //オフィスバージョン
	$noteText = @$_POST["note"]; //備考
	?>

	<html>
	<head>
		<meta charset="utf-8">  <!-- 文字コードの設定 -->
		<title>本の管理サイト</title>

		<!-- jQuery -->
		<script type="text/javascript" src="../book_js/jquery-1.2.6.js"></script>

		<!-- ui tabs.js -->
		<script type="text/javascript" src="./smoothscroll.js"></script> 
		<link href="../book_css/add_book.css" rel="stylesheet" type="text/css" />
		<link href="../book_css/allpage.css" rel="stylesheet" type="text/css" />


		<script>
		//ボタンごとに送信先をかえる
		//ボタンををしたら(どれでも)formの設定をする
		function send(){
      var frm=document.form1;				//formのname
      frm.action="./device_add.php";	//自分のページにとぶようにする	
      frm.method="post";						//postで送る
      return true;									//trueでボタンが実行される
  }


    //登録ボタンが押されたらformの設定をする
    function registration(){
    	var frm=document.form1;										//formのname
    	//テキストボックス内に空欄がないか確認
    	flag = 0; //空欄があるときはフラグをたてる
    	for(i = 0; i < 6; i++){
    		//２番目と３番目のボタンのelementsはとばすようにする
    		j = 0;
    		if(i > 0) j = 2;
    		if(frm.elements[i+j].value == ""){
    			//空の場所の字のいろをかえる
    			flag = 1;
    			document.getElementById("tab1_text" + i).style.color = "red";
    			document.getElementById("tab1_text" + i).style.backgroundColor = "yellow";
    		}else{
    			//色を戻す
    			document.getElementById("tab1_text" + i).style.color = "";
    			document.getElementById("tab1_text" + i).style.backgroundColor = "";
    		}
    	}

    	//フラグがたっているときは空白がある
    	if(flag){ 
    		alert( "空欄があります!" );
    	}else{
    		//ISBNが半角数字だけで書かれているか
    		if(frm.isbn.value.match(/[^0-9]+/)){
    			//テキストの色を変える
    			document.getElementById('tab1_text0').style.color = "red";
    			document.getElementById('tab1_text0').style.backgroundColor = "yellow";
    			alert( "ISBNコードは半角数字のみです!" );
    		}else{	//書かれているとき
					//確認を呼びかける
					//alert( "入力を確認してください!" );
		    	frm.method="post";												//postで送る
		    	frm.action="./device_add_confirmation.php";	//確認ページにとぶ
		    	frm.submit();															//ボタンをsubmitにして送るようにする
					//テキストの色を戻す
					document.getElementById('tab1_text1').style.color = "";
					document.getElementById('tab1_text1').style.backgroundColor = "";
				}
			}
		}



    //リセットボタン(タブ１)
    function clearText(){
    	//リセットしていいか確認を出す
    	flag = confirm("リセットしますか?");
    	if(flag){
				//確認で「ok」がが押されたら格テキストのvalueを空にする
				var frm=document.form1;										//formのname
				frm.isbn.value = "";
				frm.link.value = "";
				frm.device_name.value = "";
				frm.authot_name.value = "";
				frm.publisher.value = "";
				frm.device_number.value = "";
				frm.imageUrl.value = "";
				frm.category.value="";

				frm.method="post";												//postで送る
	    	frm.action="./add_device.php";	//自分
	    	frm.submit();															//ボタンをsubmitにして送るようにする
	    }
	}


	</script>
</head>
<body>
	<?php include'./siteheader.php';?>
	<!-- タイトル -->
	<div class ="sitebox">
		<div class = "header">
			<h1>デバイスの追加</h1>
		</div>

		<!-- タブの設定 -->
		<div class="main">
			<div id="fragment-1">
				<!-- 本の情報を入力する欄 -->
				<!--ボタン(どれでも)が押されたらsend()(script)が動く 基本自分のページにとぶように設定している-->
				<FORM NAME="form1"　METHOD="post" ACTION="device_add.php" onsubmit="return send(this)"> 
					<?php
					//欄
					echo '<p><span id="tab2_text1">●カテゴリ</span><a href="device_add_category.php">(追加)</a></p>';   
					echo '<p><select name = "category">';
					$re2=mysql_query("SELECT DISTINCT NAME FROM DEVICE_CATEGORY");
					while($value2=mysql_fetch_assoc($re2)){

						echo '<option value = '.$value2[NAME].'>'.$value2[NAME];

					}
   					echo '</select></p>';   //<!-- タイトル用(book_nameにはいる) -->
   					echo '<p><span id="tab2_text2">●著者名</span></p>';
		  			echo '<input type="text" name="authot_name" value="'.$authot_nameText.'" required> '; //<!-- 著者用(author_nameにはいる) -->
		  			
		  			echo '<p><span id="tab2_text2">●asset</span></p>';
		  			echo '<input type="text" name="authot_name" value="'.$authot_nameText.'" required> ';
		  			echo '<p><span id="tab2_text2">●manufacture</span></p>';
		  			echo '<input type="text" name="authot_name" value="'.$authot_nameText.'" required> ';
		  			echo '<p><span id="tab2_text2">●serial_number</span></p>';
		  			echo '<input type="text" name="authot_name" value="'.$authot_nameText.'" required> ';
		  			echo '<p><span id="tab2_text2">●os_version</span></p>';
		  			echo '<input type="text" name="authot_name" value="'.$authot_nameText.'" required> ';
		  			echo '<p><span id="tab2_text2">●cpu</span></p>';
		  			echo '<input type="text" name="authot_name" value="'.$authot_nameText.'" required> ';
		  			echo '<p><span id="tab2_text2">●メモリ</span></p>';
		  			echo '<input type="text" name="authot_name" value="'.$authot_nameText.'" required> ';
		  			echo '<p><span id="tab2_text2">●ストレージ</span></p>';
		  			echo '<input type="text" name="authot_name" value="'.$authot_nameText.'" required> ';
		  			echo '<p><span id="tab2_text2">●wifi</span></p>';
		  			echo '<input type="text" name="authot_name" value="'.$authot_nameText.'" required> ';
		  			echo '<p><span id="tab2_text2">●vm_ware</span></p>';
		  			echo '<input type="text" name="authot_name" value="'.$authot_nameText.'" required> ';
		  			echo '<p><span id="tab2_text2">●vm_lisence</span></p>';
		  			echo '<input type="text" name="authot_name" value="'.$authot_nameText.'" required> ';
		  			echo '<p><span id="tab2_text2">●office_version</span></p>';
		  			echo '<input type="text" name="authot_name" value="'.$authot_nameText.'" required> ';
		  			echo '<p><span id="tab2_text2">●備考</span></p>';
		  			echo '<input type="text" name="authot_name" value="'.$authot_nameText.'" required> ';

					echo '<p><span id="tab2_text5">●追加数</span></p>';
					echo '<select name = "book_number">';
					echo '<option value = '.$book_numberText.'>'.$book_numberText.'';
					echo '<option value = 1>1';
					echo '<option value = 2>2';
					echo '<option value = 3>3';
					echo '<option value = 4>4';
					echo '<option value = 5>5';
					echo '</select>';

					echo '<p><span id="tab1_text6">●購入費</span></p>';
					echo '<select name = "book_purchase">';
					//echo '<option value = '.$book_numberText.'>'.$book_numberText.'';
					echo '<option value = 0>未指定';
					echo '<option value = 1>実験実習費';
					echo '<option value = 2>個人研究費';
					echo '<option value = 3>研学研究費';
					echo '<option value = 4>情報研研究費';
					echo '<option value = 5>谷私費';
					echo '<option value = 6>卒業生寄付';
					echo '</select>';
					// echo '<input type="text" name="device_number" value="'.$device_numberText.'">';  //<!-- 冊数(device_numberにはいる) -->	
					?>
					<br><br>
					<input type="button" value="リセット" name = "textClear" onClick = "clearText()">		<!-- クリアボタン(name = "textClear") -->
					<!--登録ボタン(name="up")押されたらsend2()が実行されformのactionを確認ページにしtypeをsubmitにする-->
					<input type="button" value="確認画面へ" name = "up" onClick = "registration()"> 
				</form>
			</div>

			<!-- タブ２の内容 -->
			
		</div>
		<?php include'footer.php'; ?>
	</div>
</body>
</html>