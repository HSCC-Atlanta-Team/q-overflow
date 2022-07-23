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

new Session();
$f3 = \Base::instance();
$f3->config('config/globals.cfg');
$f3->config('config/routes.cfg');
$f3->config('config/secrets.cfg');
$f3->route('GET /',
    function($f3) {
        $users = new UserRepository(
            $f3->get('secrets.API_KEY')
        );

        $username = 'bob456';
        $secretKey = $f3->get('secrets.SECRET_KEY');
        $salt = md5($username.$secretKey);

        $key = LoginController::deriveKey($username, 'password', $f3->get('secrets.SECRET_KEY'));
        $auth = $users->authUser($username, $key);

        if ($auth['success'] === true){
            $userData = $users->getUser($username);
            $user = new User($userData['user']);

            $f3->set('SESSION.user', $user);
        }
        
        dd($auth, $userData, $user, $f3->get('SESSION.user'));
    }
);
$f3->run();