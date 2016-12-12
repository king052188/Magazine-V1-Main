<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Magazine;
use App\MagazineCompany;
use App\MagazinePrice;
use App\MagazineDiscount;
use DB;

class magazineController extends Controller
{
    public function index()
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $magazines = Magazine::all();
        return view('magazine/index', compact('magazines'));
    }

    public function create()
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $logo_uid = \App\Http\Controllers\VMKhelper::get_logo_uid();

        return view('magazine/create', compact('logo_uid'));
    }

    public function magazine_add_new(Request $request)
    {
//        $logo_uid = \App\Http\Controllers\VMKhelper::get_logo_uid();

        $magazine = new Magazine();
        $magazine->logo_uid = $request['logo_uid'];
        $magazine->company_id = (int)$request['cid'];
        $magazine->mag_code = $request['magcode'];
        $magazine->magazine_name = $request['magname'];
        $magazine->magazine_country = (int)$request['magcountry'];
        $magazine->status = (int)$request['status'];
        $magazine->save();

        if($magazine->id > 0) {
            $mag_uid = $magazine->id;
            return redirect('magazine/add-ad-color-and-size/'. $mag_uid)->with('success', 'Successfully Added New Magazine.');
        }
        return redirect('magazine/create')->with('success', 'Oops, Something went wrong.');

    }

    public function magazine_add_color_size_api()
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $get_magazines = DB::SELECT("SELECT * FROM magazine_table");
        if ($get_magazines != null)
        {
            for($i = 0; $i < COUNT($get_magazines); $i++)
            {
                $get_ad = DB::SELECT("SELECT aa.*, aa.created_at as ad_created FROM magzine_price_table as aa WHERE aa.mag_id = {$get_magazines[$i]->Id}");

                $mag[] = array(
                    "Id" => $get_magazines[$i]->Id,
                    "company_id" => $get_magazines[$i]->company_id,
                    "mag_code" => $get_magazines[$i]->mag_code,
                    "magazine_name" => $get_magazines[$i]->magazine_name,
                    "magazine_country" => $get_magazines[$i]->magazine_country,
                    "status" => $get_magazines[$i]->status,
                    "ad_result" => $get_ad
                );
            }
        };

        return array(
            "result" => $mag
        );
    }

    public function magazine_add_color_size($mag_uid)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

//        $get_magazines = DB::SELECT("SELECT * FROM magazine_table");
//        for($i = 0; $i < COUNT($get_magazines); $i++)
//        {
//            $get_ad[] = DB::SELECT("SELECT aa.*, aa.created_at as ad_created FROM magzine_price_table as aa WHERE aa.mag_id = {$get_magazines[$i]->Id}");
//        }
        $get_magazines = DB::SELECT("SELECT aa.*, bb.company_name as company_name
                                    FROM 
                                    magazine_table as aa
                                    INNER JOIN magazine_company_table as bb ON bb.Id = aa.company_id
                                    WHERE aa.Id = {$mag_uid}");
        if ($get_magazines != null)
        {
            $price = array();
            $mag = array();
            for($i = 0; $i < COUNT($get_magazines); $i++)
            {
                $get_price = DB::SELECT("SELECT 
                                      aa.*, aa.created_at as ad_created, bb.name as ad_color_name, cc.package_name as ad_size_package_name
                                      FROM magzine_price_table as aa 
                                      INNER JOIN price_criteria_table as bb ON bb.Id = aa.ad_color
                                      INNER JOIN price_package_table as cc ON cc.Id = aa.ad_size
                                      WHERE aa.mag_id = {$get_magazines[$i]->Id}");

                for($x = 0; $x < COUNT($get_price); $x++)
                {
                    $get_discount = DB::SELECT("SELECT * FROM magzine_discount_table WHERE mag_price_id = {$get_price[$x]->Id}");

                    $price[] = array(
                        "ad_Id" => $get_price[$x]->Id,
                        "ad_color" => $get_price[$x]->ad_color_name,
                        "ad_size" => $get_price[$x]->ad_size_package_name,
                        "ad_amount" => $get_price[$x]->ad_amount,
                        "ad_status" => $get_price[$x]->ad_status,
                        "ad_created" => $get_price[$x]->ad_created,
                        "discount_result" => $get_discount
                    );
                }

                $mag[] = array(
                    "Id" => $get_magazines[$i]->Id,
                    "company_id" => $get_magazines[$i]->company_name,
                    "mag_code" => $get_magazines[$i]->mag_code,
                    "magazine_name" => $get_magazines[$i]->magazine_name,
                    "magazine_country" => $get_magazines[$i]->magazine_country == 1 ? "US" : "CANADA",
                    "status" => $get_magazines[$i]->status,
                    "ad_result" => $price
                );
            }
        }else{
            $mag = null;
            return view('magazine/ad', compact('mag_uid','mag'));
        }

//        dd($mag);

        return view('magazine/ad', compact('mag_uid','mag'));
    }

    public function add_color_size_discount(Request $request, $mag_uid)
    {
//        $discount = trim($request['discount']) == "" ? 0 : $request['discount'];
//
//       return ($discount);

        $mp = new MagazinePrice();
        $mp->mag_id = (int)$mag_uid;
        $mp->ad_color = $request['ad_color'];
        $mp->ad_size = $request['ad_size'];
        $mp->ad_amount = $request['ad_amount'];
        $mp->ad_status = 2;
        $mp->save();
        $mp_last_id = $mp->id;

        $discount = $request['discount'];
        $type = 2;

        foreach($discount as $dis) {

            $md = new MagazineDiscount();
            $md->mag_price_id = (int)$mp_last_id;
            $md->percent = trim($dis) == "" ? 0 : $dis;
            $md->type = $type++;
            $md->status = 2;
            $md->save();
        }

        return redirect('/magazine/add-ad-color-and-size/'. $mag_uid)->with('success', 'Successfully Saved.');
    }

    public function save_company(Request $request)
    {
//        $logo_uid = \App\Http\Controllers\VMKhelper::get_logo_uid();

        $company = new MagazineCompany();
        $company->logo_uid = $request['logo_uid'];
        $company->company_name = $request['company_name'];
        $company->address_1 = $request['address_1'];
        $company->address_2 = $request['address_2'];
        $company->city = $request['city'];
        $company->state = $request['state'];
        $company->country = $request['country'];
        $company->email = $request['email'];
        $company->phone = $request['phone'];
        $company->fax = $request['fax'];
        $company->status = 1;
        $company->save();

        if($company->id > 0) {
            return redirect('magazine/create')->with('success', 'Successfully Added New Company.');
        }
        return redirect('magazine/create')->with('success', 'Oops, Something went wrong.');
    }

    public function get_country($magc_id)
    {
        $magc_id = (int)$magc_id;
        $result = DB::table('magazine_company_table')->where('country','=',$magc_id)->get();
        if(COUNT($result) != 0){
            return array(
                "result" => $result
            );
        }

        return array(
            "result" => 404
        );

    }

}
