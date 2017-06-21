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

    public function get_filter_data($magazine_type_booking, $f_publication, $f_sales_rep, $f_client, $f_status, $f_date_from, $f_date_to, $f_operator)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        if($magazine_type_booking == 0){
            $filter_mag_type = "mag.magazine_type LIKE '%'";
        }else{
            $filter_mag_type = "mag.magazine_type = {$magazine_type_booking}";
        }

        if($f_publication != 0){
            $filter_publication_tran = "mag.Id = {$f_publication}";
        }else{
            $filter_publication_tran = "mag.Id LIKE '%'";
        }

        if($_COOKIE['role'] != 3)
        {
            if($f_sales_rep != 0){
                $filter_sales_rep_tran = "booked.sales_rep_code = {$f_sales_rep}";
            }else{
                $filter_sales_rep_tran = "booked.sales_rep_code LIKE '%'";
            }
        }
        else
        {
            $filter_sales_rep_tran = "booked.sales_rep_code = {$_COOKIE['Id']}";
        }

        if($f_client != 0){
            $filter_client_tran = "booked.client_id = {$f_client}";
        }else{
            $filter_client_tran = "booked.client_id LIKE '%'";
        }

        if($f_status != 0){
            $filter_status_tran = "booked.status = {$f_status}";
        }else{
            $filter_status_tran = "booked.status LIKE '%'";
        }

        if($f_operator == 1) //operator equal
        {
            if($f_date_from != 0){
                $filter_date_from = "DATE_FORMAT(booked.created_at, '%Y-%m-%d') = '{$f_date_from}'";
            }else{
                $filter_date_from = "booked.created_at LIKE '%'";
            }
        }
        elseif($f_operator == 2) //operator between
        {
            if($f_date_from != 0 AND $f_date_to != 0){
                $filter_date_from = "DATE_FORMAT(booked.created_at, '%Y-%m-%d') >= '{$f_date_from}' AND DATE_FORMAT(booked.created_at, '%Y-%m-%d') <= '{$f_date_to}'";
            }else{
                $filter_date_from = "booked.created_at LIKE '%'";
            }
        }

        $filter_process = "WHERE " . $filter_mag_type . ' AND ' . $filter_publication_tran . ' AND ' . $filter_sales_rep_tran . ' AND ' . $filter_client_tran . ' AND ' . $filter_status_tran . ' AND ' . $filter_date_from;
        
        $booking = DB::SELECT("
            SELECT 

                booked.Id,
                
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
                
                booked.status,
                
                booked.created_at
                    
            FROM booking_sales_table AS booked
            
            INNER JOIN magazine_transaction_table AS trans
            
            ON booked.Id = trans.transaction_id
            
            INNER JOIN magazine_table as mag

            ON mag.Id = trans.magazine_id
            
            {$filter_process}
            
            ");

        if(COUNT($booking) > 0)
        {
            for($i = 0; $i < COUNT($booking); $i++)
            {
                $date_created = \Carbon\Carbon::parse($booking[$i]->created_at);
                if($booking[$i]->status == 1){
                    $status = "Pending";
                }elseif($booking[$i]->status == 2){
                    $status = "For Approval";
                }elseif($booking[$i]->status == 3){
                    $status = "Approved";
                }elseif($booking[$i]->status == 5){
                    $status = "Void";
                }elseif($booking[$i]->status == 6){
                    $status = "Approved/Invoiced";
                }
                $amount = $booking[$i]->new_amount != null ? $booking[$i]->new_amount : $booking[$i]->amount;

                $booking_result[] = array(
                    "reports_set" => "Booking",
                    "mag_name" => $booking[$i]->mag_name,
                    "sales_rep_name" => $booking[$i]->sales_rep_name,
                    "client_name" => $booking[$i]->client_name,
                    "line_item" => $booking[$i]->line_item,
                    "qty" => $booking[$i]->qty,
                    "new_amount" => number_format($amount, 2),
                    "status" => $status,
                    "created_at" => $date_created->format('F d, Y')

                );
            }

            return array("Code" => 200, "data" => $booking_result);
        }

        $booking_result = 0;
        return array("Code" => 404, "data" => $booking_result);

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
}
