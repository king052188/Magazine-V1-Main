<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Magazine;
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

        return view('magazine/create');
    }

    public function magazine_add_new(Request $request)
    {
        $magazine = new Magazine();
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

    public function magazine_add_color_size($mag_uid)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        return view('magazine/ad');
    }

}
