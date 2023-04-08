<?php

require 'vendor/autoload.php';

session_start();

$f3 = \Base::instance();
$f3->config('config/globals.cfg');
$f3->config('config/routes.cfg');
$f3->config('config/secrets.cfg');

$f3->run();
