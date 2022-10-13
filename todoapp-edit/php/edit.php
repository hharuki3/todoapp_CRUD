<?php
require('db_connect.php');

$id = $_GET['id'];
$db = db_connect();
try{
    $sql = 'select * from posts where id = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindparam(':id', $id);
    $stmt->execute();
}catch(PDOException $e){
    echo 'エラー：' . $e->getMessage();
}

$row = $stmt->fetch(PDO::FETCH_ASSOC);
$title = $row['title'];
$content = $row['content'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編集画面</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="title-area">
        <h1>編集画面</h1>
        <a href="main.php" style="color:white;">戻る</a>
    </div>
    <form action="edit_done.php" method="POST">
        <input type="text" class="input-area" placeholder="タイトル" name="title" value="<?php echo $title; ?>" ><br>
        <input type="text" class="input-area" placeholder="内容" name="content" value="<?php echo $content; ?>"><br>
        <input type="submit" class="input-area submit" value="更新" name="submit">
        <input type="hidden" name="id" value=<?php echo $id; ?>>
    </form>
    </div>
</body>
</html>