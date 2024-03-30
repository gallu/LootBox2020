<?php  // box_gacha_draw.php
//  http://dev2.m-fr.net/XXXX/LootBox/box_gacha_draw.php
require_once('./init_auth.php');
require_once( BASEPATH . '/libs/BoxGacha.php');
require_once(BASEPATH . '/libs/UserCard.php');
require_once(BASEPATH . '/libs/Cards.php');

//
$id = strval($_GET['id'] ?? '');
//var_dump($id);
// XXX 本当はIDの存在確認とかをやる

// BEGIN;
$dbh->beginTransaction();

try {
    // 「boxの配列」を取り出す
    $box = BoxGacha::getBoxGachaArray($id);
    if ([] === $box) {
        header('Location: ./box_gacha_list.php');
        return;
    }

    // boxの配列から1枚取り出す
    //var_dump(count($box));
    $card_id = array_pop($box);
    //var_dump($card_id, count($box));

    // ユーザにカードを付与する
    UserCard::addCard($dbh, $card_id);

    // 「1枚引いたboxの配列」を改めて格納する
    BoxGacha::setBoxGachaArray($id, $box);
} catch (\Throwable $e) {
    var_dump($e->getMessage());
    $dbh->rollback();
    //header(''); // XXX
    exit;
}
// COMMIT;
$dbh->commit();

// 引いたカードの内容を出力
$datum = Cards::find($dbh, $card_id);
var_dump($datum); // XXX












