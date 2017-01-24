<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Contracts;
use App\Invoice;
use App\PaymentTransaction;
use App\MagIssueTransaction;
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
            $trans = DB::table('booking_sales_table')->where('trans_num','=',$result[0]->booking_trans)->get();
            $is_member = DB::table('client_table')->where('Id','=',$trans[0]->client_id)->get();
            $discount = DB::table('discount_transaction_table')->where('trans_id','=',$result[0]->booking_trans)->get();
            $province_tax = DB::table('taxes_table')->where('province_code','=',$is_member[0]->state)->get();

            return array(
                "result" => 200,
                "description" => "Invoice Number is available",
                "is_member" => COUNT($is_member) > 0 ? $is_member[0]->is_member : 0,
                "province_state" => COUNT($is_member) > 0 ? $is_member[0]->state : 0,
                "province_tax" => COUNT($province_tax) > 0 ? $province_tax[0]->tax_amount + 0 : 0,
                "discount_percent" => $discount[0]->discount_percent + 0
            );
        }

        return array("result" => 404, "description" => "Invoice Number is not available");
    }

    public function save_payment_transaction($inv_num, $line_item, $ref_number, $method_payment, $date_payment, $amount, $remarks)
    {
        $r = new PaymentTransaction();
        $r->invoice_num = $inv_num;
        $r->line_item_id = $line_item;
        $r->reference_number = $ref_number;
        $r->method_payment = $method_payment;
        $r->date_payment = date('Y-m-d H:i:s', $date_payment);
        $r->amount = $amount;
        $r->remarks = $remarks;
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

    public function view_payment_transaction($inv_num, $line_item)
    {
        $line_item = (int)$line_item;

        $total_paid = DB::SELECT("SELECT SUM(amount) as paid FROM payment_transaction_table as bb WHERE bb.invoice_num = '{$inv_num}' AND bb.line_item_id = {$line_item} GROUP BY bb.line_item_id ASC");
        $result = DB::SELECT("SELECT aa.* FROM payment_transaction_table as aa WHERE aa.invoice_num = '{$inv_num}' AND aa.line_item_id = {$line_item}");

        if(COUNT($result) == 0)
        {
            return array(
                "status" => 404,
                "description" => "Available 1",
                "invoice_num_result" => $inv_num,
                "line_item_id_result" => $line_item,
                "total_paid" => 0,
                "result" => []
            );
        }

        return array(
            "status" => 200,
            "description" => "Available 2",
            "invoice_num_result" => $inv_num,
            "line_item_id_result" => $line_item,
            "total_paid" => $total_paid[0]->paid,
            "result" => $result
        );

        return array("result" => 404, "description" => "No Result Found!");
    }

    public function invoice()
    {
        //$is_member = DB::table('client_table')->where('Id','=',$client_id)->get();

        return view('payment.invoice');
    }

    public function invoice_list()
    {
        $result = DB::SELECT("
                        SELECT aa.*, concat_ws('',bb.first_name, ' ', bb.last_name) as sales_rep_name
                        FROM invoice_table as aa
                        INNER JOIN user_account as bb ON bb.Id = aa.account_executive      
        ");

        if($result != null)
        {
            return array(
                "status" => 202,
                "list" => $result
            );
        }

        return array("status" => 404, "description" => "No Result Found!");
    }

    public function latest_invoice_list()
    {
        $result = DB::SELECT("
                    SELECT aa.*, concat_ws('',bb.first_name, ' ', bb.last_name) as sales_rep_name
                    FROM invoice_table as aa
                    INNER JOIN user_account as bb ON bb.Id = aa.account_executive
                    WHERE DATE_FORMAT(aa.created_at,'%Y-%m-%d %T') 
                    BETWEEN DATE_FORMAT(NOW(),'%Y-%m-%d 00:00:00')
                    AND DATE_FORMAT(NOW(),'%Y-%m-%d 11:59:59')
                        ");

        if($result != null)
        {
            return array(
                "status" => 202,
                "list" => $result
            );
        }

        return array("status" => 404, "description" => "No Result Found!");
    }

    public function invoice_generate($generate_issue, $generate_year)
    {
        $quarter_issue = (int)$generate_issue;

        $process = DB::SELECT("
                        SELECT 
                        aa.Id as r_uid, cc.trans_num as r_trans_num, cc.sales_rep_code as r_sales_rep_code
                        FROM 
                        magazine_issue_transaction_table as aa
                        INNER JOIN magazine_transaction_table as bb ON bb.Id = aa.magazine_trans_id
                        INNER JOIN booking_sales_table as cc ON cc.Id = bb.transaction_id
                        WHERE aa.quarter_issued = {$quarter_issue} AND EXTRACT(YEAR FROM aa.created_at) = {$generate_year}  AND cc.status = 3 AND aa.status = 2
                        ");

        if(COUNT($process) == 0)
        {
            return array("status" => 404, "description" => "No Available Invoice");
        }
        else
        {
            for($i = 0; $i < COUNT($process); $i++)
            {
                $chk_trans_num = $process[$i]->r_trans_num;
                $result = DB::SELECT("SELECT * FROM invoice_table WHERE booking_trans = '{$chk_trans_num}' AND issue = {$quarter_issue}");
                if(COUNT($result) == 0)
                {
                    MagIssueTransaction::where('Id', '=', $process[$i]->r_uid)->update(['status' => 3]);
                    
                    $current = Carbon::now();
                    $due_date = $current->addDays(30);

                    $a = 0;
                    for ($x = 0; $x<4; $x++){
                        $a .= mt_rand(0,9);
                    }

                    $invoice = new Invoice();
                    $invoice->invoice_num = date('Y') . '-' . $a;
                    $invoice->booking_trans = $process[$i]->r_trans_num;
                    $invoice->issue = $quarter_issue;
                    $invoice->due_date = $due_date;
                    $invoice->account_executive = $process[$i]->r_sales_rep_code;
                    $invoice->status = 2;
                    $invoice->save();
                }
                else
                {
                    return array("status" => 404, "description" => "No Invoice Available.");
                }
            }

            return array("status" => 202, "description" => "Invoice Successfully Generated.");
        }
    }
}
