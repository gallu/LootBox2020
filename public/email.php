<?php  // email.php

echo 'email.php';

function validate($email) {
    $r = filter_var($email, FILTER_VALIDATE_EMAIL);
    var_dump($r);
/*
    if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)) {
        echo "正しいメールアドレスかもしれません\n";
    } else {
        echo "正しくないメールアドレスではないかもしれません\n";
    }
    echo "\n";
*/
}

validate("test@test.com");
validate("test+1@test.com");
validate('"Abc@def"@example.com');
validate('"Joe.\\Blow"@example.com');
validate('foo@[192.0.2.69]');
validate('foo.@docomo.ne.jp');
validate('foo..foo@docomo.ne.jp');


