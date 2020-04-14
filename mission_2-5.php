<html> 
<head>
    <meta charset="utf-8">
    <title>mission_2-5</title>
</head>
	<body>
		<form method="POST" action="mission_2-5.php"><!--編集したい投稿の取り出し-->
<?php
$hensyu = $_POST['hensyu'];//編集対象番号
$filename = 'mission_2-5.txt';//ファイル名
if(!empty($hensyu))://編集する値が入力された
	$lines=file($filename);//ファイルを配列として格納
	$fp1= fopen($filename, 'r');//ファイルを開く
		foreach($lines as $line){//配列の分だけ繰り返し処理　linesは全体、lineは１行
		$new_line=explode("<>",$line);//$line(1行)を<>で分割
 			if($hensyu==$new_line[0])://編集番号とファイルの中の投稿番号が同じ
				if($pass2==$new_line[4]):
?>
	名前：<input type="text" name="name" value="<?php echo $new_line[1] ?>"><br>
	コメント：<input type="text" name="comment" value="<?php echo $new_line[2] ?>">
	<input type="hidden" name="kakusu" value="<?php echo $new_line[0] ?>"><br>
<?php
				else:
				echo "パスワードが違います。". "<br>" ;
				endif;
			else:
			endif;
		}
	fclose($fp1);
?>
	<input type="submit" value="送信"><br><br>
	削除対象番号：<input type="text" name="sakuzyo" value="削除対象番号"><br>
パスワード：<input type="text" name="pass1" value="パスワード">
	<input type="submit" value="削除"><br><br>
	編集対象番号：<input type="text" name="hensyu" value="編集対象番号"><br>
パスワード：<input type="text" name="pass2" value="パスワード">
	<input type="submit" value="編集"><br><br>
<?php
else:
?>
    名前：<input type="text" name="name" value="名前"><br>
    コメント：<input type="text" name="comment" value="コメント"><br>
    パスワード：<input type="text" name="pass3" value="パスワード">
   <input type="submit" value="送信"><br><br>
    削除対象番号：<input type="text" name="sakuzyo" value="削除対象番号"><br>
パスワード：<input type="text" name="pass1" value="パスワード">
    <input type="submit" value="削除"><br><br>
	編集対象番号：<input type="text" name="hensyu" value="編集対象番号"><br>
パスワード：<input type="text" name="pass2" value="パスワード">
   <input type="submit" value="編集"><br><br>
		</form>
<?php
endif;
//以下定義
$name     = $_POST['name']; //名前
$comment  = $_POST['comment']; //コメント
$postedAt = date('Y-m-d H:i:s'); //投稿日時
$sakuzyo = $_POST['sakuzyo']; //削除対象番号
$kakusu=$_POST['kakusu'];
$pass3=$_POST['pass3'];
$pass1=$_POST['pass1'];
$pass2=$_POST['pass2'];
if(file_exists($filename)) {//ファイルが存在している
	if (empty($name) && empty($comment)) {//名前とコメントが空白
	}else{//名前とコメントがある
		if(isset($kakusu)){//編集モード
		$lines=file($filename);//ファイルを配列として格納
		$fp2= fopen($filename, 'w');
 			foreach($lines as $line){//配列の分だけ繰り返し処理　linesは全体、lineは１行
			$new_line=explode("<>",$line);//$line(1行)を<>で分割
				if($kakusu==$new_line[0]){//隠れている番号とファイルの中の投稿番号が同じ
				$kaeru = "$new_line[0]" . '<>' . "$name" . '<>' . "$comment" . '<>' . "$postedAt" . '<>' . "$new_line[4]" . '<>' . "\n"; 
				fwrite($fp2, $kaeru);
				}else{//編集番号とファイルの中の投稿番号が違う
				fwrite($fp2, $line);
				}
			}
		fclose($fp2);
		}else{//新規モード
		$count = count(file($filename)) + 1; //ファイルの行数をカウント
		$tokou = "$count" . '<>' . "$name" . '<>' . "$comment" . '<>' . "$postedAt" . '<>' . "$pass3" . '<>' . "\n";
		$fp3= fopen($filename, 'a'); //ファイルに追記
		fwrite($fp3, "$tokou");
		fclose($fp3);
		}
	}
	if (empty($sakuzyo)){//削除番号に入力されない
	}else{//削除番号に入力された
	$lines=file($filename);//ファイルを配列として格納
	$fp5= fopen($filename, 'w');//ファイルを開く
		foreach($lines as $line){//配列の分だけ繰り返し処理　linesは全体、lineは１行
		$new_line=explode("<>",$line);//$line(1行)を<>で分割
 			if($sakuzyo==$new_line[0]){//削除番号とファイルの中の投稿番号が同じ
				if($pass1==$new_line[4]){
				}else{
				echo "パスワードが違います。". "<br>" ;
				fwrite($fp5, $line);
				}
			}else{//削除番号とファイルの中の投稿番号が違う
			fwrite($fp5, $line);
			}
		}
	fclose($fp5);
	}
$lines=file($filename);//ファイルを配列として格納
$fp6= fopen($filename, 'r'); //ファイルを読み込みモードで開く
	foreach($lines as $line){//配列の分だけ繰り返し処理　linesは全体、lineは１行
	$new_line=explode("<>",$line);//$line(1行)を<>で分割
	echo "$new_line[0]" . ' ' . "$new_line[1]" . ' ' . "$new_line[2]" . ' ' . "$new_line[3]". "<br>" ;//表示
	}
fclose($fp6);
}else{//ファイルが存在していない
	if (empty($name) && empty($comment)) {//名前とコメントが空白
	}else{//名前とコメントが空白ではない
	$tokou1 = '1<>' . "$name" . '<>' . "$comment" . '<>' . "$postedAt" .'<>'. "$pass3" . '<>'. "\n"; //投稿
    	$fp4= fopen($filename, 'a'); //ファイルに書き込み　追記
   	fwrite($fp4, "$tokou1");
	fclose($fp4);
	echo  '1 ' . "$name" . ' ' . "$comment" . ' ' . "$postedAt". "\n"; 
	}
}
?>
	</body>
</html>
