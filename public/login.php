<?php   // login.php
//
require_once('./init.php');
//var_dump( $_POST );

// emailとパスワードを form情報から取得
$email = strval($_POST['email'] ?? '');
$pw = strval($_POST['pw'] ?? '');
//var_dump($email, $pw);

// 簡単なvalidate
if ( ('' === $email)||('' === $pw) ) {
    // XXX
    echo 'error';
    exit;
}

/* emailをkeyに、DBから情報を取得 */
// プリペアドステートメントを作成
$sql = 'SELECT * FROM users WHERE email = :email;';
$pre = $dbh->prepare($sql);
//var_dump($pre);
// 値をbind
$pre->bindValue(':email', $email);
// 実行
$r = $pre->execute();
//var_dump($r);
// データを取得
$user = $pre->fetch( \PDO::FETCH_ASSOC );
if (false === $user) {
    // XXX
    echo 'error';
    exit;
}
//var_dump($user);

// パスワードを比較
if (false === password_verify($pw, $user['pw'])) {
    // XXX ログインロックの実装は一端オミット
    // XXX
    echo 'error';
    //echo 'pass';
    exit;
}

// XXX 認証OK
//echo 'ok';

// 認可をonにする
session_regenerate_id(true); // セキュリティ対策
//
unset($user['pw']);
$_SESSION['auth'] = $user;

// ログイン後TopPageに遷移する
header('Location: ./top.php');










