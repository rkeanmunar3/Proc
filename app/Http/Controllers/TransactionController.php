<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseRequestModel;
use App\HospitalDepartments;
use App\Transaction;
use App\TransactionItems;
use App\ItemPrice;
use App\TransactionPrice;
use App\TransactionDetail;
use App\DepartmentPermissions;
use App\ItemGroup;
use App\Suppliers;

class TransactionController extends Controller
{
    public function createTransaction(Request $request){
        $trans = new Transaction();
        $deptid =  auth()->user()->deptid;
        $transcode = $this->generateTransactionNo($request->type);
        $items = $request->items;

        if($request->type == 'PR'){
            $dtecode = date('Y-m');
        }elseif($request->type == 'PPMP'){
            $dtecode = date('Y');
        }

        foreach($items as $key => $value){
            $items[$key]['transcode'] = $transcode;
            $items[$key]['created_at'] = now();
            $items[$key]['updated_at'] = now();
            $items[$key]['itemstat'] = 'A';
        }

        $transdatas = [
            'type' => $request->type,
            'transcode' => $transcode,
            'rqstrid' => auth()->user()->id,
            'rqstrdeptid' => $deptid,
            'created_at' => now(),
            'updated_at' => now(),
            'dtecode' => $dtecode
        ];

        $transdetails = [
            'transcode' => $transcode,
            'd_rqstrdeptid' => $deptid,
            'status' => $request->status,
            'purpose' => $request->purpose,
            'supplierid' => $request->supplier,
            'date_sent' => now()
        ];

        $transtotaldetails = [
            'transcode' => $transcode,
            'totalprice' => $request->total,
            'created_at' => now(),
            'updated_at' => now()
        ];

        if($trans->createTransaction($transdatas, $transdetails, $items, $transtotaldetails)){
           $response['status'] = 'success';
           if($request->status == 'P'){
                $response['message'] = 'Transaction created';
           }else{
            $response['message'] = 'Transaction saved';
           }
           $response['transcode'] = $transcode;
        }else{
            $response['status'] = 'error';
           $response['message'] = 'Transaction failed';
        }

        return json_encode($response);
    }

    public function generateTransactionNo($type){
        $transaction = new Transaction();
        
        if($type == 'PR'){
            $dtecode = date('Y-m');
        }elseif($type == 'PPMP'){
            $dtecode = date('Y');
        }

        $count = $transaction->countWhere([
            'dtecode' => $dtecode,
            'type' => $type,
        ]);
        
        $transno = $dtecode.'-'.sprintf('%03d',($count + 1));

        return $transno;
    }
}
