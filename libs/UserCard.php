<?php  // UserCard.php

class UserCard {
    // ユーザにカードを付与する
    static public function addCard($dbh, $card_id) {
        //
        $date_string = date('Y-m:d H:i:s');

        // user_card_1
        //
        $sql = 'INSERT INTO user_card_1(user_id, card_id, created_at) VALUES(:user_id, :card_id, :created_at);';
        $pre = $dbh->prepare($sql);
        //
        $pre->bindValue(':user_id', $_SESSION['auth']['user_id']);
        $pre->bindValue(':card_id', $card_id);
        $pre->bindValue(':created_at', $date_string);
        //
        $pre->execute();

        // user_card_2
        /*
        select
        if () {
            update
        } else {
            insert
        }
        */
        $sql = 'INSERT INTO user_card_2(user_id, card_id, num, created_at, updated_at)
                       VALUES(:user_id, :card_id, 1, :created_at, :updated_at)
                       ON DUPLICATE KEY UPDATE
                       num = num + 1, updated_at = :updated_at_2;';
        $pre = $dbh->prepare($sql);
        //
        $pre->bindValue(':user_id', $_SESSION['auth']['user_id']);
        $pre->bindValue(':card_id', $card_id);
        $pre->bindValue(':created_at', $date_string);
        $pre->bindValue(':updated_at', $date_string);
        $pre->bindValue(':updated_at_2', $date_string);
        //
        $r = $pre->execute();
    }

}