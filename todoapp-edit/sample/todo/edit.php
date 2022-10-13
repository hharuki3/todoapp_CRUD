<?php
    // DB接続のファイルを読み込む（db_connectメソッドを使いたいから）
    require('db_connect.php');

    // URLの情報を見て値を取得したいので、GET通信
    $id = $_GET['id'];

    $pdo = db_connect();
    try {
        // 上で取得した更新対象idを条件に投稿内容を取得
        $sql = "SELECT * FROM posts WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
      } catch (PDOException $e) {
        echo $e->getMessage();
        die();
      }

    // 取得できたタイトルと本文を変数に入れておく
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
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="title-area">
        <h1>編集画面</h1>
    </div>
    <form action="edit_done.php" method="POST">
        <input type="text" class="input-area" name="title" placeholder="Title" value="<?php echo $title;?>"> <br>
        <input type="text" class="input-area" name="content" placeholder="Content" value="<?php echo $content;?>"> <br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="input-area submit" name="submit" value="更新">
    </form>
</body>

</html>