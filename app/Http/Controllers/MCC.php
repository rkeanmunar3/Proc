<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\TransactionDetail;
use App\TransactionItems;
use App\ApprovedTransactions;
use App\DispprovedTransactions;
use App\User;
class MCC extends Controller
{
    //
    public function fetchTransactions(Request $request){
        $transaction = new Transaction();
        $user = new User();

        $datas = $transaction->getTransactions(['status' => $request->status]);

        return view('mcc.transactions')->with([
            'transactions' => $datas,
            'dept' => $user->getDepartment(),
            'page' => 'Transactions'
        ]);
    }
    
    public function viewTransaction(Request $request){
        $transaction = new Transaction();
        $user = new User();

        $datas = $transaction->getTransactionDatas($request->transcode);

        return view('mcc.transaction')->with([
            'transaction' => $datas,
            'dept' => $user->getDepartment(),
            'page' => 'Transactions'
        ]);
    }

    public function approveTransaction(Request $request){
        $trans  = new Transaction();
        $pt = new ApprovedTransactions();
        $td = new TransactionDetail();

        $rqstrdeptid = $trans->getOneColumnWhere(['transcode' => $request->transcode], 'rqstrdeptid');

        if($td->updateWhere(['transcode' => $request->transcode], ['status' => 'A'])){
            $pt->insert(['transcode' => $request->transcode, 'dateapproved' => now(), 'approvedby' => auth()->user()->deptid, 'rqstrdeptid' => $rqstrdeptid[0]]);
            $response['status'] = 'success';
            $response['message'] = 'Transaction approved';
        }else{
            $response['status'] = 'error';
            $response['message'] = 'Failed to approve transaction';
        }
        return json_encode($response);
    }

    public function disapprovePR(Request $request){
        $pt = new DispprovedTransactions();

        if($pt->insert(['transcode' => $request->prno, 'status' => 'D', 'datedisapproved' => now(), 'disapprovedby' => auth()->user()->name, 'remarks' => $request->remarks])){
            $response['status'] = 'success';
            $response['message'] = 'Purchase request disapproved';
        }else{
            $response['status'] = 'error';
            $response['message'] = 'Failed to disapprove request';
        }
        return json_encode($response);
    }
}
