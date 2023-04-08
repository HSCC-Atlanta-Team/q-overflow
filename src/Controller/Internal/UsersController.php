<?php

namespace Qoverflow\Controller\Internal;

class UsersController extends InternalController
{
    public function myself($f3)
    {
        $currentUser = [
            "username" => "Willie0",
            "email" => "willie0@whs.edu",
            "salt" => "279cb885b2de6a469856927b6e22d6f5",
            "points" => 1,
            "user_id" => "63d2d531965abeb54bb7127f",
            "answers" => 0,
            "questions" => 0,
        ];

        $f3->set('currentUser', $currentUser);
        $f3->set('template', 'templates/component/current_user.html');
    }

    public function getUsers($f3)
    {
        $users = [
            [
                'username' => 'test1',
            ],
            [
                'username' => 'test2',
            ],
            [
                'username' => 'test3',
            ],
        ];

        $f3->set('json', $users);
    }
}