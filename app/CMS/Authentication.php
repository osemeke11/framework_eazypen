<?php
/**
 * Created by PhpStorm.
 * User: eazypen
 * Date: 1/15/2018
 * Time: 6:08 AM
 */

namespace App\CMS;

use App\Data\DB;
use App\Auth\Authenticator;
use App\Services\SendMail;


class Authentication
{

    private $auth;
    private $db;
    private $mailer;

    function __construct()
    {
        $this->db = new DB();
        $this->auth = new Authenticator($this->db);
        $this->mailer = new SendMail();

    }

    public function login($email, $password)
    {
        $user = $this->auth->login($email, $password);

        if(is_null($user)) {
            return "We couldn't find credentials matching our records";
        }

        return header("Location:" . url('admin'));

    }

    public function register($name, $email, $password)
    {
        $this->db->addData("admin", [
            "admin_email" => $email,
            "admin_name" => $name,
            "password" => $this->auth->hashPassword($password)
        ]);

        $this->sendConfirmationEmail($email);

        return header("Location:" . url('sign-in'));

    }

    public function logout()
    {
        $this->auth->logout();

        return header("Location:" . url('sign-in'));
    }

    public function authUser()
    {
        return $this->auth->user();
    }

    public function sendConfirmationEmail($email)
    {
        $user = $this->auth->fetchUserByUsername($email);

        $confirmationToken = $this->auth->getConfirmationToken($user, 'signup');

        $host = $_SERVER['HTTP_HOST'];

        $url = "http://$host/confirm?token=$confirmationToken";

        $message = "Hey " . $user->getName() . ", <br><br>Please confirm your account by visiting $url <br><br> Regards";

        $this->mailer->sendMail($user->getEmail(),  "Welcome to our Church site", $message, "The Love Of God Christ Church");
    }

    public function confirmAccount($token)
    {
        $user = $this->auth->fetchUserForConfirmation($token, 'signup');

        if (!$user) {
            http_response_code(400);
            echo "The token is not valid";
            exit();
        }

        $this->db->updateData('admin', "active = 1", "id ='" . $user->id ."'");

        echo "Account Verified Successfully!!";

        return header("Location:" . url('sign-in'));
    }

    public function forgotPassword($email)
    {
        $user = $this->auth->fetchUserByUsername($email);

        $confirmationToken = $this->auth->getConfirmationToken($user, 'reset-password', true);

        $host = $_SERVER['HTTP_HOST'];
        $url = "http://$host/reset?token=$confirmationToken";


        $message = "Hey " . $user->getName() . ", <br><br>You may reset your password by visiting $url <br><br> Regards";

        $this->mailer->sendMail($user->getEmail(),  "Password reset request", $message, "The Love Of God Christ Church");
    }

    public function resetPassword($token, $email, $password)
    {
        $user = $this->auth->fetchUserByUsername($email);

        $user = $this->auth->fetchUserForConfirmation($token, 'reset-password', true);

        if (!$user) {
            http_response_code(400);
            $errormsg = "The token is not valid";

            return json_encode([
                "code" => 400,
                "status" => 'error',
                "message" => "The token is not valid",
                "redirect" => null

            ]);
            //exit();
        }

        $this->db->updateData('admin', "password = '" . $this->auth->hashPassword($password) . "'", "id ='" . $user->id ."'");

//        echo "Password Reset Successfully!!";

        return json_encode([
            "code" => 200,
            "status" => 'success',
            "message" => "Password Reset Successfully!!",
            "redirect" => url("sign-in")

        ]);

//        return header("Location:" . url('sign-in'));

    }
}