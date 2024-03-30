<?php  // twig.php

define('BASEPATH', realpath(__DIR__ . '/..'));
require_once(BASEPATH . '/vendor/autoload.php');

//
$loader = new \Twig\Loader\FilesystemLoader(BASEPATH . '/templates');
$twig = new \Twig\Environment($loader);

echo $twig->render('index.twig', ['name' => 'Fabien']);
