<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Client;
use App\ClientContact;
use App\GroupTable;
use App\GroupList;
use DB;

class clientController extends Controller
{
    public function index()
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $clients = DB::SELECT("SELECT * FROM client_table ORDER BY company_name ASC");
        return view('client/index', compact('clients'));
    }
    
    public function create()
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $clients = Client::all();
        $result = DB::table('client_reference_table')->get();
        $tax = DB::table('taxes_table')->get();
        
        return view('client.create', compact('clients', 'result', 'tax'));
    }

    public function save_company(Request $request)
    {
        if($request['c_state'] == 1){
            $state = $request['specify_province_code'];
        }else{
            $state = $request['c_state'];
        }
        
        $company = new Client();
        $company->company_name = $request['c_company_name'];
        $company->address = $request['c_address'];
        $company->city = $request['c_city'];
        $company->state = $state;
        $company->zip_code = $request['c_zip_code'];
        $company->is_member = $request['c_is_member'] == false ? -1 : 1;
        $company->type = 1;
        $company->status = 2;
        $result = $company->save();

//        $new_bn = $this->generate_branch_number($company_last_uid);
//        $branch_name = $new_bn['new_bn'];

//        $field = array('', 'p_', 's_', 'b_');
//        $role = array('', '0001', '0002', $request['b_branch_name'], '0004');
//
//        $client = new ClientContact();
//        $client->client_id = $company_last_uid;
//        $client->branch_name = $role[$request['role']];
//        $client->first_name = $request['first_name'];
//        $client->middle_name = $request['middle_name'];
//        $client->last_name = $request['last_name'];
//        $client->address_1 = $request['address_1'];
//        $client->city = $request['city'];
//        $client->state = $request['state'];
//        $client->zip_code = $request['zip_code'];
//        $client->email = $request['email'];
//        $client->landline = $request['landline'];
//        $client->mobile = $request['mobile'];
//        $client->position = $request['position'];
//        $client->type = $request['type'];
//        $client->status = 2;
//        $client->synched = 1;
//        $client->save();

        if($result) {
            //$company_last_uid = $company->id;
            //return redirect('client/view_contacts/'. $company_last_uid)->with('success', 'Successfully Added New Client, Please add your contact person.');
            return redirect('client/create')->with('success', 'Successfully Added New Client, Please add your contact person.');
        }

        return redirect('client/create')->with('success', 'Oops, Something went wrong.');
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

    public function client_contacts_group_list($company_uid)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $company_uid = (int)$company_uid;

        $result = DB::SELECT("SELECT Id, first_name, last_name FROM client_contacts_table WHERE client_id = {$company_uid}");
        if($result != null)
        {
            return array("status" => 200, "result" => $result);
        }

        return array("status" => 404, "description" => "No Result Found");
    }

    public function list_of_contacts_in_group($company_uid, $group_id)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $company_uid = (int)$company_uid;

        $result = DB::SELECT("
                        SELECT aa.*, bb.first_name, bb.last_name
                        FROM group_list_table as aa
                        LEFT JOIN client_contacts_table as bb ON bb.Id = aa.contact_id
                        WHERE aa.client_id = {$company_uid} AND aa.group_id = {$group_id}");
        if($result != null)
        {

            return array(
                "status" => 200,
                "result" => $result
            );
        }

        return array("status" => 404, "description" => "No Result Found");
    }

    public function add_contacts_in_group($company_uid, $group_id, $contact_id, $role)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $result = DB::SELECT("SELECT * FROM group_list_table WHERE contact_id = {$contact_id} AND client_id = {$company_uid} AND group_id = {$group_id}");
        
        if($result != null)
        {
            return array("status" => 404, "description" => "Contact is already in your group");
        }
        else
        {
            $result_aa = DB::SELECT("SELECT * FROM group_list_table WHERE role_id = {$role} AND client_id = {$company_uid} AND group_id = {$group_id}");
            if($result_aa != null)
            {
                return array("status" => 403, "description" => "Role is already in your group");
            }
            else
            {
                $g = new GroupList();
                $g->group_id = $group_id;
                $g->contact_id = $contact_id;
                $g->client_id = $company_uid;
                $g->role_id = $role;
                $g->status = 2;
                $result_bb = $g->save();

                if($result_bb)
                {
                    return array("status" => 200);
                }
            }
        }

    }

    public function add_group($company_uid, $group_name, $category)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $gt = new GroupTable();
        $gt->group_name = $group_name;
        $gt->category_id = $category;
        $gt->client_uid = $company_uid;
        $gt->save();

        return array("status" => 200);
    }

    public function list_group($company_uid)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $result = DB::SELECT("SELECT * FROM group_table WHERE client_uid = {$company_uid}");
        if($result != null)
        {
            return array("status" => 200, "result" => $result);
        }

        return array("status" => 404, "description" => "No Result Found");
    }

    public function client_group($group_uid)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $group = DB::table('group_table')->where('Id', '=', $group_uid)->get();
        $company = DB::table('client_table')->where('Id', '=', $group[0]->client_uid)->get();
        $contacts = DB::table('client_contacts_table')->where('client_id', '=', $group[0]->client_uid)->get();

        return view('client/client_group', compact('group', 'company', 'contacts'));
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

    public function view_contacts($company_uid)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }
        
        $ref = DB::table('client_reference_table')->get();
        $company = DB::table('client_table')->where('Id', '=', $company_uid)->get();
        $tax = DB::table('taxes_table')->get();

        $results = DB::table('client_contacts_table')->where('client_id', '=', $company_uid)->orderBy('role', 'asc')->get(); //Subscriber
        $results == null ? null : $results;

        $p = DB::table('client_contacts_table')->where('client_id', '=', $company_uid)->where('role', '=', 1)->get(); //Primary
//        $p == null ? null : $p;

        $s = DB::table('client_contacts_table')->where('client_id', '=', $company_uid)->where('role', '=', 2)->get(); //Secondary
//        $s == null ? null : $s;

        $b = DB::table('client_contacts_table')->where('client_id', '=', $company_uid)->where('role', '=', 3)->get(); //Bill To
//        $b == null ? null : $b;

        $same = DB::table('client_contacts_table')->where('client_id', '=', $company_uid)->where('role', '=', 5)->get(); //Primary and Bill To
        $same == null ? null : $same;

        return view('client.client_contacts_view', compact('ref', 'company', 'results', 'p', 's', 'b', 'same', 'tax', 'category'));
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

        if($request['role'] == 1){
            ClientContact::where('role', '=', 5)->where('client_id', '=', $company_uid)->update(['role' => 3]);
        }elseif($request['role'] == 3){
            ClientContact::where('role', '=', 5)->where('client_id', '=', $company_uid)->update(['role' => 1]);
        }elseif($request['role'] == 5){
            ClientContact::where('role', '=', 1)->orWhere('role', '=', 3)->where('client_id', '=', $company_uid)->update(['role' => 4]);
        }

        $role = array('', '0001', '0002', $request['branch_name'], $request['other_name'], $request['branch_name']);

        $client = new ClientContact();
        $client->client_id = $company_uid;
        $client->branch_name = $request['status'] == false ? '' : $role[$request['role']];
        $client->first_name = $request['first_name'];
        $client->middle_name = $request['middle_name'];
        $client->last_name = $request['last_name'];
        $client->address_1 = $request['address_1'];
        $client->city = $request['city'];
        $client->state = $request['state'];
        $client->zip_code = $request['zip_code'];
        $client->email = $request['email'];
        $client->landline = $request['landline'];
        $client->mobile = $request['mobile'];
        $client->position = $request['position'];
        $client->type = $request['type'];
        $client->role = $request['status'] == false ? 4 : $request['role'];
        $client->status = $request['status'] == false ? 1 : 2;
        $client->synched = 1;
        $client->save();

        return redirect('/client/view_contacts/' . $company_uid)->with('success', 'Successfully Added New Contact.');
    }

    public function client_update($company_uid)
    {
        if(!AssemblyClass::check_cookies()) {
            return redirect("/logout_process");
        }

        $clients = Client::all();
        $company = DB::table('client_table')->where('Id', '=', $company_uid)->get();

        return view('client.client_update', compact('clients', 'company'));
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
                'status' => $request['c_status'] == false ? 1 : 2
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
                    'synched' => 1
                ]);
        }

        return redirect('client/update/' . $company_uid)->with('success', 'Successfully Updated.');
    }

    public function contact_update($contact_uid)
    {
        $edit_contact = DB::table('client_contacts_table')->where('Id', '=', $contact_uid)->get();
        if($edit_contact != null){
            return array("result" => $edit_contact);
        }

        return array("result" => 404);
    }

    public function contact_update_save(Request $request)
    {
        if($request['role'] == 1){
            ClientContact::where('role', '=', 5)->where('client_id', '=', $request['client_id'])->update(['role' => 3]);
        }elseif($request['role'] == 3){
            ClientContact::where('role', '=', 5)->where('client_id', '=', $request['client_id'])->update(['role' => 1]);
        }elseif($request['role'] == 5){
            ClientContact::where('role', '=', 1)->orWhere('role', '=', 3)->where('client_id', '=', $request['client_id'])->update(['role' => 4]);
        }

        $role = array('', '0001', '0002', $request['branch_name'], $request['other_name'], $request['branch_name']);
        ClientContact::where('Id', '=', $request['contact_uid'])
            ->update([
                'branch_name' => $request['status'] == false ? '' : $role[$request['role']],
                'first_name' => $request['first_name'],
                'middle_name' => $request['middle_name'],
                'last_name' => $request['last_name'],
                'address_1' => $request['address_1'],
                'email' => $request['email'],
                'city' => $request['city'],
                'state' => $request['state'],
                'zip_code' => $request['zip_code'],
                'email' => $request['email'],
                'landline' => $request['landline'],
                'mobile' => $request['mobile'],
                'position' => $request['position'],
                'type' => $request['type'],
                'role' => $request['status'] == false ? 4 : $request['role'],
                'status' => $request['status'] == false ? 1 : 2,
                'synched' => 1
            ]);

        return redirect('/client/view_contacts/' . $request['client_id'])->with('success', 'Successfully Updated.');
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
