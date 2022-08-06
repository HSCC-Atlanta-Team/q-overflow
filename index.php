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
$f3->run();