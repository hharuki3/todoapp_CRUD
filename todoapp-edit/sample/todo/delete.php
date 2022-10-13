<?php
    // DB接続のファイルを読み込む（db_connectメソッドを使いたいから）
    require('db_connect.php');

    // URLの情報を見て値を取得したいので、GET通信
    $id = $_GET['id'];

    $pdo = db_connect();

    try {
        // idを条件に削除対象を決める
        $sql = "DELETE FROM posts WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
      
        // main.phpにリダイレクト
        header("Location: main.php");
        exit;
      } catch (PDOException $e) {
        echo $e->getMessage();
        die();
      }
?>