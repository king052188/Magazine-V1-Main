<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\UserAccount;
use App\Goal;
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

        $publication = DB::table('magazine_table')->where('status', '=', 2)->orderBy('magazine_name', 'ASC')->get();

        $nav_dashboard = "";
        $nav_clients = "";
        $nav_publisher = "";
        $nav_publication = "";
        $nav_sales = "";
        $nav_payment = "";
        $nav_reports = "";
        $nav_users = "active";

        return view('users/index', compact('users', 'filter','nav_dashboard','nav_clients', 'nav_publisher', 'nav_publication', 'nav_sales','nav_payment','nav_reports','nav_users','publication' ));
    }

    public function create()
    {
        if (!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $nav_dashboard = "";
        $nav_clients = "";
        $nav_publisher = "";
        $nav_publication = "";
        $nav_sales = "";
        $nav_payment = "";
        $nav_reports = "";
        $nav_users = "active";

        return view('users/create', compact('nav_dashboard','nav_clients', 'nav_publisher', 'nav_publication', 'nav_sales','nav_payment','nav_reports','nav_users'));
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

    public function get_goal_settings(Request $request) {

      $u_id = (int)$request->user_id;

      $g = DB::select("
        SELECT *,
        (SELECT magazine_name FROM magazine_table WHERE id = magazine_id) AS magazine_name
        FROM user_gaol_settings_table WHERE user_id = {$u_id};
      ");

      return array(
        "Status" => 200,
        "Data" => $g,
      );

    }

    public function add_goal_settings(Request $request) {

      $g = new Goal();
      $g->user_id = $request->user_id;
      $g->magazine_id = $request->magazine_id;
      $g->issue = $request->issue;
      $g->year = $request->year;
      $g->amount = $request->amount;
      $g->status = 1;
      if($g->save()) {
        return array(
          "Status" => 200
        );
      }

      return array(
        "Status" => 500
      );

    }
}
