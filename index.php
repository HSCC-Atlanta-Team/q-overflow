<?php

require 'vendor/autoload.php';
use Qoverflow\Model\User;
use Qoverflow\Repository\UserRepository;
use Qoverflow\Controller\LoginController;

session_start();


$f3 = \Base::instance();
$f3->route('GET /', function($f3){



    $repo = new UserRepository($f3);
    $userModel = new User([
        'username' => 'RQdoXQn87S',
        'points' => 12,
    ]);

    $user = $repo->changePassword('ouhnoujh', 'candy');

    dd($user);
    $question = $repo->getUserQuestions();
});
$f3->config('config/globals.cfg');
$f3->config('config/routes.cfg');
$f3->config('config/secrets.cfg');
$f3->run();