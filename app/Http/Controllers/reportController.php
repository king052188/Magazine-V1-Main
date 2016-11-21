<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class reportController extends Controller
{
    public function viewSalesReport() {

        // $id = 10;
        // $key = "ABC12abc";
        // $uid = md5($key . $id);

        // dd($uid);

        $result = DB::SELECT("
            SELECT magazine.magname, CONCAT(clients.cfirstname, ' ', clients.cmname, ' ', clients.csurname) AS client_name,
            contract.contid AS contract_num,
            contract.created_at AS date_contract,
            contract.updated_at AS date_issued,
            package.package_name AS ad_size,
            price.amount_x1 AS ad_cost, 
            CONCAT(salesman.srepfname, ' ', salesman.sremname, ' ', salesman.srepsurname) AS sales_rep, '12.5' AS count_percent,
            (  price.amount_x1 * 0.125 ) AS comm_amount, price.amount_x1 - (  price.amount_x1 * 0.125 ) AS gross_sales, contract.remarks
            
            FROM contract_table AS contract
            INNER JOIN magazine_table AS magazine
            ON contract.magcode = magazine.magcode
            INNER JOIN client_table AS clients
            ON contract.clientcode = clients.clientcode
            INNER JOIN salesrep_table AS salesman
            ON contract.srepcode = salesman.srepcode
            INNER JOIN price_table AS price
            ON contract.adsize = price.Id
            INNER JOIN price_package_table AS package
            ON price.package_id = package.id
        ");

        return view('/reports/sales', compact('result'));
    }
}
