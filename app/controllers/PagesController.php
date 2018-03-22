<?php
/**
 * Created by PhpStorm.
 * User: eazypen
 * Date: 1/28/2018
 * Time: 8:33 AM
 */

namespace App\controllers;

use App\Auth\Auth;
use App\Data\DB;
use App\Services\Response;

class PagesController
{
    private $auth;
    private $db;
    private $response;

    public function __construct(){
        $this->db = new DB();
        $this->response = new Response();
        $this->auth = new Auth();
    }

    public function index($id=null){
        $message = $this->response->getResponse();
        $data = [

            "message" => $message
        ];

        $this->response->destroyResponse();
        require resource_view('index');

        return true;
    }

    public function about(){
        $message = $this->response->getResponse();
        $data = [

            "message" => $message
        ];

        $this->response->destroyResponse();
        require resource_view('about');

        return true;
    }

    public function contact(){
        $message = $this->response->getResponse();
        $data = [
            "page_title" => "Contact Us",
            "message" => $message
        ];

        $this->response->destroyResponse();
        require resource_view('contact');

        return true;
    }

    public function dashboard(){
        if(Auth::user('admin') === false){
            header("Location: " . url('login'));
        }
        else{
            $message = $this->response->getResponse();
            $data = [
                "page_title" => Auth::User('admin')['name'],
                "message" => $message
            ];

            $this->response->destroyResponse();
            require resource_view('dashboard');
        }
        return true;
    }

    public function login(){
        $message = $this->response->getResponse();
        $data = [
            "page_title" => "Login",
            "message" => $message
        ];

        $this->response->destroyResponse();
        require resource_view('login');

        return true;
    }

    public function register()
    {
        $message = $this->response->getResponse();
        $data = [
            "page_title" => "Register",
            "message" => $message
        ];

        $this->response->destroyResponse();
        require resource_view('register');

        return true;
    }

}