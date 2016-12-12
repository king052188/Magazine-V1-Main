<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\UserAccount;
use DB;

class userAccountController extends Controller
{
    public function index($filter = null)
    {
        if (!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $filter_tran = "WHERE role IN (1,2,3)";

        if($filter != null){
            $filter_tran = "WHERE role = {$filter}";
        }

        $users = DB::SELECT("SELECT * FROM user_account {$filter_tran}");

        return view('users/index', compact('users', 'filter'));
    }

    public function create()
    {
        if (!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        return view('users/create');
    }

    public function store(Request $request)
    {
        $hash_pass = \App\Http\Controllers\VMKhelper::get_new_password($request['password']);

        $user = new UserAccount();
        $user->username = $request['username'];
        $user->password = $hash_pass['Hash'];
        $user->first_name = $request['first_name'];
        $user->middle_name = $request['middle_name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->mobile = $request['mobile'];
        $user->role = $request['role'];
        $user->status = 2;
        $user->save();

        return redirect('users/all')->with('success', 'Successfully Added New User.');
    }
}
