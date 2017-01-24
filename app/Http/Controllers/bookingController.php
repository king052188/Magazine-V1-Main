<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Contracts;
use App\Booking;
use App\MagazineTransaction;
use App\MagIssueTransaction;
use App\DiscountTransaction;
use App\Notification;

class bookingController extends Controller
{
    public function booking_list($filter = null)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }
        
        $filter_tran = "WHERE booked.status IN (1, 2, 3, 5)";

        if($filter != null){
            $filter_tran = "WHERE booked.status = {$filter}";
        }
        
        $booking = DB::SELECT("
            SELECT 

                booked.Id,
                
                booked.client_id,
                
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
                
                ( SELECT (amount - (amount * (discount_percent / 100))) new_amount FROM discount_transaction_table WHERE trans_id = booked.trans_num AND status = 2 ) AS new_amount,
                
                booked.status,
                
                booked.created_at
                    
            FROM booking_sales_table AS booked
            
            INNER JOIN magazine_transaction_table AS trans
            
            ON booked.Id = trans.transaction_id
            
            {$filter_tran}
            
            ");

        $magazine = DB::table('magazine_table')->where('status', '=', 2)->get();

        return view('booking.booking_list', compact('booking', 'magazine', 'filter'))->with('success', 'Booking details successful added!');
    }
    
    public function add_booking()
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $n_booking = \App\Http\Controllers\VMKhelper::get_new_contract();

        $clients = DB::SELECT("
                    SELECT *
                    FROM client_table
                    WHERE status = 2 AND type != 2 ORDER BY company_name ASC
    	 ");

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

        return view('booking.add_booking', compact('n_booking','subscriber','agency', 'clients'))->with('success', 'Booking details successful added!');
    }

    public function search_bill_to($client_id)
    {
        $c_uid = (int)$client_id;
        $groups = DB::select("SELECT * FROM group_table WHERE client_uid = {$c_uid};");

        $group_list = [];
        for($i = 0; $i < count($groups); $i++) {
            $g_uid = $groups[$i]->Id;
            $g_name = str_replace(' ', '_', $groups[$i]->group_name);
            $g_category = $groups[$i]->category_id;
            $sqlQuery = "
                SELECT
        
                    trans.Id,
                    
                    trans.group_id AS Group_Id,
        
                    (SELECT category_id FROM group_table WHERE Id = trans.group_id) AS Group_Type,
        
                    (SELECT group_name FROM group_table WHERE Id = trans.group_id) AS Group_Name,
                    
                    (SELECT company_name FROM client_table WHERE Id = trans.client_id) AS Company_Name,
        
                    (SELECT CONCAT(first_name,' ', last_name) AS fullname FROM client_contacts_table WHERE Id = trans.contact_id) AS Contact_Name,
        
                    trans.role_id AS Role_Id
        
                FROM group_list_table AS trans
        
                WHERE client_id = {$c_uid} AND status = 2 AND trans.group_id = {$g_uid};
            ";
            $data = DB::SELECT("$sqlQuery");
            if(count($data) > 0) {
                $group_list += array(
                    "Group_". $i => $data,
                );
            }
        }

        if(count($group_list) > 0) {
            return array(
                "Code" => 200,
                "Message" => "Success",
                "Details" => $groups,
                "Data" => $group_list
            );
        }
        else
        {
            $bill_to = DB::SELECT("
                    SELECT *
                    FROM client_contacts_table
                    WHERE client_id = {$c_uid} AND role = 3
    	    ");

            if(COUNT($bill_to) > 0)
            {
                return array(
                    "Code" => 201,
                    "bill_to_uid" =>  $bill_to[0]->Id,
                    "bill_to" => $bill_to[0]->first_name . " " . $bill_to[0]->last_name . " (Billing Contact)");
            }
            else
            {
                return array(
                    "Code" => 404,
                    "result" =>  "No Result Found.");
            }

//            return array(
//                "Code" => 404,
//                "Message" => "No Record.",
//                "Details" => [],
//                "Data" => []
//            );
        }

    }

    public function use_default_bill_to($client_id)
    {
        $c_uid = (int)$client_id;

        $bill_to = DB::select("SELECT * FROM client_contacts_table WHERE client_id = {$c_uid} AND role IN (3,5)");

        if(COUNT($bill_to) > 0)
        {
            return array("Code" => 200, "result" => $bill_to);
        }

        return array("Code" => 404, "result" => "No Result Found");
    }

    public function search_group_by_category($client_id, $category)
    {
        $c_uid = (int)$client_id;
        $category = (int)$category;

        $groups = DB::select("SELECT * FROM group_table WHERE client_uid = {$c_uid} AND category_id = {$category}");

        if(COUNT($groups) > 0)
        {
            return array("Code" => 200, "result" => $groups);
        }

        return array("Code" => 404, "result" => "No Result Found");
    }

//    public function search_contact_by_group_edited_kpa($client_id, $category)
//    {
//        $category_uid = (int)$category;
//        $client_uid = (int)$client_id;
//        $groups = DB::select("SELECT * FROM group_table WHERE client_uid = {$client_uid} AND category_id = {$category_uid};");
//
////        dd($groups);
//
//        $lists = [];
//
//        for($i = 0; $i < count($groups); $i++) {
//
//            $g_uid = $groups[$i]->Id;
//
//            $group_list = DB::SELECT("
//                SELECT 
//    
//                g_list.*,
//                
//                (SELECT group_name FROM group_table WHERE Id = g_list.group_id) AS Group_Name,
//                
//                (SELECT company_name FROM client_table WHERE Id = g_list.client_id) AS Company_Name,
//                        
//                (SELECT CONCAT(first_name,' ', last_name) AS fullname FROM client_contacts_table WHERE Id = g_list.contact_id) AS Contact_Name
//                
//                FROM db_magazine_v1.group_list_table AS g_list
//                
//                WHERE group_id = {$g_uid}
//            ");
//
//            $lists[] = $group_list;
//
//        }
//
//        return $lists;
//
//    }

    public function search_contact_by_group($client, $category)
    {
        $client = (int)$client;
        $category = (int)$category;

//        $contact = DB::select("
//            SELECT aa.*, bb.first_name, bb.last_name
//            FROM group_list_table as aa
//            INNER JOIN client_contacts_table as bb ON bb.Id = aa.contact_id
//            WHERE aa.client_id = {$client}");

//        $contact = DB::select("
//            SELECT *
//            FROM group_list_table
//            WHERE client_id = {$client}");
        $groups = DB::SELECT("
                    SELECT xx.Id, xx.group_name, (SELECT COUNT(*) FROM group_list_table as yy WHERE yy.group_id = xx.Id AND yy.role_id = 3) as with_bill_to_contact
                    FROM group_table as xx
                    WHERE xx.client_uid = {$client} AND xx.category_id = {$category}");

        $contact = DB::SELECT("
                SELECT 
                aa.Id as group_id, aa.group_name, bb.contact_id, bb.role_id, cc.Id as contact_uid, concat_ws('',first_name, ' ', last_name) as name
                FROM group_table as aa
                INNER JOIN group_list_table as bb ON bb.group_id = aa.Id
                INNER JOIN client_contacts_table as cc ON cc.Id = bb.contact_id
                WHERE aa.client_uid = {$client} AND aa.category_id = {$category}
                ");

        if(COUNT($contact) > 0)
        {
            return array(
                "Code" => 200,
                "list_of_groups" => $groups,
                "result" => $contact
            );
        }

        return array("Code" => 404, "result" => "No Result Found");
    }

    public function get_bill_to_using_group_to($group_uid)
    {
        $bill_contact = DB::SELECT("
                        SELECT 
                        aa.group_id, bb.Id as contact_uid, concat_ws('',bb.first_name, ' ', bb.last_name) as name
                        FROM group_list_table as aa
                        INNER JOIN client_contacts_table as bb ON bb.Id = aa.contact_id
                        WHERE aa.group_id = {$group_uid} AND aa.role_id = 3");

        if(COUNT($bill_contact) > 0)
        {
            return array(
                "Code" => 200,
                "result" => $bill_contact
            );
        }

        return array("Code" => 404, "result" => "No Result Found");
    }

    public function save_booking(Request $request)
    {
        $booking = new Booking();
        $booking->trans_num = $request['trans_num'];
        $booking->sales_rep_code = $request['sales_rep_code'];
        $booking->client_id = $request['client_id'];
        $booking->agency_id = $request['agency_id'] == "" ? 0 : $request['agency_id'];
        $booking->group_id = $request['group_uid'] == "" ? 0 : $request['group_uid'];
        $booking->status = 1; //default pending
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
        if(count($mag_l) > 0) {
            return redirect("/booking/add_issue/" . $mag_l[0]->Id . "/" . $client_id);
        }

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

        $is_member = DB::table('client_table')->where('Id','=',$client_id)->get();

        return view('booking.add_issue', compact('mag_trans_uid', 'mag_name', 'ad_c', 'ad_p', 'client_id','transaction_uid','booking_trans_num', 'is_member'));
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

    public function save_discount(Request $request, $booking_trans_num, $mag_trans_uid, $client_id)
    {
        $des_discount = (float)$request['txtDiscount'];

        $discount = new DiscountTransaction();
        $discount->trans_id = $booking_trans_num;
        $discount->sales_rep_id = $_COOKIE['Id'];
        $discount->amount = $request['txtBaseAmountHidden'];
        $discount->discount_percent = $des_discount;
        $discount->remarks = $request['txtRemarks'];
        $discount->status = 1;
        $discount->save();

        $notif = new Notification();
        $notif->role = 1; // default administrator
        $notif->from_user_uid = $_COOKIE['Id'];
        $notif->to_user_uid = -1; // undecided purposes
        $notif->noti_desc = "gives " . number_format($des_discount, 0, '.', ',') . "% discretionary discount.";
        $notif->noti_url = "/booking/add_issue/" . $mag_trans_uid . "/" . $client_id;
        $notif->noti_flag = 1;
        $notif->save();

        return redirect("/booking/add_issue/". $mag_trans_uid ."/". $client_id)->with('success', 'Add Successful');
    }

    public function get_discount_transaction($booking_trans_num)
    {
//        $result = DB::table('discount_transaction_table')->where('trans_id','=',$booking_trans_num)->get();
        $result = DB::select("
            SELECT *, 
                (
                    SELECT CONCAT(first_name, ' ', last_name) 
                    FROM user_account 
                    WHERE Id = sales_rep_id
                ) AS sales_rep_name
            FROM discount_transaction_table 
            WHERE trans_id = '{$booking_trans_num}'
        ");
        if(COUNT($result) > 0){
            return array("status" => 202, "result" => $result);
        }
        return array("status" => 404);
    }

    public function approve_discount(Request $request, $booking_trans_num, $mag_trans_uid, $client_id)
    {
        $sls_id = $request['sls_rep'];
        $remarks = $request['txtApproveRemarks'];

        DB::table('discount_transaction_table')
            ->where('trans_id', $booking_trans_num)
            ->update(['status' => 2]); //2 = approved

        $role = DB::SELECT("SELECT role FROM user_account WHERE Id = {$sls_id}");
        $discount = DB::SELECT("SELECT discount_percent FROM discount_transaction_table WHERE trans_id = '{$booking_trans_num}'");

        if($remarks == ""){
            $r = "approved " . number_format($discount[0]->discount_percent, 0, '.', ',') . "% discretionary discount. ";
        }else{
            $r = $remarks;
        }

        $notif = new Notification();
        $notif->role = $role[0]->role; // default administrator
        $notif->from_user_uid = $_COOKIE['Id'];
        $notif->to_user_uid = $sls_id; // undecided purposes
        $notif->noti_desc = $r;
        $notif->noti_url = "/booking/add_issue/" . $mag_trans_uid . "/" . $client_id;
        $notif->noti_flag = 1;
        $notif->save();

        return redirect("/booking/add_issue/". $mag_trans_uid ."/". $client_id)->with('success', 'Discretionary Discount Approved.');

    }

    public function decline_discount(Request $request, $booking_trans_num, $mag_trans_uid, $client_id)
    {
        $sls_id = $request['sls_rep'];
        $remarks = $request['txtDeclineRemarks'];

        DB::table('discount_transaction_table')
            ->where('trans_id', $booking_trans_num)
            ->update(['status' => 3]); //2 = declined

        $role = DB::SELECT("SELECT role FROM user_account WHERE Id = {$sls_id}");
        $discount = DB::SELECT("SELECT discount_percent FROM discount_transaction_table WHERE trans_id = '{$booking_trans_num}'");

        if($remarks == ""){
            $r = "declined " . number_format($discount[0]->discount_percent, 0, '.', ',') . "% discretionary discount. ";
        }else{
            $r = $remarks;
        }

        $notif = new Notification();
        $notif->role = $role[0]->role; // default administrator
        $notif->from_user_uid = $_COOKIE['Id'];
        $notif->to_user_uid = $sls_id; // undecided purposes
        $notif->noti_desc = $r;
        $notif->noti_url = "/booking/add_issue/" . $mag_trans_uid . "/" . $client_id;
        $notif->noti_flag = 1;
        $notif->save();

        return redirect("/booking/add_issue/". $mag_trans_uid ."/". $client_id)->with('success', 'Discretionary Discount Declined.');

    }
}
