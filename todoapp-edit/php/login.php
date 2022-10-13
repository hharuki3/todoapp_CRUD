<?php
require('db_connect.php');

$name = $_POST['name'];
$password = $_POST['password'];
$submit = $_POST['submit'];

if(!empty($submit)){
    $db = db_connect();
    try{
        $sql = 'select * from users where name = :name';
        $stmt = $db->prepare($sql);
        $stmt->bindparam(':name', $name);
        $stmt->execute();
    }catch(PDOException $e){
        echo 'エラー：'.$e->getMessage();
        die();
    }
    if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        if(password_verify($password, $row['password'])){
            $url = 'main.php?=' . $row['id'];
            // var_dump($row['id']);
            header('Location:' . $url);
            exist();
        }
    }else{
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
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="title-area">
        <h1>ログインページ</h1>
        <a href="signup.php" style="color:white;">新規登録画面へ</a>
    </div>
    <form action="" method="POST">
        <input type="text" class="input-area" name="name" placeholder="Your Name" required><br>
        <input type="password" class="input-area" name="password" placeholder="Your Password" required><br>
        <input type="submit" class="input-area submit" value="送信" name="submit">
    </form>
</body>
</html>