<?php  // gacha_list.php

require_once('./init_auth.php');

// DBで「有効ながちゃの一覧」を取得
// プリペアドステートメントを作成
$sql = 'SELECT * FROM gachas ORDER BY gacha_id;'; // XXX WHERE句
$pre = $dbh->prepare($sql);

// 値をバインド
// XXX 今回はなし

// SQLを実行する
$r = $pre->execute();
//var_dump($r);

// データを取得する
$data = $pre->fetchAll( PDO::FETCH_ASSOC );
//var_dump($data);
//exit;

// 出力情報を設定
$template_filename = 'gacha_list.twig';
$context = [
    'gacha_list' => $data,
];

require_once('./fin.php');




