<?php

require 'vendor/autoload.php';
use Qoverflow\Model\User;
use Apix\Cache\Pdo\Sqlite;
use Qoverflow\Repository\UserRepository;
use Qoverflow\Controller\LoginController;

session_start();

$f3 = \Base::instance();

$dbPath = __DIR__ . '/tmp/cache_db.sq3';

if(true){
    $dbh = new \PDO('sqlite:'.$dbPath);
    $options = [
        'db_table' => 'cache', 
        'serializer' => 'php', 
        'preflight' => true, 
        'timestamp' => 'Y-m-d H:i:s', 
        'prefix_key' => '', 
        'prefix_tag' => 'tag:', 
    ];

    $cache = new Sqlite($dbh, $options);
} else{
    $options = [
        'directory' => 'tmp',
        'locking' => true,
    ];
    $cache = new Cache\Files($options);
}

$f3->cache = $cache;

$repo = new UserRepository();
$repo->getUsers();

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
} else if ($_COOKIE['username']) {
    if (md5($_COOKIE['username'].$f3->get('secrets.SECRET_KEY')) == $_COOKIE['hash']) {
        $currentUser = $repo->getUser($_COOKIE['username']);
    }
} else {
    $currentUser = new User([]);
}

$f3->set('currentUser', $currentUser);
$f3->run();