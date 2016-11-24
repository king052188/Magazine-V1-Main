<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function dashboard() {

//        return $_COOKIE['Role'];

//        $cookies = VMKhelper::check_cookies();
//
//        if($cookies == null) {
//            return redirect('/logout_process');
//        }

        return view('/dashboard');
    }
}
