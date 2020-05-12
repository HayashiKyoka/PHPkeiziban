<!DOCTYPE html>
<html> 
    <head>
        <meta charset="utf-8">
        <title>detele</title>
    </head>
    <body>
        <form method="POST" action="nextwriting.php">
    	    名前：<input type="text" name="name"><br>
    	    コメント：<input type="text" name="comment">
    	    <input type="submit" value="送信"><br><br>
        </form>
        <form method="POST" action="delete.php">
        	削除対象番号：<input type="text" name="delete"><br>
    	    <input type="submit" value="削除"><br>
        </form>
        <?php
            $filename = 'board.txt'; //ファイル名
            if(file_exists($filename)) {//ファイルが存在している
	            if (!empty($_POST['delete'])){//削除番号が空でない
                    $delete = $_POST['delete']; //削除対象番号
                    if($delete === ""){
                        print "削除対象番号が入力されていません。";
                    }else{//削除番号に入力されたOK
                        $lines=file($filename);//ファイルを配列として格納
                        $fp= fopen($filename, 'w');//ファイルを開く
                        $postedAt = date('Y-m-d H:i:s');
				        foreach($lines as $line){//配列の分だけ繰り返し処理　linesは全 体、lineは１行
				            $new_line=explode("<>",$line);//$line(1行)を<>で分割
                            if($delete==$new_line[0]){//削除番号とファイルの中の投稿番号が同じ
                            fwrite($fp, "$new_line[0]" . '<><>' . "コメントは削除されました。" . '<>' . "$postedAt" . "\n");
					        }else{//削除番号とファイルの中の投稿番号が違う
					        fwrite($fp, $line);
				    	    }
                        }fclose($fp);
		            }
                }
                $fp= fopen($filename, 'r'); //ファイルを読み込みモードで開く
                $lines=file($filename);//ファイルを配列として格納
	            foreach($lines as $line){//配列の分だけ繰り返し処理　linesは全体、lineは１行
    	            $new_line=explode("<>",$line);//$line(1行)を<>で分割
	                echo "$new_line[0]" . ' 名前：' . "$new_line[1]" . ' コメント：' . "$new_line[2]" . ' ' . "$new_line[3]". "<br>" ;//表示
	            }
                fclose($fp);
            }else{//ファイルが存在していない
                echo "ファイルが存在していません。";
            }
        ?>
    </body>
</html>