<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Transaction;
use App\Magazine;
use App\Client;
use App\Agency;
use App\Salesperson;
use DB;


class transactionController extends Controller
{
    public function index()
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $transactions = Transaction::all();
        return view('transaction/index', compact('transactions'));
    }

    public function create()
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }
        
        $salespersons = Salesperson::all();
        $magazines = Magazine::all();
        $magazines = Client::all();
        $magazines = Agency::all();
        return view('transaction/create', compact('magazines', 'salespersons'));
    }

    public function store(Request $request)
    {
        $numberofissue = (int)$request['numberofissue'];

        for($i = 0; $i < $numberofissue; $i++) {

            $transaction = new Transaction();
            $transaction->srepcode = $request['srepcode'];
            $transaction->client_code = $request['client_code'];
            $transaction->magcode = $request['magcode'];
            $transaction->agencycode = $request['agencycode'];
            $transaction->contract_id = $request['contract_id'];
            $transaction->ad_code = $request['ad_code'];
            $transaction->ad_size = $request['ad_size'];
            $transaction->contract_amount = $request['contract_amount'];
            $transaction->status = $request['status'];
            $transaction->save();

        }

        return redirect('transaction/all')->with('success', 'Successfully Added New Transaction.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
                            if(isset($_POST["username"]))
                                {
                                if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
                                    die();
                                }
                                $mysqli = new mysqli('host' , 'sql_username', 'sql_pass', 'database');
                                if ($mysqli->connect_error){
                                    die('Could not connect to database!');
                                }
                                
                                $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
                                
                                $statement = $mysqli->prepare("SELECT username FROM user_list WHERE username=?");
                                $statement->bind_param('s', $username);
                                $statement->execute();
                                $statement->bind_result($username);
                                if($statement->fetch()){
                                    die('<img src="public/images/not-available.png" />');
                                }else{
                                    die('<img src="public/images/available.png" />');
                                }
                            }
    }
}
