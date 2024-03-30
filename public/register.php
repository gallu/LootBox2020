<?php   // register.php
//
require_once('./init.php');

// データの受け取り
$params = [
    'pc_name',
    'email',
    'pw',
    'pw2',
];
$data = [];
foreach($params as $p) {
    $data[$p] = (string)($_POST[$p] ?? '');
}
//var_dump($data);

// データのvalidate
$error_messages = [];
foreach($params as $p) {
    if ('' === $data[$p]) {
        $error_messages[] = "{$p}は必須入力項目";
    }
}
// pw: 文字数の制限
if ( (6 > strlen($data['pw'])) || (72 < strlen($data['pw'])) ) {
    $error_messages[] = "pwは6～72文字";
}
// pw と pw2 の比較
if ( $data['pw'] !== $data['pw2'] ) {
    $error_messages[] = "pwとpw（再）の値が違う";
}
//
if ([] !== $error_messages) {
    // XXX
    var_dump( $error_messages );
    exit;
}
//echo 'ok';

/* アカウントをDBに登録する */
// 準備された文(プリペアドステートメント)の作成
$sql = 'INSERT INTO users(pc_name, email, pw) VALUES(:pc_name, :email, :pw);';
$pre = $dbh->prepare($sql);
//var_dump($pre);

// 値のバインド
$pre->bindValue(':pc_name', $data['pc_name']);
$pre->bindValue(':email', $data['email']);
$pre->bindValue(':pw', password_hash($data['pw'], PASSWORD_DEFAULT));

// SQLの実行
$r = $pre->execute();
var_dump($r);
if (false === $r) {
    var_dump( $pre->errorInfo() ); // XXX
    exit;
}

// 登録完了を表示する
header('Location: ./register_fin.php');













