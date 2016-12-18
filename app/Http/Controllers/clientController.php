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
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $clients = Client::all();
        return view('client/index', compact('clients'));
    }
    
    public function create()
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $result = DB::table('client_reference_table')->get();
        return view('client.create', compact('result'));
    }

    public function save_client(Request $request)
    {
        $company = new Client();
        $company->company_name = $request['c_company_name'];
        $company->address = $request['c_address'];
        $company->city = $request['c_city'];
        $company->state = $request['c_state'];
        $company->zip_code = $request['c_zip_code'];
        $company->type = $request['c_type'];
        $company->is_member = $request['c_is_member'] == false ? -1 : 1;
        $company->status = 2;
        $company->save();
        $company_last_uid = $company->id;

//        $new_bn = $this->generate_branch_number($company_last_uid);
//        $branch_name = $new_bn['new_bn'];

        $field = array('', 'p_', 's_', 'b_');
        $branch_name = array('', '0001', '0002', $request['b_branch_name']);

        for($i = 1; $i < 4; $i++)
        {
            $client = new ClientContact();
            $client->client_id = $company_last_uid;
            $client->branch_name = $branch_name[$i];
            $client->first_name = $request[$field[$i].'first_name'];
            $client->middle_name = $request[$field[$i].'middle_name'];
            $client->last_name = $request[$field[$i].'last_name'];
            $client->address_1 = $request[$field[$i].'address_1'];
            $client->city = $request[$field[$i].'city'];
            $client->state = $request[$field[$i].'state'];
            $client->zip_code = $request[$field[$i].'zip_code'];
            $client->email = $request[$field[$i].'email'];
            $client->landline = $request[$field[$i].'landline'];
            $client->mobile = $request[$field[$i].'mobile'];
            $client->position = $request[$field[$i].'position'];
            $client->type_designation = $request[$field[$i].'type_designation'];
            $client->type = $i;
            $client->status = 2;
            $client->synched = 1;
            $client->save();
        }


        return redirect('client/create')->with('success', 'Successfully Added New Client.');
    }

    public function add_contact($company_uid)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $new_bn = $this->generate_branch_number($company_uid);
        $branch_name = $new_bn['new_bn'];
        $result = DB::table('client_table')->where('Id', '=', $company_uid)->get();
        return view('client/add_contact', compact('company_uid', 'result', 'branch_name'));
    }

    public function client_contacts($company_uid)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $result = DB::table('client_contacts_table')->where('client_id', '=', $company_uid)->get();
        $branch_name = DB::table('client_table')->where('Id', '=', $company_uid)->get();

        return view('/client/client_contacts', compact('result', 'company_uid', 'branch_name'));
    }

    public function companies()
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $results = DB::table('client_table')->get(); //Subscriber
        $results == null ? null : $results;

        return view('client.index', compact('results'));
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
//        $meal->ingredients()->saveMany($meal_ingredients);

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
        $client->type = 2; //secondary
        $client->status = 2;
        $client->save();

        return redirect('/client/all')->with('success', 'Successfully Added New Contact.');
    }

    public function client_update($company_uid)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }
        
        $result = DB::table('client_reference_table')->get();
        $company = DB::table('client_table')->where('Id', '=', $company_uid)->get();
        $primary = DB::table('client_contacts_table')->where('client_id', '=', $company_uid)->where('type', '=', 1)->get();
        $secondary = DB::table('client_contacts_table')->where('client_id', '=', $company_uid)->where('type', '=', 2)->get();
        $bill_to = DB::table('client_contacts_table')->where('client_id', '=', $company_uid)->where('type', '=', 3)->get();

        return view('client.client_update', compact('result', 'company', 'primary', 'secondary', 'bill_to'));
    }

    public function client_update_save(Request $request, $company_uid)
    {
        Client::where('Id', '=', $company_uid)
            ->update([
                'company_name' => $request['c_company_name'],
                'address' => $request['c_address'],
                'city' => $request['c_city'],
                'state' => $request['c_state'],
                'zip_code' => $request['c_zip_code'],
                'type' => $request['c_type'],
                'is_member' => $request['c_is_member'] == false ? -1 : 1,
                'status' => 2
            ]);

        $field = array('', 'p_', 's_', 'b_');
        $branch_name = array('', '0001', '0002', $request['b_branch_name']);

        for($i = 1; $i < 4; $i++)
        {
            ClientContact::where('client_id', '=', $company_uid)
                ->where('type', '=', $i)
                ->update([
                    'branch_name' => $branch_name[$i],
                    'first_name' => $request[$field[$i].'first_name'],
                    'middle_name' => $request[$field[$i].'middle_name'],
                    'last_name' => $request[$field[$i].'last_name'],
                    'address_1' => $request[$field[$i].'address_1'],
                    'city' => $request[$field[$i].'city'],
                    'state' => $request[$field[$i].'state'],
                    'zip_code' => $request[$field[$i].'zip_code'],
                    'email' => $request[$field[$i].'email'],
                    'landline' => $request[$field[$i].'landline'],
                    'mobile' => $request[$field[$i].'mobile'],
                    'position' => $request[$field[$i].'position'],
                    'type_designation' => $request[$field[$i].'type_designation'],
                    'type' => $i,
                    'status' => 2,
                    'synched' => 1
                ]);
        }

        return redirect('client/update/' . $company_uid)->with('success', 'Successfully Updated.');
    }

    public function contact_update($contact_uid)
    {
        $result_contact = DB::table('client_contacts_table')->where('Id', '=', $contact_uid)->get();
        return view('client.update_contact', compact('result_contact'));
    }

    public function contact_update_save(Request $request, $company_uid, $client_id)
    {

        $primary = $request['type'] == false ? 2 : 1;

        if($primary == 1)
        {
            ClientContact::where('client_id', '=', $client_id)
                ->update([
                    'type' => 2
                ]);

            ClientContact::where('Id', '=', $company_uid)
                ->update([
                    'branch_name' => $request['branch_name'],
                    'first_name' => $request['first_name'],
                    'middle_name' => $request['middle_name'],
                    'last_name' => $request['last_name'],
                    'address_1' => $request['address_1'],
                    'email' => $request['email'],
                    'landline' => $request['landline'],
                    'mobile' => $request['mobile'],
                    'type' => $primary
                ]);

            return redirect('client/client_contacts/' . $client_id)->with('success', 'Successfully Updated.');
        }

        $chk = DB::table('client_contacts_table')
            ->where('Id','=',$company_uid)
            ->where('client_id','=',$client_id)
            ->where('type','=',1)->get();

        if(COUNT($chk) == 1)
        {
            return redirect('client/client_contacts/' . $client_id)->with('failed', 'Please set at-least 1 primary contact.');
        }


        return redirect('client/client_contacts/' . $client_id)->with('success', 'Successfully Updated.');
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
