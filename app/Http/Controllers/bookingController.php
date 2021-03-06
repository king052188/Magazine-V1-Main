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
use App\DigitalDiscountTransaction;
use App\Notification;
use App\ArtworkTable;
use App\Notes;
use App\MagazineDigitalTransaction;
use App\CreditCardInfo;

class bookingController extends Controller
{
    public function booking_list()
    {
        $filter_publication = 0;
        $filter_sales_rep = 0;
        $filter_client = 0;
        $filter_status = 0;

        if($_COOKIE['role'] == 3){
            $filter_sales_rep = "WHERE mag.magazine_type = 1 AND booked.sales_rep_code = {$_COOKIE['Id']};";
        }else{
            $filter_sales_rep = "WHERE mag.magazine_type = 1;";
        }

        $booking = DB::SELECT("
            SELECT

                booked.Id,

                booked.client_id,

                booked.agency_id,

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

        $publication = DB::table('magazine_table')->where('status', '=', 2)->where('magazine_type', '=', 1)->orderBy('magazine_name', 'ASC')->get();
        $clients = DB::table('client_table')->where('status', '=', 2)->orderBy('company_name', 'ASC')->get();
        $sales_rep = DB::table('user_account')->where('status', '=', 2)->orderBy('first_name', 'ASC')->get();

        $nav_dashboard = "";
        $nav_clients = "";
        $nav_publisher = "";
        $nav_publication = "";
        $nav_sales = "active";
        $nav_payment = "";
        $nav_reports = "";
        $nav_users = "";

        return view('booking.booking_list', compact('booking', 'publication', 'clients', 'sales_rep', 'filter_publication', 'filter_sales_rep', 'filter_client', 'filter_status', 'nav_dashboard','nav_clients', 'nav_publisher', 'nav_publication', 'nav_sales', 'nav_payment','nav_reports','nav_users'))->with('success', 'Booking details successful added!');
    }

    public function booking_digital_list() {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $filter_publication = 0;
        $publication = DB::table('magazine_table')->where('status', '=', 2)->where('magazine_type', '=', 2)->orderBy('magazine_name', 'ASC')->get();

        $filter_client = 0;
        $clients = DB::table('client_table')->where('status', '=', 2)->orderBy('company_name', 'ASC')->get();

        $nav_dashboard = "";
        $nav_clients = "";
        $nav_publisher = "";
        $nav_publication = "";
        $nav_sales = "active";
        $nav_payment = "";
        $nav_reports = "";
        $nav_users = "";

        return view('booking.digital.booking_digital_list', compact('filter_publication', 'publication', 'filter_client', 'clients', 'filter_status', 'nav_dashboard','nav_clients', 'nav_publisher', 'nav_publication', 'nav_sales', 'nav_payment','nav_reports','nav_users'));
    }

    public function api_get_booking_digital_list($publication, $client){

        if($publication != 0){
            $pub = " AND trans.magazine_id = {$publication}";
        }else{
            $pub = "";
        }

        if($client != 0){
            $cli = " AND booked.client_id = {$client}";
        }else{
            $cli = "";
        }

        $filter_process = $pub . $cli;

        $get = DB::SELECT("
                SELECT

                    booked.Id,

                    ( SELECT Id FROM magazine_transaction_table WHERE transaction_id = booked.Id ) AS mag_trans_id,

                    booked.client_id,

                    booked.agency_id,

                    mag.Id as pub_uid,

                    (SELECT is_member FROM client_table WHERE Id = booked.client_id) AS is_member,

                    booked.trans_num,

                    (null) AS invoice_num,

                    ( SELECT magazine_name FROM magazine_table WHERE Id = trans.magazine_id ) AS mag_name,

                    ( SELECT CONCAT(first_name, ' ', last_name) FROM user_account WHERE Id = booked.sales_rep_code ) AS sales_rep_name,

                    ( SELECT company_name FROM client_table WHERE Id = booked.client_id AND status = 2 AND type != 2 ) AS client_name,

                    ( SELECT COUNT(*) AS lineItems FROM magazine_digital_transaction_table WHERE magazine_trans_id = trans.Id ) AS line_item,

                    ( SELECT SUM(amount) AS lineItems FROM magazine_digital_transaction_table WHERE magazine_trans_id = trans.Id ) AS amount,

                    booked.status,

                    booked.created_at

                FROM booking_sales_table AS booked

                INNER JOIN magazine_transaction_table AS trans

                ON booked.Id = trans.transaction_id

                INNER JOIN magazine_table as mag

                ON mag.Id = trans.magazine_id

                WHERE mag.magazine_type = 2 {$filter_process}
        ");

        if(COUNT($get) > 0){
            return array("Code" => 200, "Result" => $get);
        }

        return array("Code" => 404, "Result" => "No Result Found");
    }

    public function api_update_digital_status($digital_status, $booking_sales_uid){
        Booking::where('Id', '=', $booking_sales_uid)
            ->update([
                'status' => $digital_status
            ]);

        return array("Code" => 200, "Result" => "Success");
    }

    public function booking_list_filter($filter_publication, $filter_sales_rep, $filter_client, $filter_status)
    {
        $filter_publication = (int)$filter_publication;
        $filter_sales_rep = (int)$filter_sales_rep;
        $filter_client = (int)$filter_client;
        $filter_status = (int)$filter_status;

        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        //$filter_status_tran = "WHERE booked.status IN (1, 2, 3, 5)";

        if($filter_publication != 0){
            $filter_publication_tran = "mag.Id = {$filter_publication}";
        }else{
            $filter_publication_tran = "mag.Id LIKE '%'";
        }

        if($_COOKIE['role'] != 3)
        {
            if($filter_sales_rep != 0){
                $filter_sales_rep_tran = "booked.sales_rep_code = {$filter_sales_rep}";
            }else{
                $filter_sales_rep_tran = "booked.sales_rep_code LIKE '%'";
            }
        }
        else
        {
            $filter_sales_rep_tran = "booked.sales_rep_code = {$_COOKIE['Id']}";
        }

        if($filter_client != 0){
            $filter_client_tran = "booked.client_id = {$filter_client}";
        }else{
            $filter_client_tran = "booked.client_id LIKE '%'";
        }

        if($filter_status != 0){
            $filter_status_tran = "booked.status = {$filter_status}";
        }else{
            $filter_status_tran = "booked.status LIKE '%'";
        }

        $filter_process = "WHERE mag.magazine_type = 1 AND " . $filter_publication_tran . ' AND ' . $filter_sales_rep_tran . ' AND ' . $filter_client_tran . ' AND ' . $filter_status_tran;

        $booking = DB::SELECT("
            SELECT

                booked.Id,

                booked.client_id,

                mag.Id as pub_uid,

                (SELECT is_member FROM client_table WHERE Id = booked.client_id) AS is_member,

                booked.trans_num,

                booked.agency_id,

                (null) AS invoice_num,

                ( SELECT magazine_name FROM magazine_table WHERE Id = trans.magazine_id ) AS mag_name,

                ( SELECT magazine_country FROM magazine_table WHERE Id = trans.magazine_id ) AS mag_country,

                ( SELECT CONCAT(first_name, ' ', last_name) FROM user_account WHERE Id = booked.sales_rep_code ) AS sales_rep_name,

                ( SELECT company_name FROM client_table WHERE Id = booked.client_id AND status = 2 AND type != 2 ) AS client_name,

                ( SELECT COUNT(*) AS lineItems FROM magazine_issue_transaction_table WHERE magazine_trans_id = trans.Id ) AS line_item,

                ( SELECT CASE WHEN SUM(line_item_qty) > 0 THEN SUM(line_item_qty) ELSE 0 END AS lineItems FROM magazine_issue_transaction_table WHERE magazine_trans_id = trans.Id ) AS qty,

                ( SELECT SUM(amount) AS lineItems FROM magazine_issue_transaction_table WHERE magazine_trans_id = trans.Id ) AS amount,

                ( SELECT (amount - (amount * (discount_percent / 100))) new_amount FROM discount_transaction_table WHERE trans_id = booked.trans_num AND type = 1 AND status = 2 ) AS new_amount,

                booked.status,

                booked.created_at

            FROM booking_sales_table AS booked

            INNER JOIN magazine_transaction_table AS trans

            ON booked.Id = trans.transaction_id

            INNER JOIN magazine_table as mag

            ON mag.Id = trans.magazine_id

            {$filter_process}

            ");

        $publication = DB::table('magazine_table')->where('status', '=', 2)->where('magazine_type', '=', 1)->get();
        $clients = DB::table('client_table')->where('status', '=', 2)->get();
        $sales_rep = DB::table('user_account')->where('status', '=', 2)->get();

        $nav_dashboard = "";
        $nav_clients = "";
        $nav_publisher = "";
        $nav_publication = "";
        $nav_sales = "active";
        $nav_payment = "";
        $nav_reports = "";
        $nav_users = "";

        return view('booking.booking_list', compact('booking', 'publication', 'clients', 'sales_rep', 'filter_publication', 'filter_sales_rep', 'filter_client', 'filter_status', 'nav_dashboard','nav_clients', 'nav_publisher', 'nav_publication', 'nav_sales', 'nav_payment','nav_reports','nav_users'))->with('success', 'Booking details successful added!');
    }

    public function booking_checkpoint(){
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $nav_dashboard = "";
        $nav_clients = "";
        $nav_publisher = "";
        $nav_publication = "";
        $nav_sales = "active";
        $nav_payment = "";
        $nav_reports = "";
        $nav_users = "";

        return view('booking.checkpoint', compact('n_booking','subscriber','agency', 'clients', 'nav_dashboard','nav_clients', 'nav_publisher', 'nav_publication', 'nav_sales','nav_payment','nav_reports','nav_users'));
    }

    public function add_booking()
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $n_booking = \App\Http\Controllers\VMKhelper::get_new_contract();

        $clients = DB::select("
          SELECT C.*,
          CASE WHEN M.magazine_name IS NULL THEN 'ALL' ELSE CONCAT(M.magazine_name, ', ALL') END AS magazine_name
          FROM client_table AS C
          LEFT JOIN magazine_table AS M
          ON C.magazine_id = M.Id"
        );

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

        $nav_dashboard = "";
        $nav_clients = "";
        $nav_publisher = "";
        $nav_publication = "";
        $nav_sales = "active";
        $nav_payment = "";
        $nav_reports = "";
        $nav_users = "";

        return view('booking.add_booking', compact('n_booking','subscriber','agency', 'clients', 'nav_dashboard','nav_clients', 'nav_publisher', 'nav_publication', 'nav_sales','nav_payment','nav_reports','nav_users'))->with('success', 'Booking details successful added!');
    }

    public function add_booking_digital()
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

        $nav_dashboard = "";
        $nav_clients = "";
        $nav_publisher = "";
        $nav_publication = "";
        $nav_sales = "active";
        $nav_payment = "";
        $nav_reports = "";
        $nav_users = "";

        return view('booking.digital.add_booking_digital', compact('n_booking','subscriber','agency', 'clients', 'nav_dashboard','nav_clients', 'nav_publisher', 'nav_publication', 'nav_sales','nav_payment','nav_reports','nav_users'))->with('success', 'Booking details successful added!');
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

    public function save_booking_digital(Request $request)
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
//        $which_country = $request['which_country'];
        $client_id = $request['client_id'];
        if($booking_uid > 0) {
            //return redirect("/booking/digital/magazine-transaction/". $booking_uid ."/". $which_country ."/". $client_id);

            //remove country
            return redirect("/booking/digital/magazine-transaction/". $booking_uid ."/". $client_id);
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

        //magazine_type = 1 (PRINT) | 2 (DIGITAL)
        $mag_list = DB::table('magazine_table')->where('magazine_country', '=', $w_country)->where('magazine_type', '=', 1)->where('status', '=', 2)->get();
        if(count($mag_l) > 0) {
            $disabled = ["set" => "disabled"];
        }

        $nav_dashboard = "";
        $nav_clients = "";
        $nav_publisher = "";
        $nav_publication = "";
        $nav_sales = "active";
        $nav_payment = "";
        $nav_reports = "";
        $nav_users = "";

        return view('booking.magazine_transaction', compact('booking_uid', 'mag_list', 'which_country', 'client_id', 'mag_l', 'disabled', 'nav_dashboard','nav_clients', 'nav_publisher', 'nav_publication', 'nav_sales','nav_payment','nav_reports','nav_users'))->with('success', 'Successfully Added Magazine');
    }

    public function show_transaction_mag_digital($trans_uid, $client_id) {

        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $disabled = ["set" => ""];
        $booking_uid = (int)$trans_uid;

        $mag_l = DB::SELECT("
                    SELECT * FROM magazine_table as mag
                    LEFT JOIN magazine_transaction_table as mag_t
                    ON mag_t.magazine_id = mag.Id
                    WHERE mag_t.transaction_id = {$booking_uid}
                    ");

        if(count($mag_l) > 0) {
            return redirect("/booking/digital/add_issue/" . $mag_l[0]->Id . "/" . $client_id);
        }

        //magazine_type = 1 (PRINT) | 2 (DIGITAL)
        //$mag_list = DB::table('magazine_table')->where('magazine_country', '=', $w_country)->where('magazine_type', '=', 2)->where('status', '=', 2)->get();
        $mag_list = DB::table('magazine_table')->where('magazine_type', '=', 2)->where('status', '=', 2)->get();
        if(count($mag_l) > 0) {
            $disabled = ["set" => "disabled"];
        }

        $nav_dashboard = "";
        $nav_clients = "";
        $nav_publisher = "";
        $nav_publication = "";
        $nav_sales = "active";
        $nav_payment = "";
        $nav_reports = "";
        $nav_users = "";

        return view('booking.digital.magazine_transaction_digital', compact('booking_uid', 'mag_list', 'client_id', 'mag_l', 'disabled', 'nav_dashboard','nav_clients', 'nav_publisher', 'nav_publication', 'nav_sales','nav_payment','nav_reports','nav_users'))->with('success', 'Successfully Added Magazine');
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

    public function save_magazine_transaction_digital(Request $request, $trans_uid, $client_id)
    {
        $booking_uid = (int)$trans_uid;
        $exist = DB::table('magazine_transaction_table')->where('transaction_id', '=', $booking_uid)->get();
        if(COUNT($exist) > 0)
        {
            // not allow
            return redirect("/booking/digital/magazine-transaction/". $booking_uid ."/". $client_id)->with("message", "1 magazine only");
        }

        $mt = new MagazineTransaction();
        $mt->magazine_id = $request['magazine_id'];
        $mt->transaction_id = $booking_uid;
        $r = $mt->save();
        $message = $r ? "Success" : "Fail";
        return redirect("/booking/digital/magazine-transaction/". $booking_uid ."/". $client_id)->with("message", $message);
        /* END = Additional 11-20-2016 8:54PM | MJT */
    }

    public function check_packages($issue_id, $package_id) {
      $get_strans = DB::select("
       SELECT ad_package_id
       FROM magazine_issue_transaction_table
       WHERE quarter_issued = {$issue_id}
       AND ad_package_id = {$package_id}
       AND DATE_FORMAT(created_at, '%Y-%m-%d') = DATE_FORMAT('2017-08-29 06:45:47', '%Y-%m-%d');
      ");

      return COUNT($get_strans) > 0 ? true : false;
    }
    public function getPackageName($criteria_id, $mag_uid, $issue = 0)
    {
        $issued = (int)$issue;

        $ad_p = DB::SELECT("
                SELECT b.package_name, b.status AS package_status, a.*
                FROM magzine_price_table AS a
                INNER JOIN price_package_table AS b
                ON a.ad_size = b.Id
                WHERE a.mag_id = {$mag_uid} AND a.ad_color = {$criteria_id}
              ");

        if($ad_p != null)
        {
            for($i = 0; $i < COUNT($ad_p); $i++)
            {
                if($ad_p[$i]->package_status == 3) {

                }
                else {
                  $result[] = array(
                      "price_uid" => $ad_p[$i]->Id,
                      "ad_size" => $ad_p[$i]->ad_size,
                      "package_name" => $ad_p[$i]->package_name,
                      "ad_amount" => $ad_p[$i]->ad_amount
                  );
                }
            }
        }
        return array(
            "count" => COUNT($result),
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

        // $check_trans = DB::select("
        //   SELECT DISTINCT ad_package_id
        //   FROM magazine_issue_transaction_table
        //   WHERE quarter_issued = 1
        //   AND DATE_FORMAT(created_at, '%Y-%m-%d') = DATE_FORMAT('2017-12-02 06:44:45', '%Y-%m-%d');
        // ");

        // dd($check_trans);

        $ad_c = DB::SELECT("
          SELECT b.Id as c_uid, b.name
          FROM magzine_price_table AS a
          INNER JOIN price_criteria_table AS b
          ON a.ad_color = b.Id
          WHERE a.mag_id = {$transaction_uid[0]->magazine_id}
          GROUP BY c_uid, b.name ASC
        ");

        // $is_member = DB::table('client_table')->where('Id','=',$client_id)->get();

        $is_member = DB::select("
          SELECT C.*,
          CASE WHEN M.magazine_name IS NULL THEN 'ALL' ELSE CONCAT(M.magazine_name, ', ALL') END AS magazine_name
          FROM client_table AS C
          LEFT JOIN magazine_table AS M
          ON C.magazine_id = M.Id
          WHERE C.Id = {$client_id};"
        );

        $nav_dashboard = "";
        $nav_clients = "";
        $nav_publisher = "";
        $nav_publication = "";
        $nav_sales = "active";
        $nav_payment = "";
        $nav_reports = "";
        $nav_users = "";

        return view('booking.add_issue', compact('mag_trans_uid', 'mag_name', 'ad_c', 'ad_p', 'client_id','transaction_uid','booking_trans_num', 'is_member', 'nav_dashboard','nav_clients', 'nav_publisher', 'nav_publication', 'nav_sales','nav_payment','nav_reports','nav_users'));
    }

    public function add_issue_digital($mag_trans_uid, $client_id)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $ad_p = DB::table('price_package_table')->where('status','=',2)->get();

        $transaction_uid = DB::table('magazine_transaction_table')->where('Id','=',$mag_trans_uid)->get();


        $ad_c = null;

        $is_member = null;

        if( COUNT($transaction_uid) == 0 ) {

            return array("code" => 404, "message" => "No Records Found.");
        }

        $booking_trans_num = DB::table('booking_sales_table')->where('Id','=',$transaction_uid[0]->transaction_id)->get();

        $mag_name = DB::table('magazine_table')->where('Id','=',$transaction_uid[0]->magazine_id)->get();

        $ad_c = DB::SELECT("
                    SELECT *
                    FROM magzine_digital_price_table
                    WHERE mag_id = {$transaction_uid[0]->magazine_id}
                    ORDER BY ad_type, ad_size ASC
            ");

        $is_member = DB::table('client_table')->where('Id','=',$client_id)->get();

        $nav_dashboard = "";
        $nav_clients = "";
        $nav_publisher = "";
        $nav_publication = "";
        $nav_sales = "active";
        $nav_payment = "";
        $nav_reports = "";
        $nav_users = "";

        return view('booking.digital.add_issue_digital', compact('mag_trans_uid', 'mag_name', 'ad_c', 'ad_p', 'client_id','transaction_uid','booking_trans_num', 'is_member', 'nav_dashboard','nav_clients', 'nav_publisher', 'nav_publication', 'nav_sales','nav_payment','nav_reports','nav_users'));
    }

    public function api_get_digital_price($digital_price_uid){
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $get = DB::SELECT("SELECT * FROM magzine_digital_price_table WHERE Id = {$digital_price_uid}");
        if(COUNT($get) > 0){
            return array(
                "Code" => 200,
                "mag_id" => $get[0]->mag_id,
                "ad_type" => $get[0]->ad_type,
                "ad_size" => $get[0]->ad_size,
                "ad_amount" => $get[0]->ad_amount,
                "ad_issue" => $get[0]->ad_issue
            );
        }

        return array("Code" => 404, "Description" => "No Data Found.");
    }

    public function digital_add_issue_save($trans_id, $mag_id, $client_id, $position_id, $month_id, $year, $week_id, $amount){
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $mit = new MagazineDigitalTransaction();
        $mit->magazine_trans_id = (int)$trans_id;
        $mit->magazine_id = $mag_id;
        $mit->client_id = $client_id;
        $mit->position_id = $position_id;
        $mit->month_id = $month_id;
        $mit->year = $year;
        $mit->week_id = $week_id;
        $mit->amount = $amount;
        $mit->status = 2;
        $mit->save();

        return array("Code" => 200, "Description" => "Success");
    }

    public function api_get_digital_transaction($mag_id, $client_id){
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

//        $get = DB::SELECT("
//                    SELECT
//                    aa.*, aa.Id as d_uid,
//                    (SELECT magazine_name FROM magazine_table WHERE Id = aa.magazine_id) as mag_name,
//                    (SELECT ad_type FROM magzine_digital_price_table WHERE Id = aa.position_id) as ad_type,
//                    (SELECT ad_size FROM magzine_digital_price_table WHERE Id = aa.position_id) as ad_size,
//                    (SELECT ad_amount FROM magzine_digital_price_table WHERE Id = aa.position_id) as ad_amount,
//                    (SELECT ad_issue FROM magzine_digital_price_table WHERE Id = aa.position_id) as ad_issue,
//                    (
//                      SELECT bb.trans_num FROM magazine_transaction_table as cc
//                      INNER JOIN booking_sales_table as bb ON bb.Id = cc.transaction_id
//                      WHERE cc.Id = aa.magazine_trans_id
//                    ) as trans_num
//                    FROM magazine_digital_transaction_table as aa
//                    WHERE aa.magazine_trans_id = {$mag_id} AND client_id = {$client_id}
//        ");

        $get = DB::SELECT("
                    SELECT

                            booked.Id,

                            ( SELECT Id FROM magazine_transaction_table WHERE transaction_id = booked.Id ) AS mag_trans_id,

                            booked.client_id,

                            booked.agency_id,

                            mag.Id as pub_uid,

                            (SELECT is_member FROM client_table WHERE Id = booked.client_id) AS is_member,

                            booked.trans_num,

                            (null) AS invoice_num,

                            ( SELECT magazine_name FROM magazine_table WHERE Id = trans.magazine_id ) AS mag_name,

                            ( SELECT CONCAT(first_name, ' ', last_name) FROM user_account WHERE Id = booked.sales_rep_code ) AS sales_rep_name,

                            ( SELECT company_name FROM client_table WHERE Id = booked.client_id AND status = 2 AND type != 2 ) AS client_name,

                            ( SELECT COUNT(*) AS lineItems FROM magazine_digital_transaction_table WHERE magazine_trans_id = trans.Id ) AS line_item,

                            ( SELECT SUM(amount) AS lineItems FROM magazine_digital_transaction_table WHERE magazine_trans_id = trans.Id ) AS amount,

                            booked.status,

                            booked.created_at

                        FROM booking_sales_table AS booked

                        INNER JOIN magazine_transaction_table AS trans

                        ON booked.Id = trans.transaction_id

                        INNER JOIN magazine_table as mag

                        ON mag.Id = trans.magazine_id

                        WHERE mag.magazine_type = 2 WHERE aa.magazine_trans_id = {$mag_id} AND client_id = {$client_id}
        ");

        if(COUNT($get) > 0){

            $n = 1;
            for($i = 0; $i < COUNT($get); $i++)
            {
                if($get[$i]->ad_issue == 1){
                    $a_issue = "Monthly";
                }else{
                    $a_issue = "Weekly";
                }

                if($get[$i]->month_id == 1){
                    $month = "Jan";
                }else if($get[$i]->month_id == 2){
                    $month = "Feb";
                }else if($get[$i]->month_id == 3){
                    $month = "Mar";
                }else if($get[$i]->month_id == 4){
                    $month = "Apr";
                }else if($get[$i]->month_id == 5){
                    $month = "May";
                }else if($get[$i]->month_id == 6){
                    $month = "Jun";
                }else if($get[$i]->month_id == 7){
                    $month = "Jul";
                }else if($get[$i]->month_id == 8){
                    $month = "Aug";
                }else if($get[$i]->month_id == 9){
                    $month = "Sept";
                }else if($get[$i]->month_id == 10){
                    $month = "Oct";
                }else if($get[$i]->month_id == 11){
                    $month = "Nov";
                }else if($get[$i]->month_id == 12){
                    $month = "Dec";
                }else{
                    $month = "No Month Selected";
                }

                $result[] = array(
                    "trans_num" => $get[$i]->trans_num,
                    "d_uid" => $get[$i]->d_uid,
                    "d_num" => $n++,
                    "mag_name" => $get[$i]->mag_name,
                    "ad_type" => $get[$i]->ad_type,
                    "ad_size" => $get[$i]->ad_size,
                    "ad_amount" => $get[$i]->ad_amount,
                    "ad_issue" => $a_issue,
                    "ad_months" => $month,
                    "ad_year" => $get[$i]->year,
                    "ad_weeks" => $get[$i]->week_id == 0 ? "" : "Wk " . $get[$i]->week_id
                );
            }

            return array(
                "Code" => 200,
                "Result" => $result
            );
        }

        return array("Code" => 404, "Description" => "No Data Found.");
    }

    public function api_delete_digital_transaction($d_uid){
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        DB::DELETE("DELETE FROM magazine_digital_transaction_table WHERE Id = {$d_uid}");

        return array("status" => 200, "Description" => "Success");
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
        $mag_id_for_discount = (int)$request['mag_id_for_discount'];
        $line_issue_count = (int)$request['line_issue_count'] + 1;
        $trans_num_for_discount = $request['trans_num_for_discount'];

//        return array(
//            "mag_id_for_discount" => $mag_id_for_discount,
//            "line_issue_count" => $line_issue_count
//        );

        if($line_issue_count > 1)
        {

            $chk_issue_discount = DB::SELECT("SELECT * FROM discount_transaction_table WHERE trans_id = '{$trans_num_for_discount}' AND type = 2");

            if(COUNT($chk_issue_discount) == 0)
            {
                $chk_avail_discount = DB::SELECT("SELECT * FROM magazine_issue_discount_table WHERE magazine_id = '{$mag_id_for_discount}'");
                if(COUNT($chk_avail_discount) == 0)
                {
                    return redirect("/booking/add_issue/". $mt_uid ."/". $client_id)->with('fail', 'Please add issue discount.');
                }
                else
                {
                    $chk_avail_discount_aa = DB::SELECT("SELECT * FROM magazine_issue_discount_table WHERE magazine_id = '{$mag_id_for_discount}' AND type = {$line_issue_count}");
                    if(COUNT($chk_avail_discount_aa) == 0)
                    {
                        $chk_avail_discount_bb = DB::SELECT("SELECT * FROM magazine_issue_discount_table WHERE magazine_id = '{$mag_id_for_discount}' ORDER BY type DESC LIMIT 1");
                        $ad_c = $request['ad_criteria_id'];
                        $ad_p = $request['ad_p_split'];
                        $quarter_issue = (int)$request['quarter_issue'];
                        $line_item_qty = (int)$request['line_item_qty'];
                        $ad_amount = $request['ad_amount'];
                        $price_uid = $request['price_uid'];

                        $check = DB::table('magazine_issue_transaction_table')
                            ->where('magazine_trans_id', '=', $mt_uid)
                            ->where('ad_criteria_id', '=', $ad_c)
                            ->where('ad_package_id', '=', $ad_p)
                            ->where('quarter_issued', '=', $quarter_issue)
                            ->get();

                        if(COUNT($check) > 0)
                        {
                            return redirect("/booking/add_issue/". $mt_uid ."/". $client_id)->with('fail', 'Please delete original data, and insert with additional quantity.');
                        }

                        $mit = new MagIssueTransaction();
                        $mit->magazine_trans_id = $mt_uid;
                        $mit->ad_criteria_id = $ad_c;
                        $mit->ad_package_id = $ad_p;
                        $mit->amount = $ad_amount;
                        $mit->quarter_issued = $quarter_issue;
                        $mit->line_item_qty = $line_item_qty;
                        $mit->mag_price_id = $price_uid;
                        $mit->status = 2;
                        $mit->save();

                        $dt = new DiscountTransaction();
                        $dt->trans_id = $trans_num_for_discount;
                        $dt->sales_rep_id = $_COOKIE['Id'];
                        $dt->amount = 0.00;
                        $dt->discount_percent = $chk_avail_discount_bb[0]->percent;
                        $dt->remarks = "SYSTEM AUTOMATED DISCOUNT";
                        $dt->type = 2; //automated
                        $dt->status = 2; //approved
                        $dt->save();

                        return redirect("/booking/add_issue/". $mt_uid ."/". $client_id)->with('success', 'Add Successful');
                    }
                    else
                    {
                        $ad_c = $request['ad_criteria_id'];
                        $ad_p = $request['ad_p_split'];
                        $quarter_issue = (int)$request['quarter_issue'];
                        $line_item_qty = (int)$request['line_item_qty'];
                        $ad_amount = $request['ad_amount'];
                        $price_uid = $request['price_uid'];

                        $check = DB::table('magazine_issue_transaction_table')
                            ->where('magazine_trans_id', '=', $mt_uid)
                            ->where('ad_criteria_id', '=', $ad_c)
                            ->where('ad_package_id', '=', $ad_p)
                            ->where('quarter_issued', '=', $quarter_issue)
                            ->get();

                        if(COUNT($check) > 0)
                        {
                            return redirect("/booking/add_issue/". $mt_uid ."/". $client_id)->with('fail', 'Please delete original data, and insert with additional quantity.');
                        }

                        $mit = new MagIssueTransaction();
                        $mit->magazine_trans_id = $mt_uid;
                        $mit->ad_criteria_id = $ad_c;
                        $mit->ad_package_id = $ad_p;
                        $mit->amount = $ad_amount;
                        $mit->quarter_issued = $quarter_issue;
                        $mit->line_item_qty = $line_item_qty;
                        $mit->mag_price_id = $price_uid;
                        $mit->status = 2;
                        $mit->save();

                        $dt = new DiscountTransaction();
                        $dt->trans_id = $trans_num_for_discount;
                        $dt->sales_rep_id = $_COOKIE['Id'];
                        $dt->amount = 0.00;
                        $dt->discount_percent = $chk_avail_discount_aa[0]->percent;
                        $dt->remarks = "SYSTEM AUTOMATED DISCOUNT";
                        $dt->type = 2; //automated
                        $dt->status = 2; //approved
                        $dt->save();

                        return redirect("/booking/add_issue/". $mt_uid ."/". $client_id)->with('success', 'Add Successful');
                    }
                }
            }
            else
            {
                $chk_avail_discount = DB::SELECT("SELECT * FROM magazine_issue_discount_table WHERE magazine_id = '{$mag_id_for_discount}'");
                if(COUNT($chk_avail_discount) == 0)
                {
                    return redirect("/booking/add_issue/". $mt_uid ."/". $client_id)->with('fail', 'Please add issue discount.');
                }
                else
                {
                    $chk_avail_discount_aa = DB::SELECT("SELECT * FROM magazine_issue_discount_table WHERE magazine_id = '{$mag_id_for_discount}' AND type = {$line_issue_count}");
                    if(COUNT($chk_avail_discount_aa) == 0)
                    {
                        $chk_avail_discount_bb = DB::SELECT("SELECT * FROM magazine_issue_discount_table WHERE magazine_id = '{$mag_id_for_discount}' ORDER BY type DESC LIMIT 1");
                        $ad_c = $request['ad_criteria_id'];
                        $ad_p = $request['ad_p_split'];
                        $quarter_issue = (int)$request['quarter_issue'];
                        $line_item_qty = (int)$request['line_item_qty'];
                        $ad_amount = $request['ad_amount'];
                        $price_uid = $request['price_uid'];

                        $check = DB::table('magazine_issue_transaction_table')
                            ->where('magazine_trans_id', '=', $mt_uid)
                            ->where('ad_criteria_id', '=', $ad_c)
                            ->where('ad_package_id', '=', $ad_p)
                            ->where('quarter_issued', '=', $quarter_issue)
                            ->get();

                        if(COUNT($check) > 0)
                        {
                            return redirect("/booking/add_issue/". $mt_uid ."/". $client_id)->with('fail', 'Please delete original data, and insert with additional quantity.');
                        }

                        $mit = new MagIssueTransaction();
                        $mit->magazine_trans_id = $mt_uid;
                        $mit->ad_criteria_id = $ad_c;
                        $mit->ad_package_id = $ad_p;
                        $mit->amount = $ad_amount;
                        $mit->quarter_issued = $quarter_issue;
                        $mit->line_item_qty = $line_item_qty;
                        $mit->mag_price_id = $price_uid;
                        $mit->status = 2;
                        $mit->save();

                        DiscountTransaction::where('trans_id', '=', $trans_num_for_discount)
                            ->where('type', '=', 2)
                            ->update(['discount_percent' => $chk_avail_discount_bb[0]->percent]);

                        return redirect("/booking/add_issue/". $mt_uid ."/". $client_id)->with('success', 'Add Successful');
                    }
                    else
                    {
                        $chk_avail_discount_bb = DB::SELECT("SELECT * FROM magazine_issue_discount_table WHERE magazine_id = '{$mag_id_for_discount}' ORDER BY type DESC LIMIT 1");
                        $ad_c = $request['ad_criteria_id'];
                        $ad_p = $request['ad_p_split'];
                        $quarter_issue = (int)$request['quarter_issue'];
                        $line_item_qty = (int)$request['line_item_qty'];
                        $ad_amount = $request['ad_amount'];
                        $price_uid = $request['price_uid'];

                        $check = DB::table('magazine_issue_transaction_table')
                            ->where('magazine_trans_id', '=', $mt_uid)
                            ->where('ad_criteria_id', '=', $ad_c)
                            ->where('ad_package_id', '=', $ad_p)
                            ->where('quarter_issued', '=', $quarter_issue)
                            ->get();

                        if(COUNT($check) > 0)
                        {
                            return redirect("/booking/add_issue/". $mt_uid ."/". $client_id)->with('fail', 'Please delete original data, and insert with additional quantity.');
                        }

                        $mit = new MagIssueTransaction();
                        $mit->magazine_trans_id = $mt_uid;
                        $mit->ad_criteria_id = $ad_c;
                        $mit->ad_package_id = $ad_p;
                        $mit->amount = $ad_amount;
                        $mit->quarter_issued = $quarter_issue;
                        $mit->line_item_qty = $line_item_qty;
                        $mit->mag_price_id = $price_uid;
                        $mit->status = 2;
                        $mit->save();

                        DiscountTransaction::where('trans_id', '=', $trans_num_for_discount)
                            ->where('type', '=', 2)
                            ->update(['discount_percent' => $chk_avail_discount_bb[0]->percent]);

                        return redirect("/booking/add_issue/". $mt_uid ."/". $client_id)->with('success', 'Add Successful');
                    }
                }
            }
        }
        else
        {
            $ad_c = $request['ad_criteria_id'];
            $ad_p = $request['ad_p_split'];
            $quarter_issue = (int)$request['quarter_issue'];
            $line_item_qty = (int)$request['line_item_qty'];
            $ad_amount = $request['ad_amount'];
            $price_uid = $request['price_uid'];

            $check = DB::table('magazine_issue_transaction_table')
                ->where('magazine_trans_id', '=', $mt_uid)
                ->where('ad_criteria_id', '=', $ad_c)
                ->where('ad_package_id', '=', $ad_p)
                ->where('quarter_issued', '=', $quarter_issue)
                ->get();

            if(COUNT($check) > 0)
            {
                return redirect("/booking/add_issue/". $mt_uid ."/". $client_id)->with('fail', 'Please delete original data, and insert with additional quantity.');
            }

            $mit = new MagIssueTransaction();
            $mit->magazine_trans_id = $mt_uid;
            $mit->ad_criteria_id = $ad_c;
            $mit->ad_package_id = $ad_p;
            $mit->amount = $ad_amount;
            $mit->quarter_issued = $quarter_issue;
            $mit->line_item_qty = $line_item_qty;
            $mit->mag_price_id = $price_uid;
            $mit->status = 2;
            $mit->save();

            return redirect("/booking/add_issue/". $mt_uid ."/". $client_id)->with('success', 'Add Successful');
        }

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

    public function save_discount(Request $request, $booking_trans_num, $mag_trans_uid, $client_id, $IsDigital = null)
    {
        $des_discount = (float)$request['txtDiscount'];
        $base_amount = (float)$request['txtBaseAmountHidden'];

        if($IsDigital != null) {
            $urls = "/booking/digital/add_issue/";
            $base_item_id = (int)$request['txtItemIdHidden'];
            $discount = new DigitalDiscountTransaction();
            $discount->booking_trans_num = $booking_trans_num;
            $discount->item_id = $base_item_id;
            $discount->sales_rep_id = $_COOKIE['Id'];
            $discount->amount = $base_amount;
            $discount->discount_percent = $des_discount;
            $discount->remarks = $request['txtRemarks'];
            $discount->status = 1; //1 = For Approval
            $discount->save();
        }
        else {
            $urls = "/booking/add_issue/";
            $discount = new DiscountTransaction();
            $discount->trans_id = $booking_trans_num;
            $discount->sales_rep_id = $_COOKIE['Id'];
            $discount->amount = $base_amount;
            $discount->discount_percent = $des_discount;
            $discount->remarks = $request['txtRemarks'];
            $discount->type = 1; //1 = Discretionary Discount
            $discount->status = 1; //1 = For Approval
            $discount->save();
        }

        $notif = new Notification();
        $notif->role = 1; // default administrator
        $notif->from_user_uid = $_COOKIE['Id'];
        $notif->to_user_uid = -1; // undecided purposes
        $notif->noti_desc = "gives " . number_format($des_discount, 2) . "% discretionary discount.";
        $notif->noti_url = $urls . $mag_trans_uid . "/" . $client_id;
        $notif->noti_flag = 1;
        $notif->save();

        return redirect($urls . $mag_trans_uid ."/". $client_id)->with('success', 'Added Discretionary Discount Successful');
    }

    public function cancel_discretionary_discount($trans_num, $salesperson_uid, $mag_trans_uid, $client_id){
        $chk = DB::SELECT("SELECT sales_rep_id, discount_percent FROM discount_transaction_table WHERE trans_id = '{$trans_num}' AND sales_rep_id = {$salesperson_uid}");
        if(COUNT($chk) > 0){

            $urls = "/booking/add_issue/";
            $notif = new Notification();
            $notif->role = 1; // default administrator
            $notif->from_user_uid = $_COOKIE['Id'];
            $notif->to_user_uid = -1; // undecided purposes
            $notif->noti_desc = "cancelled " . number_format($chk[0]->discount_percent, 2) . "% discretionary discount.";
            $notif->noti_url = $urls . $mag_trans_uid . "/" . $client_id;
            $notif->noti_flag = 1;
            $notif->save();

            DB::SELECT("DELETE FROM discount_transaction_table WHERE trans_id = '{$trans_num}' AND sales_rep_id = {$salesperson_uid} AND type = 1"); //type = 1 (Discretionary Discount)

            return array("Code" => 200, "Description" => "Cancel Successful");
        }else{
            return array("Code" => 404, "Description" => "This is not your discretionary discount");
        }
    }

    public function revoke_discretionary_discount($trans_num, $salesperson_uid, $mag_trans_uid, $client_id){
        $chk = DB::SELECT("SELECT sales_rep_id, discount_percent FROM discount_transaction_table WHERE trans_id = '{$trans_num}' AND sales_rep_id = {$salesperson_uid}");
        if(COUNT($chk) > 0){

            $urls = "/booking/add_issue/";
            $notif = new Notification();
            $notif->role = 3; // salesperson
            $notif->from_user_uid = $_COOKIE['Id'];
            $notif->to_user_uid = $salesperson_uid; // undecided purposes
            $notif->noti_desc = "revoke " . number_format($chk[0]->discount_percent, 2) . "% discretionary discount.";
            $notif->noti_url = $urls . $mag_trans_uid . "/" . $client_id;
            $notif->noti_flag = 1;
            $notif->save();

            DB::SELECT("DELETE FROM discount_transaction_table WHERE trans_id = '{$trans_num}' AND sales_rep_id = {$salesperson_uid} AND type = 1"); //type = 1 (Discretionary Discount)

            return array("Code" => 200, "Description" => "Cancel Successful");
        }else{
            return array("Code" => 404, "Description" => "This is not your discretionary discount");
        }
    }

    public function save_artwork(Request $request, $booking_trans_num, $mag_trans_uid, $client_id)
    {
        /*
         *  Artwork
         *  1 = Supplied
         *  2 = Build
         *  3 = Renewal
         *  4 = Renewal with changes
         *
         * */

        $chk_artwork = DB::SELECT("SELECT * FROM artwork_table WHERE book_trans = '{$booking_trans_num}'");
        if(COUNT($chk_artwork) > 0)
        {
            DB::table('artwork_table')
                ->where('book_trans', '=', $booking_trans_num)
                ->update([
                    'artwork' => $request['selArtwork'],
                    'directions' => $request['txtDirections']
                ]);

            return redirect("/booking/add_issue/". $mag_trans_uid ."/". $client_id)->with('success', 'Update Successful');
        }
        else
        {
            $discount = new ArtworkTable();
            $discount->book_trans = $booking_trans_num;
            $discount->artwork = $request['selArtwork'];
            $discount->directions = $request['txtDirections'];
            $discount->status = 2;
            $discount->save();

            return redirect("/booking/add_issue/". $mag_trans_uid ."/". $client_id)->with('success', 'Add Successful');
        }

    }

    public function get_artwork($booking_trans_num)
    {
        /*
         *  Artwork
         *  1 = Supplied
         *  2 = Build
         *  3 = Renewal
         *  4 = Renewal with changes
         *
         * */

        $get_artwork = DB::SELECT("SELECT * FROM artwork_table WHERE book_trans = '{$booking_trans_num}'");
        if(COUNT($get_artwork) > 0)
        {
            return array("Code" => 200, "result" => $get_artwork);
        }
        else
        {
            return array("Code" => 404, "result" => "No Result Found.");
        }
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
            WHERE trans_id = '{$booking_trans_num}' AND type = 1
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

    public function approve_digital_discount(Request $request, $booking_trans_num, $mag_trans_uid, $client_id)
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
        $notif->noti_url = "/booking/digital/add_issue/" . $mag_trans_uid . "/" . $client_id;
        $notif->noti_flag = 1;
        $notif->save();

        //dd("/booking/digital/add_issue/". $mag_trans_uid ."/". $client_id);

        return redirect("/booking/digital/add_issue/". $mag_trans_uid ."/". $client_id)->with('success', 'Discretionary Discount Approved.');

    }

    public function decline_digital_discount(Request $request, $booking_trans_num, $mag_trans_uid, $client_id)
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
        $notif->noti_url = "/booking/digital/add_issue/" . $mag_trans_uid . "/" . $client_id;
        $notif->noti_flag = 1;
        $notif->save();

        return redirect("/booking/digital/add_issue/". $mag_trans_uid ."/". $client_id)->with('success', 'Discretionary Discount Declined.');

    }

    public function notes_save($booking_trans_num, $notes)
    {
//        $get_sales_rep = DB::SELECT("SELECT sales_rep_code FROM booking_sales_table WHERE trans_num = '{$booking_trans_num}'");
//        if(COUNT($get_sales_rep) > 0)
//        {
//
//        }
        if($notes){
            $n = new Notes();
            $n->book_trans = $booking_trans_num;
            $n->sales_rep = $_COOKIE['Id'];
            $n->notes = $notes;
            $n->status = 2;
            $n->save();

            return array("Code" => 200, "Description" => "Success Save", "trans_num" => $booking_trans_num);
        }
    }

    public function notes_get($booking_trans_num)
    {
        $notes_lists = DB::SELECT("
                            SELECT aa.*,
                             (
                                SELECT concat_ws('',first_name, ' ', last_name) as sales_rep_name FROM user_account WHERE Id = aa.sales_rep
                             ) as sales_rep_name
                            FROM notes_table as aa
                            WHERE aa.book_trans = '{$booking_trans_num}'
                            ORDER BY aa.Id ASC
        ");

        if(COUNT($notes_lists) > 0)
        {
            for($i = 0; $i < COUNT($notes_lists); $i++)
            {
                $date_created = \Carbon\Carbon::parse($notes_lists[$i]->created_at);
                $data[] = array(
                    "Id" => $notes_lists[$i]->Id,
                    "sales_rep_id" => $notes_lists[$i]->sales_rep,
                    "sales_rep_name" => $notes_lists[$i]->sales_rep_name,
                    "book_trans" => $notes_lists[$i]->book_trans,
                    "notes" => $notes_lists[$i]->notes,
                    "created_at" => $date_created->format('F d, Y')
                );
            }
            return array("Code" => 200, "Description" => "Success", "result" => $data);
        }

        return array("Code" => 404, "Description" => "No Result Found.");
    }

    public function edit_notes_save($note_uid, $notes)
    {
        Notes::where('Id', '=', $note_uid)
            ->update([
                'notes' => $notes
            ]);

        return array("Code" => 200, "Description" => "Success");
    }

    public function delete_discount($d_uid){
        DB::SELECT("DELETE FROM magazine_digital_discount_transaction_table WHERE Id = {$d_uid}");
        return array("Code" => 200, "Result" => "Delete Success");
    }

    public function credit_card_info($client_id, $bank_name, $card_number, $expiry_date, $cvc_code, $card_holder_name){

        $chk = DB::SELECT("SELECT * FROM client_credit_card_info WHERE client_id = {$client_id}");
        if(COUNT($chk) > 0){
            CreditCardInfo::where('client_id', '=', $client_id)
                ->update([
                    'status' => 2 //1 = primary | 2 = secondary
                ]);

            $expiry_date = str_replace("-", "/", $expiry_date);
            $n = new CreditCardInfo();
            $n->client_id = $client_id;
            $n->card_bank = $bank_name;
            $n->card_number = $card_number;
            $n->card_holder_name = $card_holder_name;
            $n->card_validity = $expiry_date;
            $n->card_pin= $cvc_code;
            $n->status = 1; //set as primary
            $n->save();
        }else{

            $expiry_date = str_replace("-", "/", $expiry_date);
            $n = new CreditCardInfo();
            $n->client_id = $client_id;
            $n->card_bank = $bank_name;
            $n->card_number = $card_number;
            $n->card_holder_name = $card_holder_name;
            $n->card_validity = $expiry_date;
            $n->card_pin= $cvc_code;
            $n->status = 1; //set as primary
            $n->save();
        }

        return array("Code" => 200, "Result" => "Success");
    }

    public function cc_set_primary($cc_uid){

        $get_client_id = DB::SELECT("SELECT client_id FROM client_credit_card_info WHERE Id= {$cc_uid} LIMIT 1");

        CreditCardInfo::where('client_id', '=', $get_client_id[0]->client_id)
            ->update([
                'status' => 2 //1 = primary | 2 = secondary
            ]);

        CreditCardInfo::where('Id', '=', $cc_uid)
            ->update([
                'status' => 1 //1 = primary | 2 = secondary
            ]);

        return array("Code" => 200, "Result" => "Success");
    }

    public function cc_info_list($client_id){
        $list = DB::SELECT("SELECT * FROM client_credit_card_info WHERE client_id = {$client_id}");
        if(COUNT($list) > 0){
            return array("Code" => 200, "Result" => $list);
        }

        return array("Code" => 404, "Result" => "No Data Result");
    }
}
