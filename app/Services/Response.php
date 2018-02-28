<?php
/**
 * Created by PhpStorm.
 * User: eazypen
 * Date: 1/28/2018
 * Time: 11:13 PM
 */

namespace App\Services;


class Response
{
    public function setResponse($response=array())
    {
        $_SESSION['response'] = $response;
    }

    public function getResponse()
    {
        return isset($_SESSION['response']) ? $_SESSION['response'] : [];
    }

    public function destroyResponse(){
        unset($_SESSION['response']);
    }
}