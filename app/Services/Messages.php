<?php
/**
 * Created by PhpStorm.
 * User: eazypen
 * Date: 1/18/2018
 * Time: 1:14 PM
 */

namespace App\CMS;


use App\Data\DB;
use App\Services\FormValidate;

class Messages
{

    private $form;
    private $db;

    function __construct()
    {
        $this->form  =  new FormValidate();
        $this->db  =  new DB();
    }


    public function add($name, $message)
    {
        $name = $this->form->checkEmpty(test_input($name), "Name");
        $message = $this->form->messageDetails(test_input($message), 5000, 5);
        $url = createSlug($name);
        $admin = 'admin';
        $errors = "";
        if(!empty($this->form->error)){
            foreach ($this->form->error as $error) {
                $errors .= '<li>' . $error . '</li>';
            }

            return $errors;
        }
        else{
            $data = [
                'title' => $name,
                'msg_body' => $message,
                'author' => $admin,
                'url' => $url
            ];

            if($this->db->addData("messages", $data) !== false){
                return "Added Successfully!";
            }

            return false;
        }
    }

    public function delete($message)
    {
        if($this->db->deleteData("messages", "id = '$message'")){
            return "Message Deleted Successfully";
        }

        return false;
    }


    public function edit($name, $message, $id)
    {
        $name = $this->form->checkEmpty(test_input($name), "Name");
        $message = $this->form->messageDetails(test_input($message), 5000, 5);
        $url = createSlug($name);
        $errors = "";
        if(!empty($this->form->error)){
            foreach ($this->form->error as $error) {
                $errors .= '<li>' . $error . '</li>';
            }
            return $errors;
        }
        else{
            $condition = "title = '$name', msg_body = '$message', url = '$url'";
            if($this->db->updateData("messages", $condition, "id = '$id'") !== false){
                return "Update Successfully!";
            }
        }
    }
}