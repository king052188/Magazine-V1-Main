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
                SELECT  master.company_name, master.type, master.status, child.*, child.Id AS child_uid
                FROM client_table AS master INNER JOIN client_contacts_table AS child ON master.Id = child.client_id
                WHERE master.company_name LIKE '%$request->search%' AND master.type = 1
                ORDER BY child.type, branch_name ASC
    	 ");

      	if($clients)
      	{
            for($i = 0; $i < count($clients); $i++) {
                $type = $clients[$i]->type == 2 ? 'Branch' : 'Primary<span style="color:red";>*</span>';
                $output .= "<tr id='" . $clients[$i]->child_uid ."' class='".$clients[$i]->company_name. " (" . $clients[$i]->branch_name.  ")'>
                          <td style='width:45%'>". $clients[$i]->company_name. " (" . $clients[$i]->branch_name.  ") </td>
                          <td style='width:45%'>".$type."</td>
                          <td style='width:10%'><button class='btn btn-primary btn-sm list_client' data-dismiss='modal'><i class='fa fa-plus'></i>&nbsp;&nbsp;Select</button>
                          </td></tr>";
            }

    		}

        if($output == ""){
             $output = "<tr><td  colspan='3' style='width:45%; text-align:center;'>No Data Found!</td></tr>";
        }

		    return Response($output);
    }

    public function executeSearchAgency(Request $request)
    {
		$output="";
      	$agency = DB::SELECT("
                    SELECT master.company_name, master.type, master.status, child.*, child.Id as child_uid
                    FROM client_table AS master
                    INNER JOIN client_contacts_table AS child
                    ON master.Id = child.client_id
                    WHERE master.company_name LIKE '%$request->search%' AND master.type = 2
                    ORDER BY child.type, branch_name ASC
    	");

    	if($agency)
    	{
            for($i = 0; $i < count($agency); $i++) {
                $type = $agency[$i]->type == 2 ? 'Branch' : 'Primary<span style="color:red";>*</span>';
                $output .= "<tr id='" . $agency[$i]->child_uid ."' class='".$agency[$i]->company_name. " (" .$agency[$i]->branch_name. ")'>
                          <td style='width:45%'>". $agency[$i]->company_name. " (" .$agency[$i]->branch_name. ") </td>
                          <td style='width:45%'>".$type."</td>
                          <td style='width:10%'><button class='btn btn-primary btn-sm list_agency' data-dismiss='modal'><i class='fa fa-plus'></i>&nbsp;&nbsp;Select</button>
                          </td></tr>";
            }
             
		  }

        if($output == ""){
             $output = "<tr><td  colspan='3' style='width:45%; text-align:center;'>No Data Found!</td></tr>";
        }

		return Response($output);
    }
}
