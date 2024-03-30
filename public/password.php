<?php  // password.php

/*
$raw_pass = '0123';
$hash_pass = password_hash($raw_pass,  PASSWORD_DEFAULT);
var_dump( $hash_pass );
var_dump( password_verify($raw_pass, $hash_pass) );
var_dump( password_verify('01234', $hash_pass) );
*/

//
$raw_pass = str_repeat('a', 72);
$raw_pass2 = $raw_pass . 'xyz';
//
$hash_pass = password_hash($raw_pass,  PASSWORD_DEFAULT);
$hash_pass2 = password_hash($raw_pass2,  PASSWORD_DEFAULT);
//
var_dump( password_verify($raw_pass, $hash_pass2) );
var_dump( password_verify($raw_pass2, $hash_pass) );
