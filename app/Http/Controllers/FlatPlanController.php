<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FlatPlanController extends Controller
{
    //

    public function init() {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

       
    }
    
    public function api_get_flat_plan_data($mag_id){
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $data = DB::SELECT("SELECT * FROM flat_plan_table WHERE magazine_id = {$mag_id}");
        if(COUNT($data) > 0){
            return array("Status" => 200, "Result" => $data);
        }

        return array("Status" => 404, "Result" => "No Data Available");
    }

}
