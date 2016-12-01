<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Cache;

class dashboardController extends Controller
{
    public function dashboard() {


        return view('/dashboard');
    }

}
