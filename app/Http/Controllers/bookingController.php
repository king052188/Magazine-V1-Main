<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Contracts;
use App\Booking;
use App\MagazineTransaction;
use App\MagIssueTransaction;

class bookingController extends Controller
{
    public function booking_list($filter = null)
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

        return view('booking.booking_list', compact('booking', 'magazine', 'filter'))->with('success', 'Booking details successful added!');
    }

    public function booking_list_api($filter = null)
    {
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
                                SELECT company_name FROM client_table WHERE Id = book_trans.client_id AND status = 2 AND type = 1;
                            ) AS client_name,
                            (
                                SELECT CONCAT(a.first_name, ' ', a.middle_name, ' ', a.last_name) 
                                FROM client_contacts_table AS a
                                INNER JOIN client_table AS b
                                ON a.client_id = b.Id
                                WHERE a.Id = book_trans.agency_id
                                AND b.type = 2
                            ) AS agency_name,
                            ( 
                                SELECT magazine_name FROM magazine_table WHERE Id = m_trans.magazine_id 
                            ) AS magazine_name,
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


        $bill_to = DB::table('client_contacts_table')->where('client_id', '=', $company_uid)->where('role', '=', 3)->get(); //Subscriber

        $magazine = DB::table('magazine_table')->where('status', '=', 2)->get();

//        return view('booking.booking_list', compact('booking', 'magazine', 'filter'))->with('success', 'Booking details successful added!');

        return $booking;
    }

    public function add_booking()
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $n_booking = \App\Http\Controllers\VMKhelper::get_new_contract();

        $subscriber = DB::SELECT("
                    SELECT 
                        master.company_name, master.type, master.status, child.*, child.Id as child_uid
                    FROM 
                        client_table AS master
                    INNER JOIN
                        client_contacts_table AS child
                    ON
                        master.Id = child.client_id
                    WHERE master.type = 1
                    ORDER BY master.company_name, branch_name ASC
        ");

        $agency = DB::SELECT("
                    SELECT 
                        master.company_name, master.type, master.status, child.*, child.Id as child_uid
                    FROM 
                        client_table AS master
                    INNER JOIN
                        client_contacts_table AS child
                    ON
                        master.Id = child.client_id
                    WHERE master.type = 2
                    ORDER BY master.company_name, branch_name ASC
        ");

        return view('booking.add_booking', compact('n_booking','subscriber','agency'))->with('success', 'Booking details successful added!');
    }

    public function save_booking(Request $request)
    {
        $booking = new Booking();
        $booking->trans_num = $request['trans_num'];
        $booking->sales_rep_code = $request['sales_rep_code'];
        $booking->client_id = $request['client_id'];
        $booking->agency_id = $request['agency_id'] == "" ? 0 : $request['agency_id'];
        $booking->status = 2;
        $booking->save();

        $booking_uid = $booking->id; //last_inserted_id
        $which_country = $request['which_country'];
        $client_id = $request['client_id'];
        if($booking_uid > 0) {
            return redirect("/booking/magazine-transaction/". $booking_uid ."/". $which_country ."/". $client_id);
        }

    }

    public function show_transaction_mag($trans_uid, $which_country, $client_id) {

        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $disabled = ["set" => ""];
        $booking_uid = (int)$trans_uid;
        $w_country = (int)$which_country;

        $mag_l = DB::SELECT("
                    SELECT * FROM magazine_table as mag
                    LEFT JOIN magazine_transaction_table as mag_t
                    ON mag_t.magazine_id = mag.Id
                    WHERE mag_t.transaction_id = {$booking_uid}
                    ");

        $mag_list = DB::table('magazine_table')->where('magazine_country', '=', $w_country)->where('status', '=', 2)->get();

        if(count($mag_l) > 0) {
            $disabled = ["set" => "disabled"];
        }
        return view('booking.magazine_transaction', compact('booking_uid', 'mag_list', 'which_country', 'client_id', 'mag_l', 'disabled'))->with('success', 'Successfully Added Magazine');
    }

    public function save_magazine_transaction(Request $request, $trans_uid, $which_country, $client_id)
    {
        $booking_uid = (int)$trans_uid;
        $exist = DB::table('magazine_transaction_table')->where('transaction_id', '=', $booking_uid)->get();
        if(COUNT($exist) > 0)
        {
            // not allow
            return redirect("/booking/magazine-transaction/". $booking_uid ."/". $which_country ."/". $client_id)->with("message", "1 magazine only");
        }
        $mt = new MagazineTransaction();
        $mt->magazine_id = $request['magazine_id'];
        $mt->transaction_id = $booking_uid;
        $r = $mt->save();
        $message = $r ? "Success" : "Fail";
        return redirect("/booking/magazine-transaction/". $booking_uid ."/". $which_country ."/". $client_id)->with("message", $message);
        /* END = Additional 11-20-2016 8:54PM | MJT */
    }

    public function getPackageName($criteria_id, $mag_uid)
    {
        $ad_p = DB::SELECT("
                SELECT b.package_name, a.*
                FROM magzine_price_table AS a
                INNER JOIN price_package_table AS b
                ON a.ad_size = b.Id
                WHERE a.mag_id = {$mag_uid} AND a.ad_color = {$criteria_id}
              ");

        if($ad_p != null)
        {
            for($i = 0; $i < COUNT($ad_p); $i++)
            {
                $result[] = array(
                    "price_uid" => $ad_p[$i]->Id,
                    "ad_size" => $ad_p[$i]->ad_size,
                    "package_name" => $ad_p[$i]->package_name,
                    "ad_amount" => $ad_p[$i]->ad_amount
                );
            }
        }
        return array(
            "list" => $result
        );
    }

    public function add_issue($mag_trans_uid, $client_id)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }
        
//        $ad_c = DB::table('price_criteria_table')->where('status','=',2)->get();
        $ad_p = DB::table('price_package_table')->where('status','=',2)->get();

        $transaction_uid = DB::table('magazine_transaction_table')->where('Id','=',$mag_trans_uid)->get();
        $booking_trans_num = DB::table('booking_sales_table')->where('Id','=',$transaction_uid[0]->transaction_id)->get();
        $mag_name = DB::table('magazine_table')->where('Id','=',$transaction_uid[0]->magazine_id)->get();

        $ad_c = DB::SELECT("
                SELECT b.Id as c_uid, b.name
                FROM magzine_price_table AS a
                INNER JOIN price_criteria_table AS b
                ON a.ad_color = b.Id
                WHERE a.mag_id = {$transaction_uid[0]->magazine_id}
                GROUP BY c_uid, b.name ASC
        ");

        return view('booking.add_issue', compact('mag_trans_uid', 'mag_name', 'ad_c', 'ad_p', 'client_id','transaction_uid','booking_trans_num'));
    }

    public function save_issue_v1_backup(Request $request, $mag_trans_uid, $client_id)
    {
        $mt_uid = (int)$mag_trans_uid;
        $isMoreThatOne = DB::SELECT("SELECT * FROM magazine_issue_transaction_table WHERE magazine_trans_id = {$mt_uid}");
        if(COUNT($isMoreThatOne) == 0 OR COUNT($isMoreThatOne) > 1)
        {
            $type = DB::SELECT("SELECT bb.type as client_type FROM client_contacts_table as aa INNER JOIN client_table as bb ON bb.Id = aa.client_id WHERE aa.Id = {$client_id}");

            $ad_c = $request['ad_criteria_id'];
            $ad_p = $request['ad_package_id'];
            $quarter_issue = (int)$request['quarter_issue'];
            $line_item_qty = (int)$request['line_item_qty'];
            $amount = DB::table('price_table')->where('criteria_id', '=', $ad_c)->where('package_id', '=', $ad_p)->where('type', '=', $type[0]->client_type)->get();

            $check = DB::table('magazine_issue_transaction_table')
                ->where('magazine_trans_id', '=', $mag_trans_uid)
                ->where('ad_criteria_id', '=', $ad_c)
                ->where('ad_package_id', '=', $ad_p)
                ->where('quarter_issued', '=', $quarter_issue)
                ->get();

            if(COUNT($check) > 0)
            {
                return redirect("/booking/add_issue/". $mag_trans_uid ."/". $client_id)->with('fail', 'Already exists.');
            }

            $mit = new MagIssueTransaction();
            $mit->magazine_trans_id = $mag_trans_uid;
            $mit->ad_criteria_id = $ad_c;
            $mit->ad_package_id = $ad_p;
            $mit->amount = $amount[0]->amount_x1;
            $mit->quarter_issued = $quarter_issue;
            $mit->line_item_qty = $line_item_qty;
            $mit->status = 2;
            $mit->save();

            return redirect("/booking/add_issue/". $mag_trans_uid ."/". $client_id)->with('success', 'Add Successful');

        }
        elseif(COUNT($isMoreThatOne) == 1)
        {
            $type = DB::SELECT("SELECT bb.type as client_type FROM client_contacts_table as aa INNER JOIN client_table as bb ON bb.Id = aa.client_id WHERE aa.Id = {$client_id}");

            $aa = DB::SELECT("SELECT * FROM magazine_issue_transaction_table WHERE magazine_trans_id = {$mag_trans_uid}");
            $update_1st_amount = DB::table('price_table')->where('criteria_id', '=', $aa[0]->ad_criteria_id)->where('package_id', '=', $aa[0]->ad_package_id)->where('type', '=', $type[0]->client_type)->get();

            MagIssueTransaction::where('magazine_trans_id', '=', $mag_trans_uid)
                ->where('ad_criteria_id', '=', $aa[0]->ad_criteria_id)
                ->where('ad_package_id', '=', $aa[0]->ad_package_id)
                ->update([
                    'amount' => $update_1st_amount[0]->amount_x2_more
                ]);

            $ad_c = $request['ad_criteria_id'];
            $ad_p = $request['ad_package_id'];
            $quarter_issue = (int)$request['quarter_issue'];
            $line_item_qty = (int)$request['line_item_qty'];
            $amount = DB::table('price_table')->where('criteria_id', '=', $ad_c)->where('package_id', '=', $ad_p)->where('type', '=', $type[0]->client_type)->get();

            $mit = new MagIssueTransaction();
            $mit->magazine_trans_id = $mag_trans_uid;
            $mit->ad_criteria_id = $ad_c;
            $mit->ad_package_id = $ad_p;
            $mit->amount = $amount[0]->amount_x2_more;
            $mit->quarter_issued = $quarter_issue;
            $mit->line_item_qty = $line_item_qty;
            $mit->status = 2;
            $mit->save();

            return redirect("/booking/add_issue/". $mag_trans_uid ."/". $client_id);
        }
    }

    public function save_issue(Request $request, $mag_trans_uid, $client_id)
    {
        $mt_uid = (int)$mag_trans_uid;
        $isMoreThanOne = DB::SELECT("SELECT * FROM magazine_issue_transaction_table WHERE magazine_trans_id = {$mt_uid}");

        $type = DB::SELECT("SELECT bb.type as client_type FROM client_contacts_table as aa INNER JOIN client_table as bb ON bb.Id = aa.client_id WHERE aa.Id = {$client_id}");

        $ad_c = $request['ad_criteria_id'];
        $ad_p = $request['ad_p_split'];
        $quarter_issue = (int)$request['quarter_issue'];
        $line_item_qty = (int)$request['line_item_qty'];
        $ad_amount = $request['ad_amount'];
        $price_uid = $request['price_uid'];
//        $amount = DB::table('price_table')->where('criteria_id', '=', $ad_c)->where('package_id', '=', $ad_p)->where('type', '=', $type[0]->client_type)->get();

//        dd($type[0]->client_type);

        $check = DB::table('magazine_issue_transaction_table')
            ->where('magazine_trans_id', '=', $mag_trans_uid)
            ->where('ad_criteria_id', '=', $ad_c)
            ->where('ad_package_id', '=', $ad_p)
            ->where('quarter_issued', '=', $quarter_issue)
            ->get();

        if(COUNT($check) > 0)
        {
            return redirect("/booking/add_issue/". $mag_trans_uid ."/". $client_id)->with('fail', 'Please delete original data, and insert with additional quantity.');
        }

//        if(COUNT($isMoreThanOne) >= 1)
//        {
//            MagIssueTransaction::where('magazine_trans_id', '=', $mag_trans_uid)
//                ->where('ad_criteria_id', '=', $ad_c)
//                ->where('ad_package_id', '=', $ad_p)
//                ->update([
//                    'amount' => $ad_amount
//                ]);
//        }

        $mit = new MagIssueTransaction();
        $mit->magazine_trans_id = $mag_trans_uid;
        $mit->ad_criteria_id = $ad_c;
        $mit->ad_package_id = $ad_p;
        $mit->amount = $ad_amount;
        $mit->quarter_issued = $quarter_issue;
        $mit->line_item_qty = $line_item_qty;
        $mit->mag_price_id = $price_uid;
        $mit->status = 2;
        $mit->save();

        return redirect("/booking/add_issue/". $mag_trans_uid ."/". $client_id)->with('success', 'Add Successful');
    }

    public function trans_selected_row_update($trans_id, $trans_status)
    {
        $t_uid = (int)$trans_id;
        $t_status = (int)$trans_status;

        $update = DB::table('booking_sales_table')
            ->where('Id', $t_uid)
            ->update(['status' => $t_status]);

        if($update){
            return [
                "status" => 200
            ];
        }

        return [
            "status" => 500
        ];
    }
    
    public function delete_issue($tran_issue_uid, $mag_trans_uid, $client_id)
    {
        MagIssueTransaction::where('id', $tran_issue_uid)->delete();

        return redirect("/booking/add_issue/". $mag_trans_uid ."/". $client_id);
    }

}
