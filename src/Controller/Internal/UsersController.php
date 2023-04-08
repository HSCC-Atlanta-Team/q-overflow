<?php

namespace Qoverflow\Controller\Internal;

class UsersController extends InternalController
{
    public function myself($f3)
    {
        // Data mock: this is just sample data we set up (temporarily) to test our code
        $currentUser = [
            "username" => "Willie0",
            "email" => "willie0@whs.edu",
            "salt" => "279cb885b2de6a469856927b6e22d6f5",
            "points" => 1,
            "user_id" => "63d2d531965abeb54bb7127f",
            "answers" => 0,
            "questions" => 0,
        ];

        // set the variable in out application (referenced as $f3)
        $f3->set('currentUser', $currentUser);
        // set a `template` variable, so our afterroute method of the base class will know
        // what to render
        $f3->set('template', 'templates/component/current_user.html');
    }

    public function getUsers($f3)
    {
        // Data mock
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

        // here, we set the `json` variable, so afterroute will know to return as JSON
        $f3->set('json', $users);
    }
}