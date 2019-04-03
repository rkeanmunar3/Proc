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

use App\Http\Controllers\Items;

class PurchaseRequest extends Controller
{

    public function createPR($transcode, $purpose){
        $trans = new Transaction();

        $now = now();

        $transdatas = [
            'type' => 'PR',
            'transcode' => $transcode,
            'rqstrid' => auth()->user()->id,
            'rqstrdeptid' => auth()->user()->deptid,
            'created_at' => $now,
            'updated_at' => $now,
            'dtecode' => date('Y-m')
        ];

        $transdetails = [
            'transcode' => $transcode,
            'd_rqstrdeptid' => auth()->user()->deptid,
            'status' => 'P',
            'purpose' => $purpose
        ];


        if($trans->createTransaction($transdatas, $transdetails)){
           return true;
        }else{
            return false;
        }
    }

    public function newPR(Request $request){
        
        $dp = new DepartmentPermissions();
        $ig = new ItemGroup();
        $supp = new Suppliers();
        $items = new Items();

        $transcode = $this->generatePRNo();

        $grpcode = $dp->getOneColumnWhere([
            'deptid' => auth()->user()->deptid
        ], 'grpcode');

        $itemnames = $ig->getAllWhereIn('grpcode', $grpcode);
        $suppliers = $supp->getAll();

        //$this->createPR($transcode);

        return view('users.newpr')->with([
            'page' => 'Create PR',
            'dept' => $this->getDepartmentName(),
            'items' => $itemnames,
            'prno' => $transcode,
            'suppliers' => $suppliers,
            'itemlist' => $items->fetchAll()
        ]);
    }
    
    public function newPPMP(Request $request){
        
        $dp = new DepartmentPermissions();
        $ig = new ItemGroup();
        $supp = new Suppliers();
        $items = new Items();

        $transcode = $this->generatePRNo();

        $grpcode = $dp->getOneColumnWhere([
            'deptid' => auth()->user()->deptid
        ], 'grpcode');

        $itemnames = $ig->getAllWhereIn('grpcode', $grpcode);
        $suppliers = $supp->getAll();

        //$this->createPR($transcode);

        return view('users.newppmp')->with([
            'page' => 'Create PPMP',
            'dept' => $this->getDepartmentName(),
            'items' => $itemnames,
            'prno' => $transcode,
            'suppliers' => $suppliers,
            'itemlist' => $items->fetchAll()
        ]);
    }

    public function sendPR(Request $request){
        $pt = new TransactionDetail();
        $pp = new TransactionPrice();
        $pi = new TransactionItems();
        $prno = $request->prno;
        $purpose = $request->purpose;

        $up = (boolean)$request->up;
        $items = $request->datas;

        if($up == 1){
            if($pt->updateWhere(['transcode' => $prno], ['status' => 'P', 'date_sent' => now()])){
                    if($pp->updateWhere(['transcode' => $prno], ['totalprice' => 0])){       
                        ///$datas = $request->datas;

                        $response['status'] = 'success';
                        $response['message'] = 'Purchase request updated';
                    }else{
                        $response['status'] = 'error';
                        $response['message'] = 'Unable to update request';
                    }
            }else
            {
                $response['status'] = 'error';
                $response['message'] = 'Unable to update requsssest';
            }
        }else if($up == 0){
            if($this->createPR($prno, $purpose)){
                foreach($items as $item){
                    $count = $pi->countWhere(['prno' => $prno, 'itemcode' => $item['itemcode']]);

                    if($count > 0){
                        $pi->incrementWhere('qty', 1, ['itemcode' => $item['itemcode'], 'prno' => $prno]);
                    }else{
                        $pi->insert([
                            'prno' => $item['prno'],
                            'itemcode' => $item['itemcode'],
                            'name' => $item['name'],
                            'price' => $item['price'],
                            'qty' => $item['qty'],
                            'specs' => $item['specs'],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        
                    }
                    $total = $this->prTotalPrice($prno);
                   
                }
                $pp->insert(['transcode' => $prno, 'totalprice' => $total, 'updated_at' => now(), 'created_at' => now()]);
                $response['status'] = 'success';
                $response['message'] = 'Purchase request sent';

            }else{
                $response['status'] = 'error';
                $response['message'] = 'Unable to send request';
            }
        }
        

        return json_encode($response);
    }

    public function fetchAll(){
        $pr = new Transaction();
        $pi = new TransactionItems();

        $deptid = auth()->user()->deptid;

        $prs = $pr->fetchAll(['rqstrdeptid' => $deptid]);

        foreach($prs as $key => $pr)
        {
            $prs[$key]->items = $pi->countWhere(['prno' => $pr->transcode]);
        }

        return json_encode($prs);
    }

    public function removeItem(Request $request){
        $pr = new TransactionItems();

        if($pr->updateWhere(['prno' => $request->prno, 'itemcode' => $request->itemcode], ['itemstat' => 'R']))
        {
            $response['status'] = 'success';
            $response['message'] = 'Item removed';
        }
        else
        {
            $response['status'] = 'error';
            $response['message'] = 'Unable to remove item';
        }

        return json_encode($response);
    }

    public function prTotalPrice($prno){
        $items = new TransactionItems();
        $total = 0;
        $datas = $items->getAllWhere(['prno' => $prno]);

        foreach($datas as $item){
            $total += (int)$item->price * (int)$item->qty;
        }

        return $total;
    }

    public function generatePRNo(){
        $transaction = new Transaction();

        $deptid = auth()->user()->deptid;
        $dtecode = date('Y-m');

        $count = $transaction->countWhere([
            'dtecode' => $dtecode,
            'type' => 'PR',
        ]);
        
        $prno = date('Y-m').'-'.($count + 1);

        return $prno;
    }

    public function getItems(Request $request){
        $pi = new TransactionItems();

        $response = $pi->getItemsWithPrice(['prno' => $request->prno]);

        return json_encode($response);
    }

    public function getDepartmentCode(){
        $hd = new HospitalDepartments();
        $department = $hd->getAllWhere([
            'deptid' => auth()->user()->deptid,
        ]);

        foreach($department as $dept)
        {
            $dept = $dept->deptcode;
        }

        return $dept;
    }

    public function getDepartmentName(){
        $hd = new HospitalDepartments();
        $department = $hd->getAllWhere([
            'deptid' => auth()->user()->deptid,
        ]);

        foreach($department as $dept)
        {
            $dept = $dept->name;
        }

        return $dept;
    }
}
