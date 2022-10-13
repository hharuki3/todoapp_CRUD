<?php
    // DB接続のファイルを読み込む（db_connectメソッドを使いたいから）
    require('db_connect.php');

    // フォーム送信された情報を受け取る
    $name     = $_POST['name'];
    $password = $_POST['password'];
    $submit   = $_POST['submit'];

    // $submitが空ではない→ログインボタンが押されたと言うこと。
    if (!empty($submit)) {
        $pdo = db_connect();
        try {
            // 名前とパスワードを条件にユーザを取得
            $sql = "SELECT * FROM users WHERE name = :name AND password = :password";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'エラー：' . $e->getMessage();
            die();
        }

        // SELECTした結果、取得できればmain.phpにリダイレクト
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            header("Location: main.php");
            exit;
        } else {
            echo '<font color="red">パスワードか名前に間違いがあります。</font>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインページ</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="title-area">
        <h1>ログインページ</h1>
    </div>
    <form action="" method="POST">
        <input type="text" class="input-area" name="name" placeholder="Your Name" required> <br>
        <input type="password" class="input-area" name="password" placeholder="Your Password" required> <br>
        <input type="submit" class="input-area submit" name="submit" value="Log in">
    </form>
</body>

</html>