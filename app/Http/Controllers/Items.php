<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemList;
use App\DepartmentPermissions;

class Items extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //
    public function fetchAll(){

        $deptid = auth()->user()->deptid;
        $il = new ItemList();
        $dp = new DepartmentPermissions();

        $response = [];

        $grpcodes = $dp->getOneColumnWhere([
            'deptid' => $deptid
        ], 'grpcode');

        //$response['data'] = $il->getAllWithJoin('codegrp', $grpcodes);

        //echo json_encode($response);

        return  $il->getAllWithJoin('codegrp', $grpcodes);
    }
}
