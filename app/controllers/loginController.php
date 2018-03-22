<?php
/**
 * Created by PhpStorm.
 * User: eazypen
 * Date: 3/20/2018
 * Time: 1:51 AM
 */

namespace App\controllers;
use App\Data\DB;
use App\Services\Response;
use App\Services\FormValidate;
use App\Auth\Auth;


class loginController
{
    private $db;
    private $response;
    private $form;
    private $auth;

    public function __construct(){
        $this->db = new DB();
        $this->response = new Response();
        $this->form = new FormValidate();
        $this->auth = new Auth();
    }

    public function loginPost($tableName){
        $password = $this->form->password(test_input($_POST['password']));
        $email = $this->form->email(test_input($_POST['email']));
        $this->form->checkEmailPass($tableName, "admin_email = '$email' AND password = '$password'");
//        $this->form->checkEmailPass($tableName, "email = '$email' AND password = '$password'");
        $errors = $this->form->error;
        if(!empty($errors)){
            $this->response->setResponse($this->form->error);
            header("Location: " . url('login'));
        }
        else{
            $this->auth->login($tableName,$email,$password);
            header("Location: " . url('dashboard'));
        }
        return true;
    }

    /**
     * @param $tableName
     * @return bool
     */
    public function registerPost($tableName)
    {
        $email = $this->form->email(test_input($_POST['email']));
        $name = $this->form->checkEmpty(test_input($_POST['name']), "Name");
        $password = $this->form->password(test_input($_POST['password']));
        $this->form->passwordMatch(test_input($_POST['password']), test_input($_POST['password2']));
        $this->form->checkEmail($tableName, "admin_email = '$email'");
//        $this->form->checkEmail($tableName, "email = '$email'");
        $errors = $this->form->error;
        if(!empty($errors)){
            $this->response->setResponse($this->form->error);
            header("Location: " . url('register'));
        }
        else{
            $this->auth->signUp($name, $email, $password, $tableName);
            header("Location: " . url('dashboard'));
        }
        return true;
    }

    public function logout($tableName)
    {
        $this->auth->logout($tableName);
        header('Location: ' . url(''));
    }
}