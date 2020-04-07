<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>チャット</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>チャット</h1>
   
    チャット履歴
    <section>
    <?php // DBからデータを取得　
    $stmt = select(); foreach($stmt -> fetchAll(PDO::FETCH_ASSOC) as $message) {

   
    echo $message['time'],":  ",$message['name'],":",$message['message'];
    echo nl2br("\n");
    }
    // 投稿内容を登録
    if(isset($_POST["send"])){
        insert();
        // 投稿した内容を表示
        $stmt = select_new();
        foreach($stmt -> fetchAll(PDO::FETCH_ASSOC) as $message){
            echo $message['time'],":  ",$message['name'],":",$message["message"];
            echo nl2br("\n");
        }
    }

    // DB接続
    function connectDB(){
        $dbh = new PDO('mysql:host=localhost;dbname=test;charset=utf8;','root','');
        return $dbh;
    }

    // DBから投稿内容を取得
    function select(){
        $dbh = connectDB();
        $sql = "SELECT * FROM message ORDER BY time";
        $stmt = $dbh -> prepare($sql);
        $stmt -> execute();
        return $stmt;
    }
    // DBから投稿内容を取得(最新の1件)
    function select_new(){
        $dbh = connectDB();
        $sql = "SELECT * FROm message ORDER BY time desc limit 1";
        $stmt = $dbh -> prepare($sql);
        $stmt -> execute();
        return $stmt;
    }

    // DBから投稿内容を登録
    function insert(){
        $dbh = connectDB();
        $sql = "INSERT INTO message(name,message,time) VALUES(:name,:message,now())";
        $stmt = $dbh -> prepare($sql);
        $params = array(':name'=>$_POST['name'],':message'=>$_POST['message']);
        $stmt -> execute($params);
    }
    ?>
    </section>

    <form method="post" action="chat.php">
    名前<input tytpe="text" name="name">
    <br>
    メッセージ<input tytpe="text" name="message">
    <br>
    
    
    </form>
    <form method="post" action="chat.php" enctype="multipart/form-data">
    ファイルの添付：<input type="file" name="file">
    <br>
    </form>
    <button name="send" type="submit">送信</button>
    <br>
    <?php
    if(isset($_FILES)&& isset($_FILES['upfile']) && is_uploaded_file($_FILES['upfile']['tmp_name'])){
        if(!file_exists('upload')){
            mkdir('upload');
        }
        $a = 'upload/' . basename($_FILES['upfile']['name']);
        if(move_uploaded_file($_FILES['updile']['tmp_name'],$a)){
            $msg = $a.'のアップロードに成功しました。';
        } else{
            $msg = 'アップロードに失敗しました。';
        }
    }
    ?>

</body>
</html>