<?php  // box_gacha.php
//  http://dev2.m-fr.net/XXXX/LootBox/box_gacha.php
require_once('./init_auth.php');
require_once( BASEPATH . '/libs/BoxGacha.php');

//
$id = strval($_GET['id'] ?? '');
//var_dump($id);

// XXX 本当はIDの存在確認とかをやる

// 表示する
$template_filename = 'box_gacha.twig';
/*
if (isset($_SESSION['box_gacha'][$id])) {
    $box_list_num = count(unserialize($_SESSION['box_gacha'][$id]));
} else {
    $box_list_num = 0;
}
//$box_list_num = count(unserialize($_SESSION['box_gacha'][$id] ?? serialize([])));
*/
$box_list_num = count(BoxGacha::getBoxGachaArray($id));
//var_dump($box_list_num);

$context = [
    'id' => $id,
    'box_list_num' => $box_list_num,
];

require_once('./fin.php');
