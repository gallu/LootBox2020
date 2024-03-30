<?php  // daily_gacha_draw.php

require_once('./init_auth.php');
require_once( BASEPATH . '/libs/DailyGacha.php');

// 「引いていいがちゃ」の種類の確認(もしくは1種類固定)
$gacha_id = 1; // XXX

// 今日の権限があるかどうか確認
$count = DailyGacha::getCount($dbh);
if (0 != $count) {
    // XXX
    echo '今日はもうひいたってばよ？';
    exit;
}

// がちゃを引く
// XXX (Gachaクラスを継承する) ＋ デイリーテーブルにマーキング(リソースの所を継承で上書き)
$card_data = DailyGacha::draw($dbh, $gacha_id);

// 引いたカードの表示
var_dump($card_data); // XXX

