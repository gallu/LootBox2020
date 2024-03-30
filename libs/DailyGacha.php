<?php  // DailyGacha.php
require_once(BASEPATH . '/libs/GachaBase.php');

class DailyGacha extends GachaBase {
    // コストの支払い処理
    static protected function payCost($dbh, $gacha) {
        // daily_gachaにinsert
        $sql = 'INSERT daily_gacha(user_id) VALUES(:user_id);';
        $pre = $dbh->prepare($sql);
        //
        $pre->bindValue(':user_id', $_SESSION['auth']['user_id']);
        //
        $r = $pre->execute();
        // 多分 重複キーエラー
        if (false === $r) {
            throw new \Exception($pre->errorInfo()[2]);
        }
    }
    //
    public static function getCount($dbh) {
        $sql = 'SELECT count(user_id) as cnt FROM daily_gacha WHERE user_id = :user_id;';
        $pre = $dbh->prepare($sql);
        //
        $pre->bindValue(':user_id', $_SESSION['auth']['user_id']);
        //
        $pre->execute();
        $count = $pre->fetch( PDO::FETCH_ASSOC )['cnt'];
        return $count;
    }
}