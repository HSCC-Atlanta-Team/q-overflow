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
        $f3->set('template', 'templates/Login.html');
    }

    public function doLogin($f3) 
    {
        $username = $f3->get('REQUEST.username');
        $password = $f3->get('REQUEST.password');
        $key = self::deriveKey($username, $password);
        $repo = new UserRepository($f3->get('secrets.API_KEY'));
        $salt = md5($username.$secretKey);
        $response = $repo->login($username, $key);

        if ($response['success'] === true) {
            $userData = $repo->getUser($username);
            $user = new User($userData['user']);
            $f3->set('SESSION.user', $user);
            $f3->reroute($f3->get('BASEURL').'/dashboard');
        } else {
            $f3->reroute($f3->get('BASEURL').'/login');
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


    public function logout($f3)
    {
        $f3->set('SESSION.user', null);
        $f3->reroute($f3->get('BASEURL').'/login');
    }


    public function showForgot($f3)
    {
        $f3->set('template', 'templates/forgot.html');

    }

    public function afterroute($f3)
    {
        echo \Template::instance()->render('templates/main.html');


    }
    public function showSignup($f3)
    {
        $f3->set('template', 'templates/Signup.html');
    }

    public function doSignup($f3) {
        
    }
}