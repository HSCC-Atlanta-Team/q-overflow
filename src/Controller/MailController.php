<?php

namespace Qoverflow\Controller;

use Qoverflow\Repository\MailRepository;

class MailController
{
    public function index($f3)
        {
            $username = $f3->get('SESSION.username');
            $repo = new MailRepository();
            $mail = $repo->mailGet($username);
            $f3->set('mail', $mail);
            $f3->set('template', 'templates/mail.html');
        }
        public function afterroute($f3)
    {
        echo \Template::instance()->render('templates/main.html');


    }
}