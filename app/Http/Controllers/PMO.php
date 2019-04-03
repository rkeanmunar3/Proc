<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TransactionDetail;
use App\TransactionItems;
use App\Transaction;
use App\User;
use App\Suppliers;
use App\Bids;

class PMO extends Controller
{
    public function fetchPR($status){
        $pt = new TransactionDetail();
        $pi = new TransactionItems();

        if($datas = $pt->getTransactions('status',[$status]))
        {

            foreach($datas as $key => $pitems)
            {
                $datas[$key]->items = $pi->countWhere(['transcode' => $pitems->transcode]);
            }
        }

        return $datas;
    }

    public function generatePO($transcode){
        $trans = new Transaction();

        $datas = $trans->getTransactionDatas($transcode);

        return view('forms.po')->with([
            'transcode' => $transcode,
            'datas' => $datas
        ]);
    }

    public function purchaseRequest(Request $request){
        $datas = $this->fetchPR($request->status);
        $user = new User();

        return view('pmo.pr')->with([
            'requests' => $datas,
            'dept' => $user->getDepartment(),
            'page' => 'PR'
        ]);
    }

    public function getItems(Request $request){
        $transaction = new Transaction();
        $datas = $transaction->getTransactionDatas($request->prno);

        return json_encode($datas);
    }

    public function viewPR(Request $request){
        $transaction = new Transaction();
        $user = new User();
        $suppliers = new Suppliers();

        $datas = $transaction->getTransactionDatas($request->transcode);

        return view('pmo.viewpr')->with([
            'transcode' => $request->transcode,
            'transaction' => $datas,
            'dept' => $user->getDepartment(),
            'page' => 'View Transaction',
            'suppliers' => $suppliers->getAll()
        ]);
    }

    public function approvePR(Request $request){
        $transaction = new Transaction();
        $transdetail = new TransactionDetail();

        if($transdetail->updateWhere(['transcode' => $request->transcode], ['status' => 'C'])){
            $response['status'] = 'success';
            $response['message'] = 'Transaction completed';
        }else{
            $response['status'] = 'error';
            $response['message'] = 'Transaction failed';
        }

        return json_encode($response);

    }

    public function returnPR(Request $request){
  
        $transdetail = new TransactionDetail();
        $transitems = new TransactionItems();
        $items = $request->items;

        if($transdetail->updateWhere(['transcode' => $request->transcode], ['status' => 'R'])){
            if(count($items) > 0){
                foreach($request->items as $item){
                    $transitems->updateWhere(['transcode' => $request->transcode, 'itemcode' => $item], ['itemstat' => 'R']);
                }
                $response['status'] = 'success';
                $response['message'] = 'Transaction completed';
            }
        }else{
            $response['status'] = 'error';
            $response['message'] = 'Transaction failed';
        }

        return json_encode($response);

    }

    public function setSupplier(Request $request){
        $transdetail = new TransactionDetail();

        $transdetail->updateWhere(['transcode' => $request->transcode], ['supplierid' => $request->supplierid]);
    }

    public function getSuppliers(Request $request){
        $supplier = new Suppliers();
        $dtecode = date('Y');
        $bids = new Bids();

        $count = $bids->countWhere(['itemcode' => $request->itemcode, 'dtecode' => $dtecode]);

        if($count > 0){
            $bidders = $bids->getOneColumnWhere(['itemcode' => $request->itemcode, 'dtecode' => $dtecode], 'bidders');
            foreach ($bidders as $bidder){
                $ids = $bidder;
            }
            $removeid = explode(':', $ids);

            return $supplier->getAllWhereNotIn('suppid', $removeid);
        }else{
            return $supplier->getAll();
        }

        //return $supplier->getAll();
    }
}
