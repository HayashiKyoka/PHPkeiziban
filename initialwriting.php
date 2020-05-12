<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>initialwriting</title>
	</head>
	<body>
    		<form method="POST" action="nextwriting.php">
    			名前：<input type="text" name="name"><br>
    			コメント：<input type="text" name="comment"><br>
   	 			<input type="submit" value="送信">
    		</form>
			<form method="POST" action="delete.php">
        		削除対象番号：<input type="text" name="delete"><br>
    	    	<input type="submit" value="削除"><br>
        	</form>
	    <?php
            $filename = 'board.txt'; //ファイル名
			if(file_exists($filename)) {//ファイルが存在している
				$lines=file($filename);//ファイルを配列として格納
					foreach($lines as $line){//配列の分だけ繰り返し処理　linesは全体、lineは１行
						$new_line=explode("<>",$line);//$line(1行)を<>で分割
						echo $new_line[0] . ' 名前：' . $new_line[1] . ' コメント：' . $new_line[2]. ' ' .  $new_line[3]."<br>";//表示
					}
					fclose($fp); 
			}else{//ファイルが存在していない
			}
		?>
	</body>
</html>

