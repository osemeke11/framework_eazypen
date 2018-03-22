<?php
/**
 * Created by PhpStorm.
 * User: eazypen
 * Date: 1/30/2018
 * Time: 12:54 PM
 */

namespace App\controllers;

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


}