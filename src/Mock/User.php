<?php

namespace Qoverflow\Mock;

use Qoverflow\Model\User;

class UserMock
{
    public static function getUser(): User
    {
        return new User([
            "username" => "Willie0",
            "email" => "willie0@whs.edu",
            "salt" => "279cb885b2de6a469856927b6e22d6f5",
            "points" => 1,
            "user_id" => "63d2d531965abeb54bb7127f",
            "answers" => 0,
            "questions" => 0,
        ]);
    }

    public static function getUsers(): array
    {
        return [
            new User([
                'username' => 'test1',
            ]),
            
            new User([
                'username' => 'test2',
            ]),
            
            new User([
                'username' => 'test3',
            ]),
            
            new User([
                'username' => 'test4',
            ]),
        ];
    }
}