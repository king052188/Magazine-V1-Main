<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Client;
use App\ClientContact;
use DB;

class clientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('client/index', compact('clients'));
    }
    
    public function create()
    {   
        $result = DB::table('client_reference_table')->get();
        return view('client.create', compact('result'));
    }

    public function save_client(Request $request)
    {
        $client = new Client();
        $client->company_name = $request['company_name'];
        $client->type = $request['type'];
        $client->save();

        return redirect('/client/all')->with('success', 'Successfully Added New Client.');
    }

    public function add_contact($company_uid)
    {
        $new_bn = $this->generate_branch_number($company_uid);
        $branch_name = $new_bn['new_bn'];
        $result = DB::table('client_table')->where('Id', '=', $company_uid)->get();
        return view('client/add_contact', compact('company_uid', 'result', 'branch_name'));
    }

    public function client_contacts($company_uid)
    {
        $result = DB::table('client_contacts_table')->where('client_id', '=', $company_uid)->get();
        $branch_name = DB::table('client_table')->where('Id', '=', $company_uid)->get();

        return view('/client/client_contacts', compact('result', 'company_uid', 'branch_name'));
    }

    public function companies()
    {
        $subscribers = DB::table('client_table')->where('type', '=', 1)->get(); //Subscriber
        $agencies = DB::table('client_table')->where('type', '=', 2)->get(); //Agency

        return view('client.index', compact('subscribers', 'agencies'));
    }

    public function store(Request $request)
    {

           $client = new Client;
           $client->company_name = Input::get('company_name');

           $contacts = Input::get('contact');
           $client_contacts = array();

           foreach($contacts as $contact)
           {
                $client_contact[] = new ClientContact(array(
                    'name' => $contact['name'],
                    'unit' => $contact['unit'],
                    'quantity' => $contact['quantity'],
                ));
           }

        $client->save();
        $meal->ingredients()->saveMany($meal_ingredients);

        return redirect('client/all')->with('success', 'Successfully Added New Client.');
    }

    public function save_contact(Request $request, $company_uid)
    {
        $new_bn = $this->generate_branch_number($company_uid);
        $branch_name = $new_bn['new_bn'];

        $client = new ClientContact();
        $client->client_id = $company_uid;
        $client->branch_name = $branch_name;
        $client->first_name = $request['first_name'];
        $client->middle_name = $request['middle_name'];
        $client->last_name = $request['last_name'];
        $client->address_1 = $request['address_1'];
        $client->email = $request['email'];
        $client->landline = $request['landline'];
        $client->mobile = $request['mobile'];
        $client->type = 1;
        $client->status = 1;
        $client->save();

        return redirect('/client/all')->with('success', 'Successfully Added New Contact.');
    }

   

    private function generate_branch_number($company_uid)
    {
        $result = DB::select("SELECT branch_name FROM client_contacts_table WHERE client_id = {$company_uid} ORDER BY branch_name DESC LIMIT 1");
        if($result != null){
            $gen_tn = $result[0]->branch_name + 1;
            $tn_ext = str_pad($gen_tn, 4, '0', STR_PAD_LEFT);
            return array("new_bn" => $tn_ext);
        }else{
            return array("new_bn" => "0001");
        }
    }
}
