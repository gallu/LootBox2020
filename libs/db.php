<?php   // db.php

// XXX 後でconfigに移動させる
$user = 'loot_box_2020';
$pass = 'loot_box_2020';
$host = 'localhost';
$dbname = 'loot_box_2020';

//
$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
$options = [
    PDO::ATTR_EMULATE_PREPARES => false,  // 静的プレースホルダにする
    PDO::MYSQL_ATTR_MULTI_STATEMENTS => false, // 複文を禁止する
    PDO::ERRMODE_EXCEPTION => true , // エラーだったら例外を投げる
];
//
try {
    $dbh = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // XXX 本当はログにでも書く
    echo 'error: ' , $e->getMessage();
    exit;
}

//var_dump($dbh);
