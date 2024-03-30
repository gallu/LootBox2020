<?php  // Gacha.php

require_once(BASEPATH . '/libs/GachaBase.php');

class Gacha extends GachaBase {
    // コストの支払い処理
    static protected function payCost($dbh, $gacha) {
        // XXX 支払い無しなので、処理も無し
    }
}
