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

    public static function get_reports_api() {
        return [
            "Url_Port" => "localhost:80"
        ];
    }
}
