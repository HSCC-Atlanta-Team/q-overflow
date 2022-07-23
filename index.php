<?php

require 'vendor/autoload.php';
use Qoverflow\Model\User;
use Qoverflow\Repository\UserRepository;
use Qoverflow\Controller\LoginController;


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
        $username = 'bob123';
        $secretKey = $f3->get('secrets.SECRET_KEY');
        $salt = md5($username.$secretKey);
        $user = new User([
            'email' => 'bob123@test.com',
            'username' => $username, 
            'salt' => $salt,
            ]);
        $data = $users->createUser($user, 'password');
        $key = LoginController::deriveKey($username, 'password', $f3);
        $auth = $users->authUser($username, $key);
        dd($auth, $data, strlen($key));
    }
);
$f3->run();