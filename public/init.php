<?php  // init.php
//
ob_start();
session_start();

//
define('BASEPATH', realpath(__DIR__ . '/..'));
require_once(BASEPATH . '/vendor/autoload.php');

// dbハンドルの取得
require_once( BASEPATH . '/libs/db.php');

//
$loader = new \Twig\Loader\FilesystemLoader(BASEPATH . '/templates');
$twig = new \Twig\Environment($loader);
