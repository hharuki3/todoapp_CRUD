<?php
require('db_connect.php');
$id = $_GET['id'];

$db = db_connect();
try{
    $sql = 'delete from posts where id = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindparam(':id', $id);
    $stmt->execute();

    header('Location:main.php');
    exit();
}catch(PDOException $e){
    echo 'エラー' . $e->getMessage();
    die();
}
?>