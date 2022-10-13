<?php
define('db_database', 'todo');
define('db_username', 'root');
define('db_password', 'root');
define('DSN', 'mysql:host=localhost;charset=utf8;dbname='.db_database);

function db_connect(){
    try{
        $db = new PDO(DSN, db_username, db_password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;

    }catch(PDOException $e){
        echo 'error:'. $e->getMessage();
        die();
    }
}