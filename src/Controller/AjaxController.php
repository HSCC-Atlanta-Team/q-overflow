<?php

namespace Qoverflow\Controller;

use Qoverflow\Repository\UserRepository;


class AjaxController 
{

    private function sendJson($data)
    {
        header('Content-Type: application/json');

        if (is_subclass_of($data, Model::class)) {
            $data = $data->toArray();
        }

        echo json_encode($data);
    }

    public function getGravatar($f3)
    {
        $username = $f3->get('PARAMS.username');
        $size = $f3->get('REQUEST.size');
        if (!$size) {
            $size = 22;
        }

        $repo = new UserRepository();
        $user = $repo->getUser($username);
        $link = $user->getGravatar($size);

        return $this->sendJson(['url' => $link]);
    }
    
}