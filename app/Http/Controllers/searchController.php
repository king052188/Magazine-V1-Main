<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use DB;

class searchController extends Controller
{
    public function search_function(Request $request)
    {
        $output="";
            $keyword = $request->search;
//        $c_type = (int)$request->type;

        $query_type = " AND status = 2 AND type != 2 ";
//        if($c_type > 1) {
//            $query_type = " AND status = 2 AND type = 2 ";
//        }

        $clients = DB::SELECT("
                    SELECT *
                    FROM client_table
                    WHERE (UPPER(company_name) LIKE '%{$keyword}%' OR LOWER(company_name) LIKE '%{$keyword}%')
                    {$query_type}
                    ORDER BY company_name ASC
    	 ");


      	if($clients)
      	{
            for($i = 0; $i < count($clients); $i++) {
                $client_bill_to = DB::table('client_contacts_table')->where('client_id', '=', $clients[$i]->Id)->where('role', '=', 3)->get(); //Subscriber
                $type = $clients[$i]->status == 2 ? '<span style="color:green;">Active</span>' : '<span style="color:red; text-align: center;">Inactive</span>';
                $output .= "<tr id='" . $clients[$i]->Id ."' class='".$clients[$i]->company_name. "' name='".$client_bill_to[$i]->first_name. " " .$client_bill_to[$i]->last_name." (Billing Contact)' get_data='".$client_bill_to[$i]->Id. "'>
                          <td>". $clients[$i]->company_name."</td>
                          <td style='width: 120px; text-align: center;'>".$type."</td>
                          <td style='width: 100px'><button class='btn btn-primary btn-sm list_client' data-dismiss='modal'><i class='fa fa-check'></i>&nbsp;&nbsp;Select</button>
                          </td></tr>";
            }
        }

        if($output == ""){
             $output = "<tr><td  colspan='3' style='width:45%; text-align:center;'>No Data Found!</td></tr>";
        }
        return Response($output);
    }

}
