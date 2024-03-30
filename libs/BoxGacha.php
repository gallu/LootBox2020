<?php  // BoxGacha.php

class BoxGacha {
    //
    public static function getBoxGachaArray($id) : array {
        if (false === isset($_SESSION['box_gacha'][$id])) {
            return [];
        }
        // else
        return unserialize($_SESSION['box_gacha'][$id]);
    }
    // XXX 業務だとDBのほうがよいかもしれない。今回はsessionで。
    public static function setBoxGachaArray($id, $box) {
        //
        $_SESSION['box_gacha'][$id] = serialize($box);
    }
}