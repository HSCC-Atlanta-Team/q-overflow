<?php

require 'vendor/autoload.php';
use Qoverflow\Model\User;
use Qoverflow\Repository\UserRepository;

function getRandomString($length = 10, $chars = 'abcdef0123456789') {
    $str = '';

    $size = strlen($chars);
    for ($i = 0; $i < $length; $i++) {
        $str .= $chars[mt_rand(0, $size - 1)];
    }

    return $str;
}

$f3 = \Base::instance();
$f3->config('config/globals.cfg');
$f3->config('config/routes.cfg');
$f3->config('config/secrets.cfg');
$f3->route('GET /',
    function($f3) {
        $users = new UserRepository(
            $f3->get('secrets.API_KEY')
        );
        $user = new User([
            'username' => 'Sowryac1', 
            'email' => 'hscc2@test.com',
            'salt' => getRandomString(32),
            ]);
        $data = $users->createUser($user, getRandomString(128));
            dd($data);
    }
);
$f3->run();