<?php  // daily_gacha.php
require_once('./init_auth.php');
require_once( BASEPATH . '/libs/DailyGacha.php');

// 「今日、すでにデイリーガチャを引いたかどうか？」の判定
try {
    $count = DailyGacha::getCount($dbh);
} catch (\Throwable $e) {
    var_dump($e->getMessage());
    //header(''); // XXX
    exit;
}
//var_dump($count);

//
$template_filename = 'daily_gacha.twig';
$context = [
    'count' => $count,
];

require_once('./fin.php');




