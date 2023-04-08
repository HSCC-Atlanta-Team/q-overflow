<?php

namespace Qoverflow\Controller\Internal;

class InternalController
{
    public function beforeroute($f3)
    {
        /* we should check for logged in user here
        also, maybe check that this is not being loaded 
        by iteself, by checking the `referrer` */
    }

    /**
     * afterroute will be executed after the main controller method has completed
     */
    public function afterroute($f3)
    {
        // IF `json` is set, then we know that the intention was to return JSON data
        if (isset($f3->json)) {
            header('Content-Type: application/json');
            echo json_encode($f3->json);
        } else { // otherwise, render the template as a snippet
            echo \Template::instance()->render($f3->template);
        }
    }
}