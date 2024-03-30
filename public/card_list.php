<?php  // card_list.php
//  http://dev2.m-fr.net/XXXX/LootBox/card_list.php

require_once('./init_auth.php');

/* user_cardのデータを取り出す */
// プリペアドステートメントを作成する
$sql = 
'SELECT *
   FROM user_card_2
        LEFT JOIN cards ON user_card_2.card_id = cards.card_id
  WHERE user_card_2.user_id = :user_id
  ORDER BY user_card_2.card_id
;';
$pre = $dbh->prepare($sql);

// 値をバインドする
$pre->bindValue(':user_id', $_SESSION['auth']['user_id']);

// 実行する
$r = $pre->execute();
if (false === $r) {
    echo 'error';
    var_dump( $pre->errorInfo() ); // XXX
    exit;
}
// データを取得
$data = $pre->fetchAll( PDO::FETCH_ASSOC );
//var_dump($data); exit;

// 表示する
$template_filename = 'card_list.twig';
$context = [
    'card_list' => $data,
];

require_once('./fin.php');

