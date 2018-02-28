<?php
/**
 * Created by PhpStorm.
 * User: eazypen
 * Date: 1/30/2018
 * Time: 12:54 PM
 */

namespace App\Services;

use App\Data\DB;
use App\Services\Response;
use App\Services\FormValidate;
use App\Auth\Auth;

class PostsController
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

    public function contactPost(){
        $name = $this->form->checkEmpty(test_input($_POST['name']), "Name");
        $email = $this->form->email(test_input($_POST['email']));
        $message = $this->form->checkEmpty(test_input($_POST['message']), "Message");
        $errors = $this->form->error;
        if(!empty($errors)){
           $this->response->setResponse($this->form->error);
        }
        else{
            $this->response->setResponse(['Successfully Ok']);
        }
        header("Location: " . url('contact'));
        return true;
    }

    public function loginPost(){
        $password = $this->form->password(test_input($_POST['password']));
        $email = $this->form->email(test_input($_POST['email']));
        $this->form->checkEmailPass('admin', "admin_email = '$email' AND password = '$password'");
        $errors = $this->form->error;
        if(!empty($errors)){
            $this->response->setResponse($this->form->error);
            header("Location: " . url('login'));
        }
        else{
            $this->auth->login($email,$password);
            header("Location: " . url('dashboard'));
        }
        return true;
    }

    public function registerPost()
    {
        $email = $this->form->email(test_input($_POST['email']));
        $name = $this->form->checkEmpty(test_input($_POST['name']), "Name");
        $password = $this->form->password(test_input($_POST['password']));
        $this->form->passwordMatch(test_input($_POST['password']), test_input($_POST['password2']));
        $this->form->checkEmail('admin', "admin_email = '$email'");
        $errors = $this->form->error;
        if(!empty($errors)){
            $this->response->setResponse($this->form->error);
            header("Location: " . url('register'));
        }
        else{
            $this->auth->userRegistration($name, $email, $password);
            header("Location: " . url('dashboard'));
        }
        return true;
    }

    public function logout()
    {
        $this->auth->logout();
        header('Location: ' . url(''));
    }
}