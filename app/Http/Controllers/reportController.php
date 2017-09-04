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

        $filters = null;

        if($magazine_type_booking != "0"){
            $filters .= "mag.magazine_type = {$magazine_type_booking}";
        }

        if($f_publication != "0"){
            $filters .= " AND mag.Id = {$f_publication}";
        }

        if($_COOKIE['role'] != 3)
        {
            if($f_sales_rep != "0"){
                $filters .= " AND booked.sales_rep_code = {$f_sales_rep}";
            }
        }
        else
        {
            $filters .= " AND booked.sales_rep_code = {$_COOKIE['Id']}";
        }

        if($f_client != "0") {
            $filters .= " AND booked.client_id = {$f_client}";
        }

        if($f_issue != "0") {
            $filters .= " AND issue.quarter_issued = {$f_issue}";
        }

        if($f_year != "0") {
            $filters .= " AND YEAR(created_at) = {$f_year}";
        }

        if($f_status != "0") {
            $filters .= " AND booked.status = {$f_status}";
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

        $booking = DB::SELECT("
            SELECT 
                booked.Id,
                trans.Id AS trans_id,
                booked.client_id,
                mag.Id as pub_uid,
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
                ( SELECT (amount - (amount * (discount_percent / 100))) new_amount FROM discount_transaction_table WHERE trans_id = booked.trans_num  AND type = 1 AND status = 2 ) AS new_amount,
                DATE_FORMAT(booked.created_at, '%Y') AS issue_year,
                booked.status,
                booked.created_at
            FROM booking_sales_table AS booked
            INNER JOIN magazine_transaction_table AS trans
            ON booked.Id = trans.transaction_id
            INNER JOIN magazine_table as mag
            ON mag.Id = trans.magazine_id
           
            {$filters}
            ");

        $list_data[] = [];
        $items = COUNT($booking);
//        for($i = 0; $i < $items; $i++) {
//            $total_amount = $this->do_curl(reportController::$API_URL . $booking[$i]->trans_id . "/1");
//            if($i == 0) {
//                unset($list_data);
//            }
//            $data = array(
//                "ID" => $booking[$i]->Id,
//                "TRANS_ID" => $booking[$i]->trans_id,
//                "PUD_ID" => $booking[$i]->pub_uid,
//                "CLIENT_ID" => $booking[$i]->client_id,
//                "MEMBER" => $booking[$i]->is_member,
//                "TRANS_NUM" => $booking[$i]->trans_num,
//                "INVOICE_NUM" => $booking[$i]->invoice_num,
//                "MAG_NAME" => $booking[$i]->mag_name,
//                "MAG_COUNTRY" => $booking[$i]->mag_country,
//                "SALES_PERSON" => $booking[$i]->sales_rep_name,
//                "CLIENT_NAME" => $booking[$i]->client_name,
//                "LINE_ITEM" => $booking[$i]->line_item,
//                "QTY" => (int)$booking[$i]->qty,
//                "AMOUNT" => $total_amount["Total"],
//                "STATUS" => $booking[$i]->status,
//                "CREATED" => $booking[$i]->created_at,
//            );
//
//            $list_data[] = $data;
//        }

        if($items > 0)
        {
            return array("Code" => 200, "overall_total" => number_format($items, 2), "data" => $booking);
        }

        return array("Code" => 404, "data" => null);

    }

    public function get_filter_data_invoice($magazine_type_invoice, $i_invoice_number, $i_publication, $i_issue, $i_year, $i_sales_rep, $i_date_from, $i_date_to, $i_operator)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        if($magazine_type_invoice == 0){
            $filter_mag_type = "xx.magazine_type LIKE '%'";
        }else{
            $filter_mag_type = "mag.magazine_type = {$magazine_type_invoice}";
        }

        if($i_invoice_number != 0){
            $i_invoice_number_tran = "invoice_num = '{$i_invoice_number}'";
        }else{
            $i_invoice_number_tran = "invoice_num LIKE '%'";
        }

        if($i_publication != 0){
            $i_publication_tran = "xx.Id = {$i_publication}";
        }else{
            $i_publication_tran = "xx.Id LIKE '%'";
        }

        if($i_issue != 0){
            $i_issue_tran = "issue = {$i_issue}";
        }else{
            $i_issue_tran = "issue LIKE '%'";
        }

        if($i_year != 0){
            $i_year_tran = "YEAR(aa.created_at) = '{$i_year}'";
        }else{
            $i_year_tran = "aa.created_at LIKE '%'";
        }

        if($_COOKIE['role'] != 3)
        {
            if($i_sales_rep != 0){
                $i_sales_rep_tran = "aa.account_executive = {$i_sales_rep}";
            }else{
                $i_sales_rep_tran = "aa.account_executive LIKE '%'";
            }
        }
        else
        {
            $i_sales_rep_tran = "aa.account_executive = {$_COOKIE['Id']}";
        }

        if($i_operator == 1) //operator equal
        {
            if($i_date_from != 0){
                $i_date_from_tran = "DATE_FORMAT(aa.created_at, '%Y-%m-%d') = '{$i_date_from}'";
            }else{
                $i_date_from_tran = "aa.created_at LIKE '%'";
            }
        }
        elseif($i_operator == 2) //operator between
        {
            if($i_date_from != 0 AND $i_date_to != 0){
                $i_date_from_tran = "DATE_FORMAT(aa.created_at, '%Y-%m-%d') >= '{$i_date_from}' AND DATE_FORMAT(aa.created_at, '%Y-%m-%d') <= '{$i_date_to}'";
            }else{
                $i_date_from_tran = "aa.created_at LIKE '%'";
            }
        }

        $filter_process = "WHERE " . $filter_mag_type . ' AND ' . $i_invoice_number_tran . ' AND ' . $i_publication_tran . ' AND ' . $i_issue_tran . ' AND ' . $i_year_tran . ' AND ' . $i_sales_rep_tran . ' AND ' . $i_date_from_tran;

        $invoice = DB::SELECT("
            SELECT 
            aa.*, aa.created_at as invoice_created, concat_ws('',bb.first_name, ' ', bb.last_name) as sales_rep_name, xx.Id as mag_uid, xx.magazine_name as mag_name
            FROM invoice_table as aa
            INNER JOIN user_account as bb ON bb.Id = aa.account_executive
            INNER JOIN booking_sales_table as zz ON zz.trans_num = aa.booking_trans
            INNER JOIN magazine_transaction_table as yy ON yy.transaction_id = zz.Id
            INNER JOIN magazine_table as xx ON xx.Id = yy.magazine_id
            
            {$filter_process}
            
            ");

        if(COUNT($invoice) > 0)
        {
            for($i = 0; $i < COUNT($invoice); $i++)
            {
                $date_created = \Carbon\Carbon::parse($invoice[$i]->invoice_created);

                $invoice_result[] = array(
                    "reports_set" => "Invoice",
                    "invoice_number" => $invoice[$i]->invoice_num,
                    "publication" => $invoice[$i]->mag_name,
                    "issue" => $invoice[$i]->issue,
                    "year" => $date_created->format('Y'),
                    "executive_account" => $invoice[$i]->sales_rep_name,
                    "invoice_created" => $date_created->format('F d, Y'),
                    "due_date" => $date_created->format('F d, Y')
                );
            }

            return array("Code" => 200, "data" => $invoice_result);
        }

        $invoice_result = 0;
        return array("Code" => 404, "data" => $invoice_result);

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
