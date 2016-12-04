<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Salesperson;
use DB;

class salespersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $salesperson = DB::table('user_account')->where('role', '=', 3)->get();
        return view('salesperson/index', compact('salesperson'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

       return view('salesperson/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new Salesperson();
        $client->srepcode = $request['srepcode'];
        $client->srepfname = $request['srepfname'];
        $client->sremname = $request['sremname'];
        $client->srepsurname = $request['srepsurname'];
        $client->srepadd1 = $request['srepadd1'];
        $client->srepadd2 = $request['srepadd2'];
        $client->srepadd3 = $request['srepadd3'];
        $client->slandline = $request['slandline'];
        $client->srepmobile = $request['srepmobile'];
        $client->srepemail = $request['srepemail'];
        $client->srepstatus = $request['srepstatus'];
        $client->save();

        return redirect('salesperson/all')->with('success', 'Successfully Added New Salesperson.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
