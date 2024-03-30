<?php  // array.php

//
$awk_base = range(0, 999);
$t = microtime(true);
for($i = 0; $i < 10000; ++$i) {
    $awk = $awk_base;
    $v = array_pop($awk);
}
$t_end = microtime(true);
var_dump($t_end - $t);

//
$t = microtime(true);
for($i = 0; $i < 10000; ++$i) {
    $awk = $awk_base;
    $v = array_shift($awk);
}
$t_end = microtime(true);
var_dump($t_end - $t);
