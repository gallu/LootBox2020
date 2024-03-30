<?php  // GachaBase.php
require_once(BASEPATH . '/libs/UserCard.php');
require_once(BASEPATH . '/libs/Cards.php');

abstract class GachaBase {

    // コストの支払い処理
    abstract static protected function payCost($dbh, $gacha);

    // カードを引く処理
    static public function draw($dbh, $gacha_id) {
        // がちゃテーブルから情報を取得する
        $sql = 'SELECT * FROM gachas WHERE gacha_id = :gacha_id;';
        $pre = $dbh->prepare($sql);
        //
        $pre->bindValue(':gacha_id', $gacha_id);
        //
        $r = $pre->execute();
        if (false === $r) {
            var_dump($pre->errorInfo()); // XXX
            //header('Location: ./top.php');
            exit;
        }
        $gacha = $pre->fetch( PDO::FETCH_ASSOC );
        if (false === $gacha) {
            header('Location: ./top.php');
            exit;
        }
        //var_dump($gacha);

        // がちゃDetailテーブルからカード一覧を取得する
        $sql = 'SELECT * FROM gacha_details WHERE gacha_id = :gacha_id
                         ORDER BY gacha_probability DESC;';
        $pre = $dbh->prepare($sql);
        //
        $pre->bindValue(':gacha_id', $gacha_id);
        //
        $r = $pre->execute();
        if (false === $r) {
            var_dump($pre->errorInfo()); // XXX
            //header('Location: ./top.php');
            exit;
        }
        $gacha_details = $pre->fetchAll( PDO::FETCH_ASSOC );
        if (false === $gacha_details) {
            header('Location: ./top.php');
            exit;
        }
        //var_dump($gacha_details);

        /* がちゃを引く */
        $cards = []; // 引けたカードを入れる所
        // 「確率の合計」の把握
        $sum = 0;
        foreach($gacha_details  as  $p) {
            $sum += $p['gacha_probability'];
        }
        //var_dump($sum);
        // がちゃで指定された枚数、カードをがちゃる
        for($i = 0; $i < $gacha['gacha_number']; ++$i) {
            // 乱数を作成
            $r = mt_rand(1, $sum);
        //var_dump($r);
            // 「どのカードか」をチョイス
            $start = 1;
            foreach($gacha_details as $d) {
                // 確率の「終了」の値を把握
                $end = $start + $d['gacha_probability'];
                // 確率の「開始」から「終了」までの間に$rが入っていたら、カードhitと見なす
                if ( ($start <= $r) && ($r < $end) ) {
                    $cards[] = $d['card_id'];
                    break;
                }
                // 次
                $start = $end;
            }
        }
        //var_dump($cards);

        // 「引いたカード」をユーザに紐付ける(1レコード1枚)
        //var_dump( $_SESSION['auth']['user_id'] );
        // BEGIN;
        $dbh->beginTransaction();
        try {
            // $gacha から「リソースが必要」なら、確認と減算を行う
            static::payCost($dbh, $gacha);
            
            //
            foreach($cards as $card_id) {
                // カードをユーザに付与する
                UserCard::addCard($dbh, $card_id);
            }
        } catch (\Throwable $e) {
            var_dump($e->getMessage());
            $dbh->rollback();
            header('');
            exit;
        }

        // COMMIT;
        $dbh->commit();

        // 「ナニが引けたか」を出力する
        // XXX 一端、馬力で取得(IN句を使わない)
        //var_dump($cards);
        $card_data = [];
        foreach($cards as $card_id) {
            $card_data[] = Cards::find($dbh, $card_id);
        }
        //var_dump($card_data);
        //
        return $card_data;
    }

}
