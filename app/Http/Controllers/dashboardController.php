<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function dashboard() {

//        return $_COOKIE['Role'];

        return view('/dashboard');
    }
}
