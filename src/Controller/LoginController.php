<?php

namespace Qoverflow\Controller;

class LoginController 
{
    public function index($f3)
    {
    if ($f3->get('REQUEST.msg') == 'fail') {
        $f3->set('error', 'Invlid username or password. Please try again');
        $f3->set('SESSION.login_attempts', $f3->get('SESSION.login_attempts', 0) + 1);

    }
}

    public function doLogin($f3) 
    {
        $username = $f3->get('REQUEST.username');
        $password = $f3->get('REQUEST.password');
        $key = self::deriveKey($username, $password);
        $repo = new UserRepository($f3->get('secrets.API_KEY'));
        $response = $repo->login($username, $salt, $key);

        if ($response['success'] === true) {
            $f3->set('SESSION.user', $response['user']);
            $f3->reroute('/dashboard');
        } else {
            $f3->reroute('/login');
        }

    }

    public static function deriveKey($username, $password, $secretKey)
    {
        $salt = md5($username.$secretKey);

        return hash_pbkdf2(
            'sha256',
            $password,
            $salt,
            100000,
            128
        );
    }
}