<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Contracts;
use App\Booking;
use App\MagazineTransaction;
use App\MagIssueTransaction;


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
}
