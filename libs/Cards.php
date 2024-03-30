<?php  // Cards.php

class Cards {
    //
    static public function find($dbh, $card_id) {
        //
        $sql = 'SELECT * FROM cards WHERE card_id = :card_id ;';
        //
        $pre = $dbh->prepare($sql);
        $pre->bindValue(':card_id', $card_id);
        //
        $pre->execute();
        $datum = $pre->fetch( PDO::FETCH_ASSOC );
        //
        return $datum;
    }
}
