<?php

namespace Qoverflow\Controller\Internal;

use Qoverflow\Mock\User as UserMock;

class UsersController extends InternalController
{
    public function myself($f3)
    {
        dd('test');
        // set the variable in out application (referenced as $f3)
        $f3->set('currentUser', UserMock::getUser());
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