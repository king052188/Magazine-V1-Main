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


        $filter_publication = 0;
        $filter_sales_rep = 0;
        $filter_client = 0;
        $filter_status = 0;



        if($_COOKIE['role'] == 3){
            $filter_sales_rep = "WHERE booked.sales_rep_code = {$_COOKIE['Id']}";
        }else{
            $filter_sales_rep = "";
        }

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
            
            $filter_sales_rep
            
            ");

        $publication = DB::table('magazine_table')->where('status', '=', 2)->get();
        $clients = DB::table('client_table')->where('status', '=', 2)->get();
        $sales_rep = DB::table('user_account')->where('status', '=', 2)->get();

        return view('/reports/sales', compact('booking', 'publication', 'clients', 'sales_rep', 'filter_publication', 'filter_sales_rep', 'filter_client', 'filter_status'))->with('success', 'Booking details successful added!');

//        return view('/reports/sales');
    }
}
