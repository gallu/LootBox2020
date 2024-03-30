<?php  // box_gacha_reset.php.php
//  http://dev2.m-fr.net/XXXX/LootBox/box_gacha_reset.php.php
require_once('./init_auth.php');
require_once( BASEPATH . '/libs/BoxGacha.php');

//
$id = strval($_GET['id'] ?? '');
//var_dump($id);
// XXX 本当はIDの存在確認とかをやる

// 「対象のBoxがちゃに含まれるカードの一覧」を取得する
// XXX 本当は専用のテーブルをちゃんと切って。今回は雑に。
// プリペアドステートメントを作成
$sql = 'SELECT * FROM cards ;';
$pre = $dbh->prepare($sql);
// 値をバインド
// XXX 今回はなし
// SQLを実行する
$r = $pre->execute();
//var_dump($r);
// データを取得する
$data = $pre->fetchAll( PDO::FETCH_ASSOC );
//var_dump($data);
$box = [];
foreach($data as $v) {
    $box[] = $v['card_id'];
}
//var_dump($box);

// 「全カード」をシャッフルする
// https://ja.wikipedia.org/wiki/%E3%83%95%E3%82%A3%E3%83%83%E3%82%B7%E3%83%A3%E3%83%BC%E2%80%93%E3%82%A4%E3%82%A7%E3%83%BC%E3%83%84%E3%81%AE%E3%82%B7%E3%83%A3%E3%83%83%E3%83%95%E3%83%AB#%E6%94%B9%E8%89%AF%E3%81%95%E3%82%8C%E3%81%9F%E3%82%A2%E3%83%AB%E3%82%B4%E3%83%AA%E3%82%BA%E3%83%A0
// 要素数が n の配列 a をシャッフルする(添字は0からn-1):
$n = count($box);
// i を n - 1 から 1 まで減少させながら、以下を実行する
for($i = $n - 1; 1 <= $i; --$i) {
//echo "{$i} \n";
    // j に 0 以上 i 以下のランダムな整数を代入する
    $j = random_int(0, $i);

    // a[j] と a[i]を交換する
    $wk = $box[$j];
    $box[$j] = $box[$i];
    $box[$i] = $wk;
}
//var_dump($box);

// データを格納する
// XXX 業務だとDBのほうがよいかもしれない。今回はsessionで。
//$_SESSION['box_gacha'][$id] = serialize($box);
BoxGacha::setBoxGachaArray($id, $box);
//var_dump($_SESSION['box_gacha'][$id]);

// box_gacha.phpに遷移する
header('Location: ./box_gacha.php?id=' . rawurldecode($id));
