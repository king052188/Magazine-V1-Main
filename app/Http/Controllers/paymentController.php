<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Contracts;
use App\Invoice;
use App\PaymentTransaction;
use Carbon\Carbon;


class paymentController extends Controller
{
    public function payment_list($filter = null)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }
        
        $filter_tran = "WHERE book_trans.status IN (1, 2, 3, 5)";

        if($filter != null){
            $filter_tran = "WHERE book_trans.status = {$filter}";
        }
        
        $booking = DB::SELECT("    
                        SELECT 
                            book_trans.*, 
                            (
                                SELECT CONCAT(a.first_name, ' ', a.middle_name, ' ', a.last_name)
                                FROM user_account AS a
                                WHERE Id = book_trans.sales_rep_code 
                            ) AS sales_rep_name,
                            (
                                SELECT company_name FROM client_table WHERE Id = book_trans.client_id AND status = 2 AND type != 2
                            ) AS client_name,
                            (
                                SELECT company_name FROM client_table WHERE Id = book_trans.agency_id AND status = 2 AND type = 2
                            ) AS agency_name,
                            ( 
                                SELECT magazine_name FROM magazine_table WHERE Id = m_trans.magazine_id 
                            ) AS magazine_name,
                            ( 
                                SELECT magazine_issues FROM magazine_table WHERE Id = m_trans.magazine_id 
                            ) AS magazine_issues,
                            ( 
                                SELECT magazine_year FROM magazine_table WHERE Id = m_trans.magazine_id 
                            ) AS magazine_year,
                            ( 
                                SELECT 
                                    CASE WHEN magazine_country = 1 THEN 'USA' 
                                    WHEN magazine_country = 2 THEN 'CANADA' 
                                    ELSE 'PHILIPPINES' END AS magazine_country_name
                                FROM magazine_table
                                WHERE Id = m_trans.magazine_id
                            ) AS magazine_country_name,
                            ( 
                                SELECT magazine_country
                                FROM magazine_table
                                WHERE Id = m_trans.magazine_id
                            ) AS magazine_country_id,
                            SUM(m_issue.line_item_qty) AS number_of_issue
                        FROM 
                            magazine_issue_transaction_table AS m_issue
                        INNER JOIN
                            magazine_transaction_table AS m_trans
                        ON
                            m_issue.magazine_trans_id = m_trans.Id
                        INNER JOIN
                            booking_sales_table AS book_trans
                        ON
                            m_trans.transaction_id = book_trans.Id
                            
                        $filter_tran
                        
                        GROUP BY 
                            book_trans.Id, book_trans.trans_num, book_trans.sales_rep_code, book_trans.client_id, book_trans.agency_id, book_trans.status, book_trans.updated_at, book_trans.created_at, m_trans.magazine_id

        ");

        $magazine = DB::table('magazine_table')->where('status', '=', 2)->get();

        return view('payment.payment_list', compact('booking', 'magazine', 'filter'))->with('success', 'Booking details successful added!');
    }

    public function search_invoice_number_api($inv_num)
    {
        $result = DB::SELECT("SELECT * FROM invoice_table WHERE invoice_num = '{$inv_num}'");
        if($result != null)
        {
            return array("result" => 200, "description" => "Invoice Number is available");
        }

        return array("result" => 404, "description" => "Invoice Number is not available");
    }

    public function save_payment_transaction($inv_num, $line_item, $ref_number, $method_payment, $date_payment, $amount)
    {
        $r = new PaymentTransaction();
        $r->invoice_num = $inv_num;
        $r->line_item_id = $line_item;
        $r->reference_number = $ref_number;
        $r->method_payment = $method_payment;
        $r->date_payment = date('Y-m-d H:i:s', $date_payment);
        $r->amount = $amount;
        $r->type = 2;
        $r->status = 2;
        $r->save();

        return array("result" => 200);
    }

    public function invoice_create_api($trans_num)
    {
        $result = DB::SELECT("SELECT * FROM invoice_table WHERE booking_trans = '{$trans_num}'");
        if($result == null)
        {
            $current = Carbon::now();
            $due_date = $current->addDays(30);

            $a = 0;
            for ($i = 0; $i<4; $i++){
                $a .= mt_rand(0,9);
            }

            $invoice = new Invoice();
            $invoice->invoice_num = date('Y') . '-' . $a;
            $invoice->booking_trans = $trans_num;
            $invoice->due_date = $due_date;
            $invoice->account_executive = '#N/A';
            $invoice->status = 2;
            $invoice->save();

            return array("result" => 200);
        }

        return array("result" => 404);
    }
}