<?php


/*
 *  Created         = Sat. November 12, 2016
 *  Developer       = King Paulo Aquino
 *  Position        = IT/Software Manager
 *  Contact         = me@kpa21.info / +63 917 771 5380 / www.kpa21.info
 *
 *  Library         = KPAHelper v1
 *  Published       = Sat. November 12, 2016
 *  Modified        = Sat. November 12, 2016
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;

class VMKhelper extends Controller
{
    /*
       get price by passing boolean value

       member = true
       non-member = false
   */

    public static function check_cookies() {
        $request = new Request();

        $value = $request->cookie('role');

        return $value;
    }

    public static function get_price_by_type($IsMember = false) {

        $IsMemberPayment = $IsMember ? 1 : 2;

        $prices_array = [];

        $get_criteria = DB::select("SELECT * FROM price_criteria_table WHERE status = 2;");

        if($get_criteria != null) {

            for( $i = 0; $i < count($get_criteria); $i++ ) {

                $packages_id = $get_criteria[$i]->Id;
                $packages_name = $get_criteria[$i]->name;
                $get_packages = DB::select("
                                    SELECT package.package_name, price.amount_x1, price.amount_x2_more 
                                    FROM price_package_table AS package
                                    INNER JOIN price_table AS price
                                    ON package.Id = price.package_id
                                    WHERE price.criteria_id = {$packages_id}
                                    AND price.type = {$IsMemberPayment};");

                $prices_array[] = [
                    $packages_name => $get_packages
                ];

            }

            return $prices_array;

        }
    }

    public static function get_client_type($Id = 0) {

        if($Id == 0) {
            $data = DB::select("SELECT * FROM client_reference_table WHERE status = 2;");
        }
        else {
            $data = DB::select("SELECT * FROM client_reference_table WHERE status = {$Id};");
        }

        return $data;

    }

    public static function get_contract_lists_of_report($contractNumberOrUid = null) {

        $query = "";
        if($contractNumberOrUid != null) {
            $query = "WHERE contract.Id = '{$contractNumberOrUid}' OR contract.contract_num = '{$contractNumberOrUid}'";
        }

        $data = DB::select("
        SELECT 
            contract.*, 
            (
                SELECT CONCAT(srepfname, ' ', sremname, ' ', srepsurname)
                FROM sales_rep_table 
                WHERE Id = contract.sales_rep_code 
            ) AS SalesRepName,
            (
                SELECT CONCAT(a.first_name, ' ', a.middle_name, ' ', a.last_name) 
                FROM client_contacts_table AS a
                INNER JOIN client_table AS b
                ON a.client_id = b.Id
                WHERE a.Id = contract.client_id
                AND b.type = 1
            ) AS ClientName,
            (
                SELECT CONCAT(a.first_name, ' ', a.middle_name, ' ', a.last_name) 
                FROM client_contacts_table AS a
                INNER JOIN client_table AS b
                ON a.client_id = b.Id
                WHERE a.Id = contract.agency_id
                AND b.type = 2
            ) AS AgencyName,
            COUNT(*) AS NumberOfIssue, 
            SUM(m_issue.amount) AS TotalOfPayment
        FROM 
            magazine_issue_transaction_table AS m_issue
        INNER JOIN
            magazine_transaction_table AS m_trans
        ON
            m_issue.magazine_trans_id = m_trans.Id
        INNER JOIN
            contract_table AS contract
        ON
            m_trans.contract_id = contract.Id
        ". $query ."
        GROUP BY 
            contract.Id, contract.contract_num, contract.sales_rep_code, contract.client_id, contract.agency_id, contract.status, contract.updated_at, contract.created_at;

        ");

        return $data;

    }


    /*
        get price by passing boolean value

        digits = total length
    */

    public static function get_new_uid($digits = 16){
        $i = 0; //counter
        $pin = ""; //our default pin is blank.
        while($i < $digits){
            //generate a random number between 0 and 9.
            $pin .= mt_rand(0, 9);
            $i++;
        }

        return array(
            "new_uid" => (int)$pin
        );
    }

    public static function get_new_contract() {

        do {

            $data = substr(str_shuffle(str_repeat('QWERTYUIOPASDFGHJKLZXCVBNM',5)),0, 2);

            $data = date("ym") . $data . substr(str_shuffle(str_repeat('0123456789',5)),0,4);

//            $n_uid = array("id" => date("Ymdms") ."". strtoupper(uniqid()));

            $n_uid = array("id" => $data);

            $data = DB::select("SELECT * FROM booking_sales_table WHERE trans_num = '{$n_uid["id"]}';");

        }while( count($data) > 0 );

        return $n_uid;
    }

    public static function get_logo_uid($isCompany = true) {
        do {

            $n_uid = array(
                    "id_company" => date("Ymdms") ."". strtoupper(uniqid()),
                    "id_magazine" => date("Ymdms") ."". strtoupper(uniqid())
            );

            if($isCompany)
            {
                $data = DB::select("SELECT * FROM magazine_company_table WHERE logo_uid = '{$n_uid["id_company"]}';");
            }else{
                $data = DB::select("SELECT * FROM magazine_table WHERE logo_uid = '{$n_uid["id_magazine"]}';");
            }
        }while( count($data) > 0 );

        return $n_uid;
    }

    public static function get_new_reference() {
        $n_uid = array("number" => date("Ymdms") ."". strtoupper(uniqid()));
        return $n_uid;
    }

    public static function get_random_password($value = null) {
        $random = mt_rand(10, 727379969);
        if($value == null) {
            $value = $random;
        }
        $result = md5('@BC12abc' . $value);
        return array("new_password" => $value, "hash_password" => $result);
    }

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

    /*
       check if manage client existing to un-manage or has 2 agents

       agentCode = pass agent code if logged in or selected

       clientCode = pass client code you want to check

       return function is boolean
   */

    public static function check_if_already_grad($agentCode, $clientCode) {

        $sql = "
            SELECT * 
            FROM agency_transaction_table
            WHERE agency_code = '{$agentCode}'
            AND client_code = '{$clientCode}'
        ";

        $data = DB::select($sql);

        if( count($data) > 0 ) {
            return true;
        }
        return false;

    }

    
}
