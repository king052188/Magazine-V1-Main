<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Illuminate\Support\Facades\Cache;

class loginController extends Controller
{
    public static function get_new_password($value = null) {
        $password = $value;
        if($value == null) {
            $password = "123456";
        }
        return array(
            "Password" => $password,
            "Hash" => md5("ABC12abc" . $password)
        );
    }

    public function login()
    {
        return view("login.login");
    }

    public function login_process($username, $password)
    {
        $user_info = DB::select("SELECT * FROM user_account WHERE username = '{$username}'");
        if($user_info == null) {
            return array("login_status" => 404); //username not found
        }

        $check = $this->get_new_password($password);

        if($user_info[0]->password != $check['Hash']) {
            return array("login_status" => 403); //password Not Match
        }

        return  array(
            "login_status" => 200, //Success
            "Id" => $user_info[0]->Id,
            "username" => $user_info[0]->username,
            "password" => $user_info[0]->password,
            "role" => $user_info[0]->role,
            "email" => $user_info[0]->email,
            "mobile" => $user_info[0]->mobile,
            "status" => $user_info[0]->status
        );
    }

    public function logout_process()
    {
        Cache::flush();
        setcookie('Id','',time()-3600);
        setcookie('role','',time()-3600);
        return redirect("/login");
    }
}
