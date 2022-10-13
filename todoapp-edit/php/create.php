<?php
require('db_connect.php');

$title = $_POST['title'];
$content = $_POST['content'];
$submit = $_POST['submit'];
// $id = $_GET['id'];

if(!empty($submit)){
    $db = db_connect();
    try{
        $sql = 'insert into posts(title, content) values(:title, :content) ';
        $stmt = $db->prepare($sql);
        $stmt->bindparam(':title', $title);
        $stmt->bindparam(':content', $content);
        $stmt->execute();
        // $url = 'main.php?=' . $id;
        // header('Location:' . $url);
        header('Location:main.php');
    }catch(PDOException $e){
        echo 'エラー：'. $e->getMessage();
        die();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>新規登録画面</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="title-area">
            <h1>リストの追加</h1>
            <a href="main.php" style="color:white;">メイン画面へ戻る</a>
    </div>
    <form action="" method="POST">
        <input type="text" class="input-area" placeholder="タイトル" name="title" required><br>
        <input type="text" class="input-area" placeholder="内容" name="content" required><br>
        <input type="submit" class="input-area submit" value="登録" name="submit">
    </form>
</body>
</html>