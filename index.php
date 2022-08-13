<?php

require 'vendor/autoload.php';
use Qoverflow\Model\User;
use Qoverflow\Repository\UserRepository;
use Qoverflow\Controller\LoginController;

session_start();

$f3 = \Base::instance();
$f3->route('GET /test', function ($f3) {
    if ($f3->get('ENVIRONMENT') == 'production') {
        $f3->reroute('GET /');
    }

    $template = sprintf(
        'templates/%s.html',
        $f3->get('REQUEST.template')
    );
    
    $f3->set('template', $template);
    echo \Template::instance()->render('templates/main.html');
});
$f3->config('config/globals.cfg');
$f3->config('config/routes.cfg');
$f3->config('config/secrets.cfg');

// get logged in user 
if ($_SESSION['username']) {
    $currentUser = (new UserRepository())->getUser($_SESSION['username']);
    $currentUser = new User($currentUser['user']);
} else if ($_COOKIE['username']) {
    if (md5($_COOKIE['username'].$f3->get('secrets.SECRET_KEY')) == $_COOKIE['hash']) {
        $currentUser = $repo->getUser($_COOKIE['username']);
        $currentUser = new User($currentUser);
    }
} else {
    $currentUser = new User([]);
}

$f3->set('currentUser', $currentUser);

$f3->run();