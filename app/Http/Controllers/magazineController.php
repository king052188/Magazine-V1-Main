<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Magazine;
use App\MagazineCompany;
use App\MagazinePrice;
use App\MagazineDiscount;
use App\MagazineIssueDiscount;
use App\MagDigitalPrice;
use DB;

class magazineController extends Controller
{
    public function index()
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $logo_uid = \App\Http\Controllers\VMKhelper::get_logo_uid();

        $magazines = Magazine::all();

        $nav_dashboard = "";
        $nav_clients = "";
        $nav_publisher = "";
        $nav_publication = "active";
        $nav_sales = "";
        $nav_payment = "";
        $nav_reports = "";
        $nav_users = "";

        return view('magazine/index', compact('magazines', 'logo_uid','nav_dashboard','nav_clients', 'nav_publisher', 'nav_publication','nav_sales','nav_payment','nav_reports','nav_users'));
    }

    public function create()
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $logo_uid = \App\Http\Controllers\VMKhelper::get_logo_uid();

        $nav_dashboard = "";
        $nav_clients = "";
        $nav_publisher = "";
        $nav_publication = "active";
        $nav_sales = "";
        $nav_payment = "";
        $nav_reports = "";
        $nav_users = "";

        return view('magazine/create', compact('logo_uid','nav_dashboard','nav_clients', 'nav_publisher', 'nav_publication','nav_sales','nav_payment','nav_reports','nav_users'));
    }

    public function magazine_add_company($add = null)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $result = DB::SELECT("SELECT * FROM magazine_company_table ORDER BY company_name");
        $logo_uid = \App\Http\Controllers\VMKhelper::get_logo_uid();

        if($add != null){
            $add_publisher_show = "active";
            $list_publisher_show = "";
        }else{
            $list_publisher_show = "active";
            $add_publisher_show = "";
        }

        $nav_dashboard = "";
        $nav_clients = "";
        $nav_publisher = "active";
        $nav_publication = "";
        $nav_sales = "";
        $nav_payment = "";
        $nav_reports = "";
        $nav_users = "";

        return view('magazine/create_company', compact('logo_uid','result', 'add_publisher_show', 'list_publisher_show' ,'nav_dashboard','nav_clients', 'nav_publisher', 'nav_publication','nav_sales','nav_payment','nav_reports','nav_users'));

    }

    public function magazine_add_new(Request $request)
    {
//        $logo_uid = \App\Http\Controllers\VMKhelper::get_logo_uid();

        $magazine = new Magazine();
        $magazine->logo_uid = $request['logo_uid'];
        $magazine->company_id = (int)$request['cid'];
        $magazine->mag_code = $request['magcode'];
        $magazine->magazine_name = $request['magname'];
        $magazine->magazine_country = (int)$request['magcountryID'];
        $magazine->status = (int)$request['status'];
        $magazine->magazine_year = (int)$request['year_issue'];
        $magazine->magazine_issues = (int)$request['number_issue'];
        $magazine->magazine_type = (int)$request['type_of_magazine'];
        $magazine->save();


        if($magazine->id > 0) {
            $mag_uid = $magazine->id;
            $mag_type = (int)$request['type_of_magazine'];
            if($mag_type > 1) {
                return redirect('magazine/digital/settings/'. $mag_uid)->with('success', 'Successfully Added New Magazine.');
            }
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

    public function magazine_ad_delete($ad_uid)
    {
        $ad_uid = (int)$ad_uid;
        $result = DB::DELETE("DELETE FROM magzine_price_table WHERE Id = {$ad_uid}");
        if($result)
        {
            return array("status" => 202, "description" => "Delete Successful");
        }

        return array("status" => 404, "description" => "Delete Failed");
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

        $ad_c = DB::table('price_criteria_table')->where('status','=',2)->get();
        $ad_s = DB::table('price_package_table')->where('status','=',2)->get();

        $nav_dashboard = "";
        $nav_clients = "";
        $nav_publisher = "";
        $nav_publication = "active";
        $nav_sales = "";
        $nav_payment = "";
        $nav_reports = "";
        $nav_users = "";

        return view('magazine/ad', compact('mag_uid','mag', 'ad_c', 'ad_s', 'discount_issue','nav_dashboard','nav_clients', 'nav_publisher', 'nav_publication','nav_sales','nav_payment','nav_reports','nav_users'));
    }

    public function show_digital_settings($mag_uid) {

        $m_uid = (int)$mag_uid;
        $get_magazines = DB::SELECT("SELECT aa.*, bb.company_name as company_name
                                    FROM 
                                    magazine_table as aa
                                    INNER JOIN magazine_company_table as bb ON bb.Id = aa.company_id
                                    WHERE aa.Id = {$m_uid}");

        $mag = $get_magazines;

        $nav_dashboard = "";
        $nav_clients = "";
        $nav_publisher = "";
        $nav_publication = "active";
        $nav_sales = "";
        $nav_payment = "";
        $nav_reports = "";
        $nav_users = "";

        return view('magazine/digital', compact('mag_uid','mag', 'discount_issue','nav_dashboard','nav_clients', 'nav_publisher', 'nav_publication','nav_sales','nav_payment','nav_reports','nav_users'));
    }

    public function show_digital_settings_save(Request $request, $mag_uid){

        $magazine = new MagDigitalPrice();
        $magazine->mag_id = $mag_uid;
        $magazine->ad_type = $request['digital_type'];
        $magazine->ad_size = $request['digital_size'];
        $magazine->ad_amount = $request['digital_amount'];
        $magazine->ad_issue = $request['digital_issue'];
        $magazine->ad_status = 2;
        $magazine->save();

        return redirect('/magazine/digital/settings/' . $mag_uid);
    }

    public function get_show_digital_settings_info($mag_uid){
        $m_uid = (int)$mag_uid;
        $get_magazines = DB::SELECT("
                                SELECT aa.*, bb.magazine_name as magazine_name
                                FROM 
                                magzine_digital_price_table as aa
                                INNER JOIN magazine_table as bb ON bb.Id = aa.mag_id
                                WHERE aa.mag_id = {$m_uid}
                                ");

        if(COUNT($get_magazines) > 0)
        {
            return array("Code" => 200, "Result" => $get_magazines);
        }else{
            return array("Code" => 404, "Description" => "Failed");
        }
    }

    public function get_discount_issue($mag_uid)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $d = DB::table('magazine_issue_discount_table')->where('magazine_id','=',$mag_uid)->get();
        if(COUNT($d) > 0)
        {
            for($i = 0; $i < COUNT($d); $i++)
            {
                $r[] = array(
                    "status" => 200,
                    "type" => $d[$i]->type,
                    "percent" => $d[$i]->percent * 1
                );
            }

            return array(
                'status' => 200,
                'result' => $r
            );
        }
        return array("status" => 404, "description" => "No Result Found.");
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
            $md->percent = trim($dis) == "" ? 0 : ($dis / 100);
            $md->type = $type++;
            $md->status = 2;
            $md->save();
        }
        
        return redirect('/magazine/add-ad-color-and-size/'. $mag_uid)->with('success', 'Successfully Saved.');
    }

    public function add_issue_discount($mag_id, $discount_2, $discount_3, $discount_4, $discount_5, $discount_6, $discount_7, $discount_8, $discount_9, $discount_10, $discount_11, $discount_12)
    {
        if($discount_2 != 0){
            $chk_2 = DB::SELECT("SELECT * FROM magazine_issue_discount_table WHERE magazine_id = {$mag_id} AND type = 2");
            if(COUNT($chk_2) > 0){
                MagazineIssueDiscount::where('magazine_id', '=', $mag_id)->where('type', '=', 2)->update(['percent' => $discount_2]);
            }else{
                $d_2 = new MagazineIssueDiscount();
                $d_2->magazine_id = $mag_id;
                $d_2->percent = $discount_2;
                $d_2->type = 2;
                $d_2->status = 2;
                $d_2->save();
            }
        }
        else
        {
            MagazineIssueDiscount::where('magazine_id', '=', $mag_id)->where('type', '=', 2)->update(['percent' => 0]);
        }

        if($discount_3 != 0){
            $chk_3 = DB::SELECT("SELECT * FROM magazine_issue_discount_table WHERE magazine_id = {$mag_id} AND type = 3");
            if(COUNT($chk_3) > 0){
                MagazineIssueDiscount::where('magazine_id', '=', $mag_id)->where('type', '=', 3)->update(['percent' => $discount_3]);
            }else{
                $d_3 = new MagazineIssueDiscount();
                $d_3->magazine_id = $mag_id;
                $d_3->percent = $discount_3;
                $d_3->type = 3;
                $d_3->status = 2;
                $d_3->save();
            }
        }
        else
        {
            MagazineIssueDiscount::where('magazine_id', '=', $mag_id)->where('type', '=', 3)->update(['percent' => 0]);
        }

        if($discount_4 != 0){
            $chk_4 = DB::SELECT("SELECT * FROM magazine_issue_discount_table WHERE magazine_id = {$mag_id} AND type = 4");
            if(COUNT($chk_4) > 0){
                MagazineIssueDiscount::where('magazine_id', '=', $mag_id)->where('type', '=', 4)->update(['percent' => $discount_4]);
            }else{
                $d_4 = new MagazineIssueDiscount();
                $d_4->magazine_id = $mag_id;
                $d_4->percent = $discount_4;
                $d_4->type = 4;
                $d_4->status = 2;
                $d_4->save();
            }
        }
        else
        {
            MagazineIssueDiscount::where('magazine_id', '=', $mag_id)->where('type', '=', 4)->update(['percent' => 0]);
        }

        if($discount_5 != 0){
            $chk_5 = DB::SELECT("SELECT * FROM magazine_issue_discount_table WHERE magazine_id = {$mag_id} AND type = 5");
            if(COUNT($chk_5) > 0){
                MagazineIssueDiscount::where('magazine_id', '=', $mag_id)->where('type', '=', 5)->update(['percent' => $discount_5]);
            }else{
                $d_5 = new MagazineIssueDiscount();
                $d_5->magazine_id = $mag_id;
                $d_5->percent = $discount_5;
                $d_5->type = 5;
                $d_5->status = 2;
                $d_5->save();
            }
        }
        else
        {
            MagazineIssueDiscount::where('magazine_id', '=', $mag_id)->where('type', '=', 5)->update(['percent' => 0]);
        }

        if($discount_6 != 0){
            $chk_6 = DB::SELECT("SELECT * FROM magazine_issue_discount_table WHERE magazine_id = {$mag_id} AND type = 6");
            if(COUNT($chk_6) > 0){
                MagazineIssueDiscount::where('magazine_id', '=', $mag_id)->where('type', '=', 6)->update(['percent' => $discount_6]);
            }else{
                $d_6 = new MagazineIssueDiscount();
                $d_6->magazine_id = $mag_id;
                $d_6->percent = $discount_6;
                $d_6->type = 6;
                $d_6->status = 2;
                $d_6->save();
            }
        }
        else
        {
            MagazineIssueDiscount::where('magazine_id', '=', $mag_id)->where('type', '=', 6)->update(['percent' => 0]);
        }

        if($discount_7 != 0){
            $chk_7 = DB::SELECT("SELECT * FROM magazine_issue_discount_table WHERE magazine_id = {$mag_id} AND type = 7");
            if(COUNT($chk_7) > 0){
                MagazineIssueDiscount::where('magazine_id', '=', $mag_id)->where('type', '=', 7)->update(['percent' => $discount_7]);
            }else{
                $d_5 = new MagazineIssueDiscount();
                $d_5->magazine_id = $mag_id;
                $d_5->percent = $discount_7;
                $d_5->type = 7;
                $d_5->status = 2;
                $d_5->save();
            }
        }
        else
        {
            MagazineIssueDiscount::where('magazine_id', '=', $mag_id)->where('type', '=', 7)->update(['percent' => 0]);
        }

        if($discount_8 != 0){
            $chk_8 = DB::SELECT("SELECT * FROM magazine_issue_discount_table WHERE magazine_id = {$mag_id} AND type = 8");
            if(COUNT($chk_8) > 0){
                MagazineIssueDiscount::where('magazine_id', '=', $mag_id)->where('type', '=', 8)->update(['percent' => $discount_8]);
            }else{
                $d_8 = new MagazineIssueDiscount();
                $d_8->magazine_id = $mag_id;
                $d_8->percent = $discount_8;
                $d_8->type = 8;
                $d_8->status = 2;
                $d_8->save();
            }
        }
        else
        {
            MagazineIssueDiscount::where('magazine_id', '=', $mag_id)->where('type', '=', 8)->update(['percent' => 0]);
        }

        if($discount_9 != 0){
            $chk_9 = DB::SELECT("SELECT * FROM magazine_issue_discount_table WHERE magazine_id = {$mag_id} AND type = 9");
            if(COUNT($chk_9) > 0){
                MagazineIssueDiscount::where('magazine_id', '=', $mag_id)->where('type', '=', 9)->update(['percent' => $discount_9]);
            }else{
                $d_9 = new MagazineIssueDiscount();
                $d_9->magazine_id = $mag_id;
                $d_9->percent = $discount_9;
                $d_9->type = 9;
                $d_9->status = 2;
                $d_9->save();
            }
        }
        else
        {
            MagazineIssueDiscount::where('magazine_id', '=', $mag_id)->where('type', '=', 9)->update(['percent' => 0]);
        }

        if($discount_10 != 0){
            $chk_10 = DB::SELECT("SELECT * FROM magazine_issue_discount_table WHERE magazine_id = {$mag_id} AND type = 10");
            if(COUNT($chk_10) > 0){
                MagazineIssueDiscount::where('magazine_id', '=', $mag_id)->where('type', '=', 10)->update(['percent' => $discount_10]);
            }else{
                $d_10 = new MagazineIssueDiscount();
                $d_10->magazine_id = $mag_id;
                $d_10->percent = $discount_10;
                $d_10->type = 10;
                $d_10->status = 2;
                $d_10->save();
            }
        }
        else
        {
            MagazineIssueDiscount::where('magazine_id', '=', $mag_id)->where('type', '=', 10)->update(['percent' => 0]);
        }

        if($discount_11 != 0){
            $chk_11 = DB::SELECT("SELECT * FROM magazine_issue_discount_table WHERE magazine_id = {$mag_id} AND type = 11");
            if(COUNT($chk_11) > 0){
                MagazineIssueDiscount::where('magazine_id', '=', $mag_id)->where('type', '=', 11)->update(['percent' => $discount_11]);
            }else{
                $d_11 = new MagazineIssueDiscount();
                $d_11->magazine_id = $mag_id;
                $d_11->percent = $discount_11;
                $d_11->type = 11;
                $d_11->status = 2;
                $d_11->save();
            }
        }
        else
        {
            MagazineIssueDiscount::where('magazine_id', '=', $mag_id)->where('type', '=', 11)->update(['percent' => 0]);
        }

        if($discount_12 != 0){
            $chk_12 = DB::SELECT("SELECT * FROM magazine_issue_discount_table WHERE magazine_id = {$mag_id} AND type = 12");
            if(COUNT($chk_12) > 0){
                MagazineIssueDiscount::where('magazine_id', '=', $mag_id)->where('type', '=', 12)->update(['percent' => $discount_12]);
            }else{
                $d_12 = new MagazineIssueDiscount();
                $d_12->magazine_id = $mag_id;
                $d_12->percent = $discount_12;
                $d_12->type = 12;
                $d_12->status = 2;
                $d_12->save();
            }
        }
        else
        {
            MagazineIssueDiscount::where('magazine_id', '=', $mag_id)->where('type', '=', 12)->update(['percent' => 0]);
        }
        
        return array(
            "status" => 200
        );
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
        $company->zip_code = $request['zip_code'];
        $company->toll_free_phone = $request['toll_free_phone'];
        $company->toll_free_fax = $request['toll_free_fax'];
        $company->status = 2;
        $company->save();

        if($company->id > 0) {
            return redirect('/magazine/create/company')->with('success', 'Successfully Added Publisher.');
        }
        return redirect('/magazine/create/company')->with('success', 'Oops, Something went wrong.');
    }

    public function get_company()
    {
        //$magc_id = (int)$magc_id;

        //version 1.0
        //$result = DB::table('magazine_company_table')->where('country','=',$magc_id)->get();

        //version 1.1
        $result = DB::table('magazine_company_table')->where('status','=',2)->get();
        if(COUNT($result) != 0){
            return array(
                "result" => $result
            );
        }

        return array(
            "result" => 404
        );

    }

    public function get_country($company_uid)
    {
        $company_uid = (int)$company_uid;

        $result = DB::table('magazine_company_table')->where('Id','=',$company_uid)->get();
        if(COUNT($result) != 0){
            return array(
                "result" => $result
            );
        }

        return array(
            "result" => 404
        );

    }

    public function magazine_update($magazine_uid)
    {
        $magazine = DB::table('magazine_table')->where('Id', '=', $magazine_uid)->get();
        if($magazine != null){
            return array("result" => $magazine);
        }

        return array("result" => 404);
    }

    public function magazine_update_save(Request $request)
    {
        Magazine::where('Id', '=', $request['magazine_uid'])
            ->update([
//                'logo_uid' => $request['logo_uid'],
                'company_id' => (int)$request['cid'],
                'mag_code' => $request['magcode'],
                'magazine_name' => $request['magname'],
                'magazine_year' => $request['year_issue'],
                'magazine_issues' => $request['number_issue'],
                'magazine_country' => (int)$request['magcountryID'],
                'status' => $request['status']
            ]);

        return redirect('/magazine/all')->with('success', 'Successfully Updated.');
    }

    public function list_publishers($publisher_uid)
    {
        $publisher_uid = (int)$publisher_uid;
        $result = DB::SELECT("SELECT * FROM magazine_company_table WHERE Id = {$publisher_uid}");

        if($result != null){
            return array("status" => 200, "result" => $result);
        }

        return array("status" => 404, "description" => "Failed");
    }

    public function edit_publishers(Request $request)
    {
        MagazineCompany::where('Id', '=', $request['e_publisher_uid'])
            ->update([
                'company_name' => $request['e_company_name'],
                'address_1' => $request['e_address_1'],
                'address_2' => $request['e_address_2'],
                'city' => $request['e_city'],
                'state' => $request['e_state'],
                'country' => $request['e_country'],
                'email' => $request['e_email'],
                'phone' => $request['e_phone'],
                'fax' => $request['e_fax'],
                'zip_code' => $request['e_zip_code'],
                'toll_free_phone' => $request['e_toll_free_phone'],
                'toll_free_fax' => $request['e_toll_free_fax']
//                'logo_uid' => $request['e_logo_uid']
            ]);

        return redirect('/magazine/create/company')->with('success', 'Successfully Updated.');
    }

    public function set_inactive_publishers($publisher_uid)
    {
        $publisher_uid = (int)$publisher_uid;
        MagazineCompany::where('Id', '=', $publisher_uid)
            ->update([
                'status' => 1
            ]);

        return array("status" => 200, "description" => "Success");
    }

    public function set_active_publishers($publisher_uid)
    {
        $publisher_uid = (int)$publisher_uid;
        MagazineCompany::where('Id', '=', $publisher_uid)
            ->update([
                'status' => 2
            ]);

        return array("status" => 200, "description" => "Success");
    }

    public function edit_digital_settings_info($digital_uid) {

        $get = DB::SELECT("SELECT * FROM magzine_digital_price_table WHERE Id = {$digital_uid}");
        if(COUNT($get) > 0){

            return array(
                "status" => 200,
                "Id" => $get[0]->Id,
                "ad_type" => $get[0]->ad_type,
                "ad_size" => $get[0]->ad_size,
                "ad_amount" => $get[0]->ad_amount,
                "ad_issue" => $get[0]->ad_issue
            );
        }

        return array("status" => 404, "description" => "Failed");

//        MagDigitalPrice::where('Id', '=', $mag_uid)
//            ->update([
//                'status' => 1
//            ]);



    }

    public function update_digital_settings_info($digital_uid, $digital_type, $digital_size, $digital_amount, $digital_issue) {

        MagDigitalPrice::where('Id', '=', $digital_uid)
            ->update([
                'ad_type' => $digital_type,
                'ad_size' => $digital_size,
                'ad_amount' => $digital_amount,
                'ad_issue' => $digital_issue,
            ]);

        return array("status" => 200, "description" => "Success");

    }

    public function delete_digital_settings_info($digital_uid) {

        DB::DELETE("DELETE FROM magzine_digital_price_table WHERE Id = {$digital_uid}");

        return array("status" => 200, "description" => "Success");

    }


}
