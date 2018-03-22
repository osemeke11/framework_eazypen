<?php

namespace App\Auth;

use App\Data\DB;

class Auth
{
    private $db;



    function __construct()
    {
        $this->db = new DB();
    }

    // OnLogin
    public static function guest($name, $email, $tableName)
    {
        if(isset($_SESSION[$tableName])){
            return true;
        }
        else{
            $_SESSION[$tableName]['names'] = $name;
            $_SESSION[$tableName]['email'] = $email;
            return true;
        }
    }

    // User Detail
    public static function User($tableName)
    {
        if (isset($_SESSION[$tableName]) !== false){
            $email = $_SESSION[$tableName]['email'];
            $name = $_SESSION[$tableName]['names'];
            return [
                "email" => $email,
                "name" => $name,
            ];
        }
        else{
            return false;
        }
    }

    // Login
    public function login($tableName, $email, $password)
    {
        $getUser = $this->db->getAllDataWhere($tableName, "admin_email = '$email' AND password = '$password'");
        foreach($getUser as $row){
            $a_name = $row['admin_name'];
//            $a_name = $row['name'];
            $a_email = $row['admin_email'];
//            $a_email = $row['email'];
        }
        Auth::guest($a_name,$a_email,$tableName);
    }

    // SignUp
    public function signUp($name, $email, $password, $tableName)
    {
        $data = [
//            "name" => $name,
            "admin_name" => $name,
//            "email" => $email,
            "admin_email" => $email,
            "password" => $password,
        ];
        $addUser = $this->db->addData($tableName, $data);
        if($addUser !== false){
            $getUser = $this->db->getAllDataWhere($tableName, "admin_email = '$email' AND password = '$password'");
            foreach($getUser as $row){
                $a_name = $row['admin_name'];
//            $a_name = $row['name'];
                $a_email = $row['admin_email'];
//            $a_email = $row['email'];
            }
//            dd($getUser);
            Auth::guest($a_name,$a_email,$tableName);
        }
    }

    // Forgot Password

    // Change Password

    // Reset Password

    // Edit User

    // Logout
    public function logout($tableName)
    {
        unset($_SESSION[$tableName]);
    }
}