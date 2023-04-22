<?php

namespace Qoverflow\Mock;

use Qoverflow\Model\User as UserModel;

class User
{
    public static function getUser(): UserModel
    {
        return new UserModel([
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
            new UserModel([
                'username' => 'test1',
            ]),
            
            new UserModel([
                'username' => 'test2',
            ]),
            
            new UserModel([
                'username' => 'test3',
            ]),
            
            new UserModel([
                'username' => 'test4',
            ]),
        ];
    }
}