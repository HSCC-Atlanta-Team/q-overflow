<?php

namespace Qoverflow\Model;

class User extends Model
{
    protected $user_id;
    protected $salt;
    protected $username;
    protected $email;
    protected $points;



    /**
     * Get the value of user_id
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     */
    public function setUserId($user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of salt
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set the value of salt
     */
    public function setSalt($salt): self
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     */
    public function setUsername($username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of points
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set the value of points
     */
    public function setPoints($points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getGravatar()
    {
        $hashedEmail = md5(trim(strtolower($this->getEmail())));
        $request = "https://www.gravatar.com/avatar/".$hashedEmail;

        return $request;
    }

}