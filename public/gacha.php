<?php  // gacha.php
require_once('./init_auth.php');
require_once(BASEPATH . '/libs/Gacha.php');

// がちゃidを把握する
$gacha_id = strval($_GET['gacha_id'] ?? '');
if ('' === $gacha_id) {
    header('Location: ./top.php');
    exit;
}
//var_dump($gacha_id);

// がちゃを引く
$card_data = Gacha::draw($dbh, $gacha_id);

//
$template_filename = 'gacha.twig';
$context = [
    'card_data' => $card_data,
];

require_once('./fin.php');













