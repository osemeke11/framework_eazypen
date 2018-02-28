<?php
/**
 * Created by PhpStorm.
 * User: eazypen
 * Date: 2/26/2018
 * Time: 9:04 PM
 */

namespace App\Auth;

use App\Data\DB;

class Auth
{
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    // OnLogin
    public static function guest()
    {
        if(!isset($_SESSION['user'])){
            return false;
        }
    }

    public static function User()
    {
        return [
            'name' => $_SESSION['user']['names'],
            'email' => $_SESSION['user']['email']
        ];
    }

    // User Detail
    public function fetchUser($name, $email)
    {
        if (Auth::guest() === false){
            $_SESSION['user']['names'] = $name;
            $_SESSION['user']['email'] = $email;
        }
    }
    // Login
    public function login($email, $password)
    {
        $getUser = $this->db->getAllDataWhere('admin', "admin_email = '$email' AND password = '$password'");
        foreach ($getUser as $row) {
            $this->fetchUser($row['admin_name'], $row['admin_email']);
        }
    }

    // SignUp
    public function userRegistration($name, $email, $password)
    {
        $data = [
            'admin_name' => $name,
            'admin_email' => $email,
            'password' => $password
        ];
        $addUser = $this->db->addData('admin', $data);
        if($addUser !== false){
            $getUser = $this->db->getAllDataWhere('admin', "admin_email = '$email' AND password = '$password'");
            foreach ($getUser as $row) {
                $this->fetchUser($row['admin_name'], $row['admin_email']);
            }
        }
    }

    // Forgot Password

    // Change Password

    // Reset Password

    // Edit User

    // Logout
    public function logout()
    {
        unset($_SESSION['user']);
        return true;
    }
}