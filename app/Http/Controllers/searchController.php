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
                $output.="<tr id='" . $clients->child_uid ."' class='".$clients->company_name."'>
                          <td style='width:45%'>". $clients->company_name. "</td>
                          <td style='width:45%'>". $clients->branch_name ."</td>
                          <td style='width:10%'><button class='btn btn-primary btn-sm list_client' data-dismiss='modal'><i class='fa fa-plus'></i>&nbsp;&nbsp;Select</button></td>
                          </tr>";

		}

        if($output == ""){
             $output = "<tr><td  colspan='3' style='width:45%; text-align:center;'>Not Data Found!</td></tr>";
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
                $output.="<tr id='" . $agency->child_uid ."' class='".$agency->company_name."'>
                          <td style='width:45%'>". $agency->company_name. "</td>
                          <td style='width:45%'>". $agency->branch_name ."</td>
                          <td style='width:10%'><button class='btn btn-primary btn-sm list_agency' data-dismiss='modal'><i class='fa fa-plus'></i>&nbsp;&nbsp;Select</button></td>
                          </tr>";
             
		}

        if($output == ""){
             $output = "<tr><td  colspan='3' style='width:45%; text-align:center;'>Not Data Found!</td></tr>";
        }

		return Response($output);
    }
}
