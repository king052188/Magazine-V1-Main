<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class reportController extends Controller
{
    public static $API_URL = "http://api.magazine.com/kpa/work/booking/report/";

    public function viewSalesReport() {

        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }
        
        $publication = DB::table('magazine_table')->where('status', '=', 2)->orderBy('magazine_name', 'ASC')->get();
        $clients = DB::table('client_table')->where('status', '=', 2)->orderBy('company_name', 'ASC')->get();
        $sales_rep = DB::table('user_account')->where('status', '=', 2)->orderBy('first_name', 'ASC')->get();

        $nav_dashboard = "";
        $nav_clients = "";
        $nav_publisher = "";
        $nav_publication = "";
        $nav_sales = "";
        $nav_payment = "";
        $nav_reports = "active";
        $nav_users = "";

        return view('/reports/sales', compact('publication', 'clients', 'sales_rep', 'nav_dashboard','nav_clients', 'nav_publisher', 'nav_publication', 'nav_sales','nav_payment','nav_reports','nav_users'));
    }

    public function get_filter_data($magazine_type_booking, $f_publication = 0, $f_sales_rep = 0, $f_client = 0, $f_issue = 0, $f_year = 0, $f_status = 0, $f_date_from = null, $f_date_to = null, $f_operator = 0)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $inner_join = null;
        $field = null;
        $filters = null;
        $tbl_trans = "INNER JOIN magazine_transaction_table AS trans ON booked.Id = trans.transaction_id";

        if($magazine_type_booking != "0"){
            $filters .= "WHERE mag.magazine_type = {$magazine_type_booking}";
        }
        else {
            $filters .= "WHERE mag.magazine_type LIKE '%'";
        }

        if($f_publication != "0"){
            $filters .= " AND mag.Id = {$f_publication}";
        }
        else {
            $filters .= " AND mag.Id LIKE '%'";
        }

        if($_COOKIE['role'] != 3)
        {
            if($f_sales_rep != "0"){
                $filters .= " AND booked.sales_rep_code = {$f_sales_rep}";
            }
            else {
                $filters .= " AND booked.sales_rep_code LIKE '%'";
            }
        }
        else
        {
            $filters .= " AND booked.sales_rep_code = {$_COOKIE['Id']}";
        }

        if($f_client != "0") {
            $filters .= " AND booked.client_id = {$f_client}";
        }
        else {
            $filters .= " AND booked.client_id LIKE '%'";
        }

        if($f_issue != "0") {

            if((int)$magazine_type_booking > 1) {
                $d = explode(":", $f_issue);
                $tbl_trans = "INNER JOIN magazine_digital_transaction_table AS trans ON booked.Id = trans.magazine_trans_id";
                $field = " CONCAT(trans.month_id, '-', trans.week_id) AS issue,";
                if($f_issue != "0:0") {
                    $filters .= " AND trans.month_id = {$d[0]} AND trans.week_id = {$d[1]}";
                }
            }
            else {
                $tbl_trans = "INNER JOIN magazine_transaction_table AS trans ON booked.Id = trans.transaction_id";
                $inner_join = "INNER JOIN magazine_issue_transaction_table AS issue ";
                $inner_join .= "ON trans.Id = issue.magazine_trans_id ";
                $field = " issue.quarter_issued AS issue,";
                $filters .= " AND issue.quarter_issued = {$f_issue}";
            }
        }
        else {
            $field = " (-1) AS issue,";
        }

        if($f_year != "0") {
            $filters .= " AND YEAR(booked.created_at) = {$f_year}";
        }
        else {
            $filters .= " AND YEAR(booked.created_at) LIKE '%'";
        }

        if($f_status != "0") {
            $filters .= " AND booked.status = {$f_status}";
        }
        else {
            $filters .= " AND booked.status LIKE '%'";
        }

        if((int)$f_operator == 1) //operator equal
        {
            if($f_date_from != "null"){
                $filters .= " AND DATE_FORMAT(booked.created_at, '%Y-%m-%d') = DATE_FORMAT('{$f_date_from}', '%Y-%m-%d')";
            }
        }
        elseif((int)$f_operator == 2) //operator between
        {
            if($f_date_from != "null" AND $f_date_to != "null"){
                $filters .= " AND DATE_FORMAT(booked.created_at, '%Y-%m-%d') BETWEEN DATE_FORMAT('{$f_date_from}', '%Y-%m-%d') AND DATE_FORMAT('{$f_date_to}', '%Y-%m-%d')";
            }
        }

        $query = "
            SELECT 
                booked.Id,
                trans.Id AS trans_id,
                booked.client_id,
                mag.Id as pub_uid,
                mag.magazine_type,
                (SELECT is_member FROM client_table WHERE Id = booked.client_id) AS is_member,
                booked.trans_num,
                (null) AS invoice_num,
                ( SELECT magazine_name FROM magazine_table WHERE Id = trans.magazine_id ) AS mag_name,
                ( SELECT magazine_country FROM magazine_table WHERE Id = trans.magazine_id ) AS mag_country,
                ( SELECT CONCAT(first_name, ' ', last_name) FROM user_account WHERE Id = booked.sales_rep_code ) AS sales_rep_name,
                ( SELECT company_name FROM client_table WHERE Id = booked.client_id AND status = 2 AND type != 2 ) AS client_name,
                ( SELECT COUNT(*) AS lineItems FROM magazine_issue_transaction_table WHERE magazine_trans_id = trans.Id ) AS line_item,
                ( SELECT CASE WHEN SUM(line_item_qty) > 0 THEN SUM(line_item_qty) ELSE 0 END AS lineItems FROM magazine_issue_transaction_table WHERE magazine_trans_id = trans.Id ) AS qty,
                ( SELECT SUM(amount) AS lineItems FROM magazine_issue_transaction_table WHERE magazine_trans_id = trans.Id ) AS amount,
                ( SELECT (amount - (amount * (discount_percent / 100))) new_amount FROM discount_transaction_table WHERE trans_id = booked.trans_num  AND type = 1 AND status = 2 ) AS new_amount,{$field}
                DATE_FORMAT(booked.created_at, '%Y') AS issue_year,
                booked.status,
                booked.created_at
            FROM booking_sales_table AS booked
            {$tbl_trans}
            INNER JOIN magazine_table as mag
            ON mag.Id = trans.magazine_id
            {$inner_join}
            {$filters}
        ";

        $booking = DB::SELECT($query);

        $items = COUNT($booking);
        if($items > 0)
        {
            return array("Code" => 200, "overall_total" => number_format($items, 2), "data" => $booking);
        }
        return array("Code" => 404, "overall_total" => number_format(0, 2), "data" => null);
    }

    public function get_filter_data_invoice($magazine_type_invoice, $i_invoice_number, $i_publication, $i_issue, $i_year, $i_sales_rep, $i_date_from, $i_date_to, $i_operator)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $filters = null;
        if((int)$magazine_type_invoice == 0) {
            $filters .= "WHERE aa.issue LIKE '%'";
        }
        else if((int)$magazine_type_invoice == 1){
            $filters .= "WHERE aa.issue > 0";

        }else{
            $filters .= "WHERE aa.issue = 0";
        }

        if($i_invoice_number != 0){
            $filters .= " AND invoice_num = '{$i_invoice_number}'";
        }else{
            $filters .= " AND invoice_num LIKE '%'";
        }

        if($i_publication != 0){
            $filters .= " AND xx.Id = {$i_publication}";
        }else{
            $filters .= " AND xx.Id LIKE '%'";
        }

        if($i_year != 0){
            $filters .= " AND YEAR(aa.created_at) = '{$i_year}'";
        }else{
            $filters .= " AND aa.created_at LIKE '%'";
        }

        if($_COOKIE['role'] != 3)
        {
            if($i_sales_rep != 0){
                $filters .= " AND aa.account_executive = {$i_sales_rep}";
            }else{
                $filters .= " AND aa.account_executive LIKE '%'";
            }
        }
        else
        {
            $filters .= " AND aa.account_executive = {$_COOKIE['Id']}";
        }

        if($i_operator == 1) //operator equal
        {
            if($i_date_from != 0){
                $filters .= " AND DATE_FORMAT(aa.created_at, '%Y-%m-%d') = DATE_FORMAT('{$i_date_from}', '%Y-%m-%d')";
            }else{
                $filters .= " AND aa.created_at LIKE '%'";
            }
        }
        elseif($i_operator == 2) //operator between
        {
            if($i_date_from != 0 AND $i_date_to != 0){
                $filters .= " AND DATE_FORMAT(aa.created_at, '%Y-%m-%d') BETWEEN DATE_FORMAT('{$i_date_from}', '%Y-%m-%d') AND DATE_FORMAT('{$i_date_to}', '%Y-%m-%d')";

            }else{
                $filters .= " AND aa.created_at LIKE '%'";
            }
        }

        $invoice = DB::SELECT("
            SELECT 
            aa.*, DATE_FORMAT(aa.created_at, '%Y-%m-%d') as invoice_created, DATE_FORMAT(aa.due_date, '%Y-%m-%d') as invoice_due_date, DATE_FORMAT(aa.due_date, '%Y') as invoice_year, concat_ws('',bb.first_name, ' ', bb.last_name) as sales_rep_name, xx.Id as mag_uid, xx.magazine_name as mag_name
            FROM invoice_table as aa
            INNER JOIN user_account as bb ON bb.Id = aa.account_executive
            INNER JOIN booking_sales_table as zz ON zz.trans_num = aa.booking_trans
            INNER JOIN magazine_transaction_table as yy ON yy.transaction_id = zz.Id
            INNER JOIN magazine_table as xx ON xx.Id = yy.magazine_id
            
            {$filters}
            
            ");

        $items = COUNT($invoice);
        if($items > 0)
        {
            return array("Code" => 200, "overall_total" => number_format($items, 2), "data" => $invoice);
        }

        return array("Code" => 404, "overall_total" => number_format(0, 2), "data" => null);
    }


    public function do_curl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = json_decode(curl_exec($ch), true);
        curl_close($ch);
        return $data;
    }
}
