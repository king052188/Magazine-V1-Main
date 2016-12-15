<?php
/*
 *  Created         = Sat. November 27, 2016
 *  Developer       = King Paulo Aquino
 *  Position        = IT/Software Manager
 *  Contact         = me@kpa21.info / +63 917 771 5380 / www.kpa21.info
 *
 *  Library         = KPAHelper v1
 *  Published       = Sat. November 27, 2016
 *  Modified        = Sat. November 27, 2016
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssemblyClass extends Controller
{
    //

    public static function get_config_api() {

        $data = \Config::get('database.connections');

        $kpa = $data['kpa'];

        return $kpa;
    }

    public static function get_api_url() {
        
        $kpa = AssemblyClass::get_config_api();

        return $kpa['host'] .':'. $kpa['port'];
    }

    public static function get_reports_api() {
        return [
            "Url_Port"                      => AssemblyClass::get_api_url(),
            "Url_Client_Dashboard"          => AssemblyClass::get_api_url() ."/kpa-client-dashboard/?trans=", // pass a trans_num
            "Url_Insertion_Order"           => AssemblyClass::get_api_url() ."/kpa/work/transaction/generate/pdf/", // pass a trans_num
            "Url_Logo_Uploader"             => AssemblyClass::get_api_url() ."/kpa-uploader/index.php?", // pass a trans_num
        ];
    }

    public static function check_cookies() {
        if(count($_COOKIE) <= 3) {
            return false;
        }
        return true;
    }
}
