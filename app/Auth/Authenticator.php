<?php
/**
 * Created by PhpStorm.
 * User: eazypen
 * Date: 1/15/2018
 * Time: 4:44 AM
 */

namespace App\Auth;


use App\Auth\User as MyUser;
use App\Data\DB;
use App\Services\Converter;
use Jasny\Auth;
use Jasny\Auth\User;
use Jasny\Auth\Sessions;
use Jasny\Auth\Confirmation;

class Authenticator extends Auth
{
    use Sessions, Confirmation;

    public function getConfirmationSecret()
    {
        return getenv('AUTH_CONFIRMATION_SECRET');
    }

    private $db;

    function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function fetchUserById($id)
    {
        $user = $this->db->getAllDataWhere("admin", "id = " . $id)[0];

        $user['username'] = $user['admin_email'];
        $user['name'] = $user['admin_name'];

        unset($user['admin_email']);
        unset($user['admin_name']);

        return Converter::toObject($user, new MyUser());
    }

    public function fetchUserByUsername($username)
    {
        $user = $this->db->getAllDataWhere("admin","admin_email = '" . $username . "'")[0];

        $user['active'] = 1;
        $user['username'] = $user['admin_email'];
        $user['name'] = $user['admin_name'];

        return Converter::toObject($user, new MyUser());
    }
}