<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlatPlanController extends Controller
{
    //

    public function init() {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

       
    }

}
