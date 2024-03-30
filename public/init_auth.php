<?php  // init_auth.php

require_once('./init.php');
// 認可チェック
if (false === isset($_SESSION['auth'])) {
    header('Location: ./index.php');
    exit;
}
