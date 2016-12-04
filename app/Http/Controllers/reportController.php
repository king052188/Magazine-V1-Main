<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class reportController extends Controller
{
    public function viewSalesReport() {

        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        return view('/reports/sales');
    }
}
