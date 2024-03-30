<?php   // logout.php
require_once('./init.php');

// ログアウト
unset($_SESSION['auth']);
header('Location: ./index.php');
