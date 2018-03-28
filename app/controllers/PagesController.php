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
}