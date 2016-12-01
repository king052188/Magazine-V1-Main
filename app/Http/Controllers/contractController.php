<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Contract;
use DB;

class contractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = Contract::all();
        return view('contract/index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contract/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new Contract();
        $client->srepcode = $request['srepcode'];
        $client->magcode = $request['magcode'];
        $client->contid = $request['contid'];
        $client->clientcode = $request['clientcode'];
        $client->agencycode = $request['agencycode'];
        $client->cdateissue = $request['cdateissue'];
        $client->contdate = $request['contdate'];
        $client->adsize = $request['adsize'];
        $client->charges = $request['charges'];
        $client->chargedate = $request['chargedate'];
        $client->refno = $request['refno'];
        $client->remarks = $request['remarks'];
        $client->status = $request['status'];
        $client->save();

        return redirect('contract/all')->with('success', 'Successfully Added New Contract.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
