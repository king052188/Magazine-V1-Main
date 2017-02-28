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
        
        $publication = DB::table('magazine_table')->where('status', '=', 2)->get();
        $clients = DB::table('client_table')->where('status', '=', 2)->get();
        $sales_rep = DB::table('user_account')->where('status', '=', 2)->get();

        return view('/reports/sales', compact('publication', 'clients', 'sales_rep'));
    }

    public function get_filter_data($f_publication, $f_sales_rep, $f_client, $f_status, $f_date_from, $f_date_to, $f_operator)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
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


        $filter_process = "WHERE " . $filter_publication_tran . ' AND ' . $filter_sales_rep_tran . ' AND ' . $filter_client_tran . ' AND ' . $filter_status_tran . ' AND ' . $filter_date_from;


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

            $booking_result[] = array(
                "mag_name" => $booking[$i]->mag_name,
                "sales_rep_name" => $booking[$i]->sales_rep_name,
                "client_name" => $booking[$i]->client_name,
                "line_item" => $booking[$i]->line_item,
                "qty" => $booking[$i]->qty,
                "amount" => $booking[$i]->amount,
                "new_amount" => $booking[$i]->new_amount,
                "status" => $status,
                "created_at" => $date_created->format('F d, Y')

            );
        }

        return array("Code" => 200, "Result" => $booking_result);
    }
    
}
