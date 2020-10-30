<?php

namespace App\Http\Controllers;

use App\User;
use DB;
use Illuminate\Http\Request;
use User as GlobalUser;

class AllUsersController extends Controller
{
    public function index()
    {
        $active = "dashboard.users";
        // $users = Users::paginate(5); to paginate data from user db
        $data = compact('active');

        return view('admin.all-users', $data);
    }

    public function action(Request $request)
    {
       
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
         
            if ($query != '') {
                $data = DB::table('users')
                    ->where('first_name', 'like', '%' . $query . '%')
                    ->orWhere('last_name', 'like', '%' . $query . '%')
                    ->orWhere('phone_number', 'like', '%' . $query . '%')
                    ->orWhere('email', 'like', '%' . $query . '%')
                    ->get();
                  
            } else {
                $data = DB::table('users')
                    ->orderBy('id')
                    ->get();
            }
           
            $total_row = $data->count();
            if ($total_row > 0) {
               
                foreach ($data as $row) {
                    $output .= '
                    <tr>
                    <td>
                        
                    </td>
                    <td></td>
                        <td>
                           ' . $row->id . '
                        </td>
                        <td>
                           ' . $row->first_name . '
                        </td>
                        <td>
                           ' . $row->last_name . '
                        </td>
                        <td>
                           ' . $row->phone_number . '
                        </td>
                        <td>
                           ' . $row->email . '
                        </td>
                    </tr>';
                }
            } else {
                $output = '<tr>
                                <td align="center" colspan="5">
                                    No User Found
                                </td>
                            </tr>';
            }
            
            $data = array('table_data' => $output, 'total_data' => $total_row);
            
            echo json_encode($data);
        }
    }
}
