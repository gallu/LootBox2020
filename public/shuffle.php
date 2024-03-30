<?php  // shuffle.php
// http://dev2.m-fr.net/XXX/LootBox/shuffle.php

// 元の配列を用意
$cards = [];
for($i = 0; $i < 20; ++$i) {
    $cards[] = $i;
}
//var_dump($cards);

//
/*
shuffle($cards);
var_dump($cards);
*/

// https://ja.wikipedia.org/wiki/%E3%83%95%E3%82%A3%E3%83%83%E3%82%B7%E3%83%A3%E3%83%BC%E2%80%93%E3%82%A4%E3%82%A7%E3%83%BC%E3%83%84%E3%81%AE%E3%82%B7%E3%83%A3%E3%83%83%E3%83%95%E3%83%AB#%E6%94%B9%E8%89%AF%E3%81%95%E3%82%8C%E3%81%9F%E3%82%A2%E3%83%AB%E3%82%B4%E3%83%AA%E3%82%BA%E3%83%A0
// 要素数が n の配列 a をシャッフルする(添字は0からn-1):
$n = count($cards);
// i を n - 1 から 1 まで減少させながら、以下を実行する
for($i = $n - 1; 1 <= $i; --$i) {
//echo "{$i} \n";
    // j に 0 以上 i 以下のランダムな整数を代入する
    $j = random_int(0, $i);

    // a[j] と a[i]を交換する
    $wk = $cards[$j];
    $cards[$j] = $cards[$i];
    $cards[$i] = $wk;
}
var_dump($cards);

