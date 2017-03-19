<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Cache;

class dashboardController extends Controller
{
    public function dashboard() {

        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $nav_dashboard = "active";
        $nav_clients = "";
        $nav_publisher = "";
        $nav_publication = "";
        $nav_sales = "";
        $nav_payment = "";
        $nav_reports = "";
        $nav_users = "";

        return view('/dashboard', compact('nav_dashboard','nav_clients', 'nav_publisher', 'nav_publication', 'nav_sales','nav_payment','nav_reports','nav_users'));
    }

}
