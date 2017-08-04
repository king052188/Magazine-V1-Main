<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Contracts;
use App\Invoice;
use App\PaymentTransaction;
use App\MagIssueTransaction;
use App\MagazineDigitalTransaction;
use App\Booking;
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

        $clients = DB::SELECT("
                    SELECT *
                    FROM client_table
                    WHERE status = 2 AND type != 2 ORDER BY company_name ASC
    	 ");

        $nav_dashboard = "";
        $nav_clients = "";
        $nav_publisher = "";
        $nav_publication = "";
        $nav_sales = "";
        $nav_payment = "active";
        $nav_reports = "";
        $nav_users = "";

        return view('payment.payment_list', compact('booking', 'magazine', 'filter', 'clients','nav_dashboard','nav_clients', 'nav_publisher', 'nav_publication', 'nav_sales','nav_payment','nav_reports','nav_users'))->with('success', 'Booking details successful added!');
    }

    public function search_invoice_number_api($inv_num)
    {
        //version 1
        //$result = DB::SELECT("SELECT * FROM invoice_table WHERE invoice_num = '{$inv_num}'");

        //version 2
        $result = DB::SELECT("
                    SELECT 
                    aa.* 
                    FROM invoice_table as aa 
                    INNER JOIN booking_sales_table as bb ON aa.booking_trans = bb.trans_num
                    INNER JOIN client_table as cc ON bb.client_id = cc.Id
                    WHERE aa.invoice_num = '{$inv_num}' OR cc.company_name = '{$inv_num}'
        ");
        if($result != null)
        {
            $trans = DB::table('booking_sales_table')->where('trans_num','=',$result[0]->booking_trans)->get();
            $is_member = DB::table('client_table')->where('Id','=',$trans[0]->client_id)->get();
            $issue_discount = DB::select("SELECT * FROM discount_transaction_table WHERE trans_id = '{$result[0]->booking_trans}' AND type = 2 AND status = 2;");
            $discretionary_discount = DB::select("SELECT * FROM discount_transaction_table WHERE trans_id = '{$result[0]->booking_trans}' AND type = 1 AND status = 2;");
            $province_tax = DB::table('taxes_table')->where('province_code','=',$is_member[0]->state)->get();
            
            return array(
                "result" => 200,
                "invoice_number" => $result[0]->invoice_num,
                "description" => "Invoice Number is available",
                "is_member" => COUNT($is_member) > 0 ? $is_member[0]->is_member : 0,
                "province_state" => COUNT($is_member) > 0 ? $is_member[0]->state : 0,
                "province_tax" => COUNT($province_tax) > 0 ? $province_tax[0]->tax_amount + 0 : 0,
                "issue_discount" => COUNT($issue_discount) > 0 ? (float)$issue_discount[0]->discount_percent : 0,
                "discretionary_discount" => COUNT($discretionary_discount) > 0 ? (float)$discretionary_discount[0]->discount_percent : 0
            );
        }

        return array("result" => 404, "description" => "Invoice Number/Company Name is not available");
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
        $clients = DB::SELECT("
                    SELECT *
                    FROM client_table
                    WHERE status = 2 AND type != 2 ORDER BY company_name ASC
    	 ");

        $magazine = DB::SELECT("
                    SELECT *
                    FROM magazine_table
                    WHERE status = 2 AND magazine_type = 1 ORDER BY magazine_name ASC
    	 ");

        //$is_member = DB::table('client_table')->where('Id','=',$client_id)->get();

        $nav_dashboard = "";
        $nav_clients = "";
        $nav_publisher = "";
        $nav_publication = "";
        $nav_sales = "";
        $nav_payment = "active";
        $nav_reports = "";
        $nav_users = "";

        return view('payment.invoice', compact('clients', 'magazine','nav_dashboard','nav_clients', 'nav_publisher', 'nav_publication', 'nav_sales','nav_payment','nav_reports','nav_users'));
    }

    public function invoice_digital()
    {
        $clients = DB::SELECT("
                    SELECT *
                    FROM client_table
                    WHERE status = 2 AND type != 2 ORDER BY company_name ASC
    	 ");

        $magazine = DB::SELECT("
                    SELECT *
                    FROM magazine_table
                    WHERE status = 2 AND magazine_type = 2 ORDER BY magazine_name ASC
    	 ");

        //$is_member = DB::table('client_table')->where('Id','=',$client_id)->get();

        $nav_dashboard = "";
        $nav_clients = "";
        $nav_publisher = "";
        $nav_publication = "";
        $nav_sales = "";
        $nav_payment = "active";
        $nav_reports = "";
        $nav_users = "";

        return view('payment.invoice-digital', compact('clients', 'magazine','nav_dashboard','nav_clients', 'nav_publisher', 'nav_publication', 'nav_sales','nav_payment','nav_reports','nav_users'));
    }

    public function invoice_list($IsDigital = null)
    {
        $magazine_type = 1;
        if($IsDigital != null) {
            $magazine_type = 2;
        }

        $result = DB::SELECT("
                    SELECT 
                        aa.*, 
                        
                        concat(bb.first_name, ' ', bb.last_name) as sales_rep_name,
                        
                        (
                            SELECT magazine_name 
                            FROM magazine_table as xx
                            INNER JOIN  magazine_transaction_table as yy ON yy.magazine_id = xx.Id
                            INNER JOIN booking_sales_table as zz ON zz.Id = yy.transaction_id
                            WHERE zz.trans_num = aa.booking_trans AND xx.magazine_type = {$magazine_type}
                        ) as mag_name,
                        
                        (
                            SELECT 
                                CASE WHEN amount > 0 THEN
                                    (amount - (amount * (discount_percent / 100)))
                                ELSE 
                                    (
                                        SELECT SUM(amount) AS t_amount
                                        FROM magazine_issue_transaction_table
                                        WHERE magazine_trans_id = (
                                            SELECT t.Id 
                                            FROM booking_sales_table AS b
                                            INNER JOIN magazine_transaction_table AS t
                                            ON b.Id = t.transaction_id
                                            WHERE b.trans_num = aa.booking_trans
                                        ) AND quarter_issued = aa.issue LIMIT 1
                                    )
                                END AS amount 
                            FROM discount_transaction_table 
                            WHERE trans_id = aa.booking_trans AND status = 2 LIMIT 1
                        ) AS i_amount
                        
                    FROM invoice_table as aa
                    
                    INNER JOIN user_account as bb ON bb.Id = aa.account_executive
                    
                    INNER JOIN booking_sales_table as cc ON cc.trans_num = aa.booking_trans
                    
                    INNER JOIN magazine_transaction_table as dd ON dd.transaction_id = cc.Id
                    
                    INNER JOIN magazine_table as ee ON ee.Id = dd.magazine_id
                    
                    WHERE ee.magazine_type = {$magazine_type}
        ");

        if($result != null)
        {
            for($i = 0; $i < COUNT($result); $i++)
            {
                $ago = Carbon::parse($result[$i]->created_at)->diffForHumans();

                $m = $result[$i]->digital_month;

                if($m == 1){ $d_month = "Jan";
                }elseif($m == 2){ $d_month = "Feb"; }
                elseif($m == 3){ $d_month = "Mar"; }
                elseif($m == 4){ $d_month = "Apr"; }
                elseif($m == 5){ $d_month = "May"; }
                elseif($m == 6){ $d_month = "Jun"; }
                elseif($m == 7){ $d_month = "Jul"; }
                elseif($m == 8){ $d_month = "Aug"; }
                elseif($m == 9){ $d_month = "Sept"; }
                elseif($m == 10){ $d_month = "Oct"; }
                elseif($m == 11){ $d_month = "Nov"; }
                elseif($m == 12){ $d_month = "Dec"; }
                else { $d_month = "--"; }

                $w = $result[$i]->digital_week;
                if($w == 0){
                    $d_week = "--";
                }else{
                    $d_week = "Wk " . $w;
                }

                $data[] = array(
                    "Id" => $result[$i]->Id,
                    "invoice_num" => $result[$i]->invoice_num,
                    "booking_trans" => $result[$i]->booking_trans,
                    "issue" => $result[$i]->issue,
                    "month" => $d_month,
                    "week" => $d_week,
                    "due_date" => $result[$i]->due_date,
                    "account_executive" => $result[$i]->account_executive,
                    "status" => $result[$i]->status,
                    "updated_at" => $result[$i]->updated_at,
                    "created_at" => $result[$i]->created_at,
                    "time_ago" => $ago,
                    "sales_rep_name" => $result[$i]->sales_rep_name,
                    "mag_name" => $result[$i]->mag_name,
                    "invoice_amount" => (float)$result[$i]->i_amount,
                );
            }

            return array(
                "status" => 202,
                "list" => $data
            );
        }

        return array("status" => 404, "description" => "No Result Found!");
    }

    public function latest_invoice_list($generate_issue, $generate_year, $generate_company_name, $generate_magazine_name)
    {
        if($generate_company_name != 0){
            //$client_name = " AND zz.client_id = {$generate_company_name}";
            $client_name = "
                AND
                (
                    SELECT client_id 
                    FROM magazine_table as xx
                    INNER JOIN  magazine_transaction_table as yy ON yy.magazine_id = xx.Id
                    INNER JOIN booking_sales_table as zz ON zz.Id = yy.transaction_id
                    WHERE zz.trans_num = aa.booking_trans
                ) = {$generate_company_name}
            ";

        }else{
            $client_name = "";
        }

        if($generate_magazine_name != 0){
            //$magazine_name = " AND yy.magazine_id = {$generate_magazine_name}";
            $magazine_name = " 
                AND
                (
                    SELECT magazine_id 
                    FROM magazine_table as xx
                    INNER JOIN  magazine_transaction_table as yy ON yy.magazine_id = xx.Id
                    INNER JOIN booking_sales_table as zz ON zz.Id = yy.transaction_id
                    WHERE zz.trans_num = aa.booking_trans
                ) = {$generate_magazine_name}
            ";
        }else{
            $magazine_name = "";
        }


        $result = DB::SELECT("
                    SELECT 
                    aa.*, concat_ws('',bb.first_name, ' ', bb.last_name) as sales_rep_name,
                    (
                        SELECT magazine_name 
                        FROM magazine_table as xx
                        INNER JOIN  magazine_transaction_table as yy ON yy.magazine_id = xx.Id
                        INNER JOIN booking_sales_table as zz ON zz.Id = yy.transaction_id
                        WHERE zz.trans_num = aa.booking_trans
                    ) 
                    as mag_name
                    FROM invoice_table as aa
                    INNER JOIN user_account as bb ON bb.Id = aa.account_executive
                    WHERE
                    aa.issue = {$generate_issue}
                    AND EXTRACT(YEAR FROM aa.created_at) = {$generate_year}
        ");

//        WHERE DATE_FORMAT(aa.created_at,'%Y-%m-%d %T')
//        BETWEEN DATE_FORMAT(NOW(),'%Y-%m-%d 00:00:00')
//        AND DATE_FORMAT(NOW(),'%Y-%m-%d 11:59:59')

        if($result != null)
        {
            for($i = 0; $i < COUNT($result); $i++)
            {
                $ago = Carbon::parse($result[$i]->created_at)->diffForHumans();

                $data[] = array(
                    "Id" => $result[$i]->Id,
                    "invoice_num" => $result[$i]->invoice_num,
                    "booking_trans" => $result[$i]->booking_trans,
                    "issue" => $result[$i]->issue,
                    "due_date" => $result[$i]->due_date,
                    "account_executive" => $result[$i]->account_executive,
                    "status" => $result[$i]->status,
                    "updated_at" => $result[$i]->updated_at,
                    "created_at" => $result[$i]->created_at,
                    "time_ago" => $ago,
                    "sales_rep_name" => $result[$i]->sales_rep_name,
                    "mag_name" => $result[$i]->mag_name
                );
            }

            return array(
                "status" => 202,
                "list" => $data
            );
        }

//        $.cookie("Id",mem.Id,{expires: 365});
        return array("status" => 404, "description" => "No Result Found!");
    }

    public function latest_invoice_list_digital($client_name, $publication_name, $yearly, $monthly, $weekly)
    {
        $result = DB::SELECT("
                    SELECT 
                        aa.*, aa.Id as i_invoice_uid, aa.invoice_num as i_invoice_num, aa.booking_trans as i_booking_trans, aa.issue as i_issue,
                        
                        aa.status as i_status, aa.updated_at as i_updated_at, aa.created_at as i_created_at,
                        
                        ee.magazine_type, ff.magazine_id as magazine_id, ff.client_id as client_id,
                        
                        concat(bb.first_name, ' ', bb.last_name) as sales_rep_name,
                        
                        (
                            SELECT magazine_name 
                            FROM magazine_table as xx
                            INNER JOIN  magazine_transaction_table as yy ON yy.magazine_id = xx.Id
                            INNER JOIN booking_sales_table as zz ON zz.Id = yy.transaction_id
                            WHERE zz.trans_num = aa.booking_trans AND xx.magazine_type = 2
                        ) as mag_name,
                        
                        (
                            SELECT 
                                CASE WHEN amount > 0 THEN
                                    (amount - (amount * (discount_percent / 100)))
                                ELSE 
                                    (
                                        SELECT SUM(amount) AS t_amount
                                        FROM magazine_issue_transaction_table
                                        WHERE magazine_trans_id = (
                                            SELECT t.Id 
                                            FROM booking_sales_table AS b
                                            INNER JOIN magazine_transaction_table AS t
                                            ON b.Id = t.transaction_id
                                            WHERE b.trans_num = aa.booking_trans
                                        ) AND quarter_issued = aa.issue LIMIT 1
                                    )
                                END AS amount 
                            FROM discount_transaction_table 
                            WHERE trans_id = aa.booking_trans AND status = 2 LIMIT 1
                        ) AS i_amount
                        
                    FROM invoice_table as aa
                    
                    INNER JOIN user_account as bb ON bb.Id = aa.account_executive
                    
                    INNER JOIN booking_sales_table as cc ON cc.trans_num = aa.booking_trans
                    
                    INNER JOIN magazine_transaction_table as dd ON dd.transaction_id = cc.Id
                    
                    INNER JOIN magazine_digital_transaction_table as ff ON ff.magazine_trans_id = dd.Id
                    
                    INNER JOIN magazine_table as ee ON ee.Id = dd.magazine_id
                    
                    WHERE ee.magazine_type = 2 AND ff.magazine_id = {$publication_name} AND ff.client_id = {$client_name} AND ff.year = {$yearly} AND aa.digital_month = {$monthly} AND aa.digital_week = {$weekly} 
                    
                    GROUP BY aa.Id
        ");

        if($result != null)
        {
            for($i = 0; $i < COUNT($result); $i++)
            {
                $ago = Carbon::parse($result[$i]->created_at)->diffForHumans();

                $m = $result[$i]->digital_month;

                if($m == 1){ $d_month = "Jan";
                }elseif($m == 2){ $d_month = "Feb"; }
                elseif($m == 3){ $d_month = "Mar"; }
                elseif($m == 4){ $d_month = "Apr"; }
                elseif($m == 5){ $d_month = "May"; }
                elseif($m == 6){ $d_month = "Jun"; }
                elseif($m == 7){ $d_month = "Jul"; }
                elseif($m == 8){ $d_month = "Aug"; }
                elseif($m == 9){ $d_month = "Sept"; }
                elseif($m == 10){ $d_month = "Oct"; }
                elseif($m == 11){ $d_month = "Nov"; }
                elseif($m == 12){ $d_month = "Dec"; }
                else { $d_month = "--"; }

                $w = $result[$i]->digital_week;
                if($w == 0){
                    $d_week = "--";
                }else{
                    $d_week = "Wk " . $w;
                }

                $data[] = array(
                    "Id" => $result[$i]->i_invoice_uid,
                    "invoice_num" => $result[$i]->i_invoice_num,
                    "booking_trans" => $result[$i]->i_booking_trans,
                    "issue" => $result[$i]->i_issue,
                    "month" => $d_month,
                    "week" => $d_week,
                    "due_date" => $result[$i]->due_date,
                    "account_executive" => $result[$i]->account_executive,
                    "status" => $result[$i]->i_status,
                    "updated_at" => $result[$i]->i_updated_at,
                    "created_at" => $result[$i]->i_created_at,
                    "time_ago" => $ago,
                    "sales_rep_name" => $result[$i]->sales_rep_name,
                    "mag_name" => $result[$i]->mag_name
                );
            }

            return array(
                "status" => 202,
                "list" => $data
            );
        }

//        $.cookie("Id",mem.Id,{expires: 365});
        return array("status" => 404, "description" => "No Result Found!");
    }

    public function invoice_generate($generate_issue, $generate_year, $generate_company_name, $generate_magazine_name)
    {
        $quarter_issue = (int)$generate_issue;
        $generate_company_name = (int)$generate_company_name;
        $generate_magazine_name = (int)$generate_magazine_name;


//        return array(
//            "issue" => $quarter_issue,
//            "generate_year" => $generate_year,
//            "generate_company_name" => $generate_company_name,
//            "generate_magazine_name" => $generate_magazine_name
//        );

        if($generate_company_name != 0){
            $client_name = " AND cc.client_id = {$generate_company_name}";
        }else{
            $client_name = "";
        }

        if($generate_magazine_name != 0){
            $magazine_name = " AND bb.magazine_id = {$generate_magazine_name}";
        }else{
            $magazine_name = "";
        }

        //$chk_issue_existing = DB::SELECT("SELECT * FROM invoice_table WHERE booking_trans = {}");

        $process = DB::SELECT("
                        SELECT
                        aa.Id as r_uid, cc.trans_num as r_trans_num, cc.sales_rep_code as r_sales_rep_code
                        FROM
                        magazine_issue_transaction_table as aa
                        INNER JOIN magazine_transaction_table as bb ON bb.Id = aa.magazine_trans_id
                        INNER JOIN booking_sales_table as cc ON cc.Id = bb.transaction_id
                        WHERE aa.quarter_issued = {$quarter_issue} AND EXTRACT(YEAR FROM aa.created_at) = {$generate_year} $client_name $magazine_name AND cc.status IN (3, 6) AND aa.status = 2
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
                    MagIssueTransaction::where('Id', '=', $process[$i]->r_uid)->update(['status' => 3]); //Invoice Already Released
                    Booking::where('trans_num', '=', $chk_trans_num)->update(['status' => 6]); //6 = Approved/Invoiced

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
                    return array("status" => 404, "description" => "No Available Invoice");
                }
            }

            return array(
                "status" => 202,
                "description" => "Invoice Successfully Generated.",
                "generate_issue" => $generate_issue,
                "generate_year" => $generate_year,
                "generate_company_name" => $generate_company_name,
                "generate_magazine_name" => $generate_magazine_name
            );
        }
    }

    public function invoice_generate_digital($client_name, $publication_name, $year, $monthly, $weekly)
    {
        $client_name = (int)$client_name;
        $publication_name = (int)$publication_name;
        $year = (int)$year;
        $monthly = (int)$monthly;
        $weekly = (int)$weekly;

        $client_name_aa = ($client_name != 0 ? " AND aa.client_id = {$client_name}" : "");
        $publication_name_aa = ($publication_name != 0 ? " AND aa.magazine_id = {$publication_name}" : "");
        $year_aa = ($year != 0 ? " AND aa.year = {$year}" : "");
        $monthly_aa = ($monthly != 0 ? " AND aa.month_id = {$monthly}" : "");
        $weekly_aa = ($weekly != 0 ? " AND aa.week_id = {$weekly}" : " AND aa.week_id = 0");

        $execute = $client_name_aa . $publication_name_aa . $year_aa . $monthly_aa . $weekly_aa;

        $process = DB::SELECT("
                    SELECT
                    aa.Id as r_uid, cc.trans_num as r_trans_num, cc.sales_rep_code as r_sales_rep_code
                    FROM
                    magazine_digital_transaction_table as aa
                    INNER JOIN magazine_transaction_table as bb ON bb.Id = aa.magazine_trans_id
                    INNER JOIN booking_sales_table as cc ON cc.Id = bb.transaction_id
                    WHERE aa.status = 2 AND cc.status IN (3, 6) {$execute}
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
                $result = DB::SELECT("SELECT * FROM invoice_table WHERE booking_trans = '{$chk_trans_num}' AND issue = 0 AND digital_month = {$monthly} AND digital_week = {$weekly}");
                if(COUNT($result) == 0)
                {
                    MagazineDigitalTransaction::where('Id', '=', $process[$i]->r_uid)->update(['status' => 3]); //Invoice Already Released
                    Booking::where('trans_num', '=', $chk_trans_num)->update(['status' => 6]); //6 = Approved/Invoiced

                    $current = Carbon::now();
                    $due_date = $current->addDays(30);

                    $a = 0;
                    for ($x = 0; $x<4; $x++){
                        $a .= mt_rand(0,9);
                    }

                    $invoice = new Invoice();
                    $invoice->invoice_num = date('Y') . '-' . $a;
                    $invoice->booking_trans = $process[$i]->r_trans_num;
                    $invoice->item_id = $process[$i]->r_uid;
                    $invoice->issue = 0; //0 this is for print only
                    $invoice->digital_month = $monthly;
                    $invoice->digital_week = $weekly;
                    $invoice->due_date = $current;
                    $invoice->account_executive = $process[$i]->r_sales_rep_code;
                    $invoice->status = 2;
                    $invoice->save();
                }
                else
                {
                    return array("status" => 404, "description" => "No Available Invoice");
                }
            }

            return array(
                "status" => 202,
                "description" => "Invoice Successfully Generated.",
                "client_name" => $client_name,
                "publication_name" => $publication_name,
                "yearly" => $year,
                "monthly" => $monthly,
                "weekly" => $weekly
            );
        }
    }
}
