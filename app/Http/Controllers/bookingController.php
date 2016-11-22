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
        $booking = DB::table('booking_sales_table')->where('status', '=', 2)->get();

        $magazine = DB::table('magazine_table')->where('status', '=', 2)->get();

        return view('booking.booking_list', compact('booking', 'magazine'))->with('success', 'Booking details successful added!');
    }

    public function add_booking()
    {
        $n_booking = \App\Http\Controllers\VMKhelper::get_new_contract();

        return view('booking.add_booking', compact('n_booking'))->with('success', 'Booking details successful added!');
    }

    public function save_booking(Request $request)
    {
        $booking = new Booking();
        $booking->trans_num = $request['trans_num'];
        $booking->sales_rep_code = $request['sales_rep_code'];
        $booking->client_id = $request['client_id'];
        $booking->agency_id = $request['agency_id'];
        $booking->status = $request['status'];
        $booking->save();

        $booking_uid = $booking->id; //last_inserted_id
        $which_country = $request['which_country'];
        $client_id = $request['client_id'];
        if($booking_uid > 0) {
            return redirect("/booking/magazine-transaction/". $booking_uid ."/". $which_country ."/". $client_id);
        }
        return redirect('https://google.com'); // error
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

    public function add_issue($mag_trans_uid, $client_id)
    {
        $ad_c = DB::table('price_criteria_table')->get();
        $ad_p = DB::table('price_package_table')->get();

        return view('booking.add_issue', compact('mag_trans_uid', 'ad_c', 'ad_p', 'client_id'));
    }
}
