<?php
require('db_connect.php');

$name = $_POST['name'];
$password = $_POST['password'];
$submit = $_POST['submit'];


$register_db = db_connect();
if(!empty($submit)){
    try{
        $register_sql = 'insert into users (name, password) value (:name, :password)';
        $register_stmt = $register_db->prepare($register_sql);
        $register_stmt->bindparam(':name', $name);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $register_stmt->bindparam(':password', $password);
        $register_stmt->execute();
        echo '<font color="red">登録処理が完了しました。</font>';
        // header('Location:create.php');
    }catch(PDOException $e){
        echo 'エラー' . $e->getMessage();
        die();
    }
}

$db = db_connect();
try{
    $sql = 'select * from users where name = :name and password = :password ;';
    $stmt = $db->prepare($sql);
    $stmt->bindparam(':name', $name);
    $stmt->bindparam(':password', $password);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo 'エラー：'. $e->getMessage();
    die();
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
        <h1>ユーザー新規登録ページ</h1>
            <a href="login.php" style="color:white;">ログインページ</a>
        
    </div>
    <form action="" method="POST">
        <input type="text" class="input-area" name="name" placeholder="Your Name" required><br>
        <input type="password" class="input-area" name="password" placeholder="Your Password" required><br>
        <input type="submit" class="input-area submit" value="新規登録" name="submit">
    </form>
</body>
</html>