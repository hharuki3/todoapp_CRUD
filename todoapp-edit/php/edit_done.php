<?php
require('db_connect.php');
$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];
$submit = $_POST['submit'];

if(!empty($submit)){
    $db = db_connect();
    try{
        $sql = 'update posts set title = :title, content = :content where id = :id';
        $stmt = $db->prepare($sql);
        $stmt->bindparam(':id', $id);
        $stmt->bindparam(':title', $title);
        $stmt->bindparam(':content', $content);
        $stmt->execute();

        header('Location:main.php');
    }catch(PDOException $e){
        echo 'エラー：' . $e->getMessage();
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
    <title>編集完了画面</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="title-area">
        <h1>編集完了画面</h1>
    </div>
    <div class="text-area">
        <p>ID:<?php echo $id; ?>を編集しました。</p>
        <p><a href="main.php"></a>メイン画面に戻ります</p>
    </div>
</body>
</html>