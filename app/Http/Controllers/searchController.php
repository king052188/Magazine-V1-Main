<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use DB;

class searchController extends Controller
{
    public function executeSearchClient(Request $request)
    {
		$output="";
        $clients = DB::SELECT("
                SELECT 
                    master.company_name, master.type, master.status, child.*, child.Id as child_uid
                FROM 
                    client_table AS master
                INNER JOIN
                    client_contacts_table AS child
                ON
                    master.Id = child.client_id
                WHERE master.company_name LIKE '%$request->search%' AND master.type = 1
                ORDER BY master.company_name, branch_name ASC
    	");

    	if($clients)
    	{
			foreach($clients as $key => $clients)
                $output.="<li class='list-group-item' data-dismiss='modal' id='"
                		.$clients->child_uid. 
                		"'>"
                		.$clients->company_name.
                		"-"
                		.$clients->branch_name.
                		"</li>";
		}

		return Response($output);
    }

    public function executeSearchAgency(Request $request)
    {
		$output="";
      	$agency = DB::SELECT("
                    SELECT 
                        master.company_name, master.type, master.status, child.*, child.Id as child_uid
                    FROM 
                        client_table AS master
                    INNER JOIN
                        client_contacts_table AS child
                    ON
                        master.Id = child.client_id
                    WHERE master.company_name LIKE '%$request->search%' AND master.type = 2
                    ORDER BY master.company_name, branch_name ASC
    	");

    	if($agency)
    	{
			foreach($agency as $key => $agency)
                $output.="<li class='list-group-item' data-dismiss='modal' id='"
                		.$agency->child_uid. 
                		"'>"
                		.$agency->company_name.
                		"-"
                		.$agency->branch_name.
                		"</li>";
		}

		return Response($output);
    }
}
