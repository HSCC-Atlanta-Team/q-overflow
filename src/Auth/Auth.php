<?php

namespace Qoverflow\Auth;

class Auth
{
    private $f3;

    public function __construct()
    {
        $this->f3 = \Base::instance();
    }

    public static function isAuthenticated(): bool
    {
        return true;
    }
}