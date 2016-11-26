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
    public function booking_list()
    {
//        $booking = DB::table('booking_sales_table')->where('status', '=', 2)->get();

        $booking = DB::SELECT("    
                        SELECT 
                        booking.*, mag_l.mag_code, mag_l.magazine_country , mag_l.magazine_name,
                        (
                            SELECT CONCAT(a.first_name, ' ', a.middle_name, ' ', a.last_name) 
                            FROM client_contacts_table AS a
                            INNER JOIN client_table AS b
                            ON a.client_id = b.Id
                            WHERE a.Id = booking.client_id
                            AND b.type = 1
                        ) AS client_name,
                        (
                            SELECT CONCAT(a.first_name, ' ', a.middle_name, ' ', a.last_name) 
                            FROM client_contacts_table AS a
                            INNER JOIN client_table AS b
                            ON a.client_id = b.Id
                            WHERE a.Id = booking.agency_id
                            AND b.type = 2
                        ) AS agency_name,
                        (
                            SELECT 
                                CONCAT(a.first_name, ' ', a.middle_name, ' ', a.last_name) AS sales_name
                            FROM user_account AS a
                            WHERE a.Id = booking.sales_rep_code
                        ) AS sales_name
                    FROM 
                        booking_sales_table AS booking
                    INNER JOIN 
                        magazine_transaction_table AS mag_t
                    ON 
                        booking.Id = mag_t.transaction_id
                    INNER JOIN 
                        magazine_table AS mag_l
                    ON 
                        mag_t.magazine_id = mag_l.Id
        ");

        $magazine = DB::table('magazine_table')->where('status', '=', 2)->get();

        return view('booking.booking_list', compact('booking', 'magazine'))->with('success', 'Booking details successful added!');
    }

    public function add_booking()
    {
        $n_booking = \App\Http\Controllers\VMKhelper::get_new_contract();

//        $subscriber = DB::table('client_table')->where('type', '=', 1)->get(); //1 = Subscriber

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


//        $agency = DB::table('client_table')->where('type', '=', 2)->get(); //2 = Agency

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
        $booking->agency_id = $request['agency_id'];
        $booking->status = 1;
        $booking->save();

        $booking_uid = $booking->id; //last_inserted_id
        $which_country = $request['which_country'];
        $client_id = $request['client_id'];
        if($booking_uid > 0) {
            return redirect("/booking/magazine-transaction/". $booking_uid ."/". $which_country ."/". $client_id);
        }

    }

    public function show_transaction_mag($trans_uid, $which_country, $client_id) {
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

    public function getPackageName($criteria_id)
    {
        $ad_p = DB::SELECT("SELECT * FROM price_package_table WHERE criteria_id = {$criteria_id} AND status = 2");

        if($ad_p != null)
        {
            for($i = 0; $i < COUNT($ad_p); $i++)
            {
                $result[] = array(
                    "id" => $ad_p[$i]->Id,
                    "criteria_id" => $ad_p[$i]->criteria_id,
                    "package_name" => $ad_p[$i]->package_name
                );
            }
        }
        return array(
            "list" => $result
        );
    }

    public function add_issue($mag_trans_uid, $client_id)
    {
        $ad_c = DB::table('price_criteria_table')->where('status','=',2)->get();
        $ad_p = DB::table('price_package_table')->where('status','=',2)->get();
        $transaction_uid = DB::table('magazine_transaction_table')->where('Id','=',$mag_trans_uid)->get();

        return view('booking.add_issue', compact('mag_trans_uid', 'ad_c', 'ad_p', 'client_id','transaction_uid'));
    }

    public function save_issue(Request $request, $mag_trans_uid, $client_id)
    {
        $mt_uid = (int)$mag_trans_uid;
        $isMoreThatOne = DB::SELECT("SELECT * FROM magazine_issue_transaction_table WHERE magazine_trans_id = {$mt_uid}");
        if(COUNT($isMoreThatOne) == 0 OR COUNT($isMoreThatOne) > 1)
        {
            $type = DB::SELECT("SELECT bb.type as client_type FROM client_contacts_table as aa INNER JOIN client_table as bb ON bb.Id = aa.client_id WHERE aa.Id = {$client_id}");
//            $type = DB::SELECT("SELECT aa.type as client_type FROM client_table as aa WHERE aa.Id = {$client_id}");

            $ad_c = $request['ad_criteria_id'];
            $ad_p = $request['ad_package_id'];
            $quarter_issue = (int)$request['quarter_issue'];
            $amount = DB::table('price_table')->where('criteria_id', '=', $ad_c)->where('package_id', '=', $ad_p)->where('type', '=', $type[0]->client_type)->get();


            $mit = new MagIssueTransaction();
            $mit->magazine_trans_id = $mag_trans_uid;
            $mit->ad_criteria_id = $ad_c;
            $mit->ad_package_id = $ad_p;
            $mit->amount = $amount[0]->amount_x1;
            $mit->quarter_issued = $quarter_issue;
            $mit->status = 2;
            $mit->save();

//            $mag_trans_uid = $request['magazine_trans_id'];
            $ad_c = DB::table('price_criteria_table')->get();
            $ad_p = DB::table('price_package_table')->get();
            $transaction_uid = DB::table('magazine_transaction_table')->where('Id','=',$mag_trans_uid)->get();

//            return view('booking.add_issue', compact('mag_trans_uid','ad_c', 'ad_p', 'client_id', 'transaction_uid'));
            return redirect("/booking/add_issue/". $mag_trans_uid ."/". $client_id);

        }
        elseif(COUNT($isMoreThatOne) == 1)
        {
            $type = DB::SELECT("SELECT bb.type as client_type FROM client_contacts_table as aa INNER JOIN client_table as bb ON bb.Id = aa.client_id WHERE aa.Id = {$client_id}");
//            $type = DB::SELECT("SELECT aa.type as client_type FROM client_table as aa WHERE aa.Id = {$client_id}");

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
            $amount = DB::table('price_table')->where('criteria_id', '=', $ad_c)->where('package_id', '=', $ad_p)->where('type', '=', $type[0]->client_type)->get();

            $mit = new MagIssueTransaction();
            $mit->magazine_trans_id = $mag_trans_uid;
            $mit->ad_criteria_id = $ad_c;
            $mit->ad_package_id = $ad_p;
            $mit->amount = $amount[0]->amount_x2_more;
            $mit->quarter_issued = $quarter_issue;
            $mit->status = 2;
            $mit->save();

//            $mag_trans_uid = $request['magazine_trans_id'];
            $ad_c = DB::table('price_criteria_table')->get();
            $ad_p = DB::table('price_package_table')->get();
            $transaction_uid = DB::table('magazine_transaction_table')->where('Id','=',$mag_trans_uid)->get();

//            return view('booking.add_issue', compact('mag_trans_uid','ad_c', 'ad_p', 'client_id', 'transaction_uid'));
            return redirect("/booking/add_issue/". $mag_trans_uid ."/". $client_id);
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

}
