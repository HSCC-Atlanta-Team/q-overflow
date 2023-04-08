<?php

namespace Qoverflow\Controller\Internal;

class InternalController
{
    public function beforeroute($f3)
    {
        // check for logged in user
    }

    public function afterroute($f3)
    {
        if (isset($f3->json)) {
            header('Content-Type: application/json');
            echo json_encode($f3->json);
        } else {
            echo \Template::instance()->render($f3->template);
        }
    }
}