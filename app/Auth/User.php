<?php
/**
 * Created by PhpStorm.
 * User: eazypen
 * Date: 1/15/2018
 * Time: 4:54 AM
 */

namespace App\Auth;

use Jasny\Auth\User as BaseUser;

class User implements BaseUser
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $username;

    public $name;

    /**
     * Hashed password
     * @var string
     */
    public $password;

    /**
     * @var boolean
     */
    public $active;


    /**
     * Get the user ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the usermame
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->username;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the hashed password
     *
     * @return string
     */
    public function getHashedPassword()
    {
        return $this->password;
    }


    /**
     * Event called on login.
     *
     * @return boolean  false cancels the login
     */
    public function onLogin()
    {
        if (!$this->active) {
            return false;
        }

        // You might want to log the login
    }

    /**
     * Event called on logout.
     */
    public function onLogout()
    {
        // You might want to log the logout
        session_destroy();
        unset($_SESSION);
    }
}