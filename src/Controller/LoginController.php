<?php

namespace Qoverflow\Controller;

use Qoverflow\Model\User;
use Qoverflow\Repository\UserRepository;
use SebastianBergmann\Template\Template;

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
        $email = $f3->get('REQUEST.email');
        $password = $f3->get('REQUEST.password');
        $repo = new UserRepository();
        $user = new User([
            'username' => $username,
            'email' => $email,
        ]);
        $response = $repo->authUser($user, $password);

        if ($response === true) {
            $user = $repo->getUser($username);
            $f3->set('SESSION.username', $user->getUsername());
            $f3->reroute($f3->get('BASEURL').'/dashboard');
        } else {
            $f3->reroute($f3->get('BASEURL').'/login');
        }

    }


    public function logout($f3)
    {
        $f3->set('SESSION.username', null);
        $f3->reroute($f3->get('BASEURL').'/login');
    }


    public function showForgot($f3)
    {
        $f3->set('template', 'templates/forgot.html');

    }

    public function doForgot($f3)
    {
        $username = $f3->get('REQUEST.username_forgot');
        $link = sprintf(
            '%s/reset?id=%s',
            $f3->get('BASEURL'),
            base64_encode($username)
        );
        $f3->set('link', $link);
        $f3->set('template', 'templates/forgot_success.html');

    }

    public function showReset($f3)
    {
        $f3->set('template', 'templates/reset.html');
        $f3->set('id', $f3->get('REQUEST.id'));


    }

    public function doReset($f3)
    {
        $password1 = $f3->get('REQUEST.password1');
        $password2 = $f3->get('REQUEST.password2');
        $id = $f3->get('REQUEST.id');
        if ($password1 !== $password2) {
            $f3->reroute($f3->get('BASEURL').'/reset');


        }
        $userRepo = new UserRepository();
        $username = base64_decode($id);
        $result = $userRepo->changePassword($username, $password1);
        if ($result['success'] == true) {
            $f3->reroute($f3->get('BASEURL').'/login');
        }
        

    }

    public function afterroute($f3)
    {
        echo \Template::instance()->render('templates/main.html');


    }
    public function showSignup($f3)
    {
        $f3->set('template', 'templates/Signup.html');
    }

    public function doSignup($f3) 
    {
        $userRepo = new UserRepository();

        $username = $f3->get('REQUEST.username_signup');
        $email = $f3->get('REQUEST.email_signup');
        $password = $f3->get('REQUEST.pwd_signup');

        $user = new User([
            'username' => $username,
            'email' => $email, 
        ]);
        $newUser = $userRepo->createUser($user, $password);
        if (!is_array($newUser) && $newUser->getUsername()) {
            
            $f3->set('SESSION.username', $newUser->getUsername());

            $f3->reroute($f3->get('BASEURL').'/dashboard');
   
        }

        $f3->reroute($f3->get('BASEURL').'/signup');
    
    }
}