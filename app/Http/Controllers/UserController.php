<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Cotrollers\PMO;
use App\HospitalDepartments;
use App\DepartmentPermissions;
use App\ItemList;
use App\ItemGroup;
use App\Transaction;
use App\TransactionDetail;
use App\TransactionItems;
use App\Milestones;

class UserController extends Controller
{
    //
    public function __contsruct(){
        $this->middleware('auth');
    }

    public function dashboard(){
        $page = 'Dashboard';
        return view('users.dashboard')->with([
            'page' => $page,
            'dept' => $this->getDepartment()
        ]);
    }

    public function inventory(){
        $page = 'Inventory';
        $dp = new DepartmentPermissions();
        $ig = new ItemGroup();


        $grpcode = $dp->getOneColumnWhere([
            'deptid' => auth()->user()->deptid
        ], 'grpcode');

        $itemnames = $ig->getAllWhereIn('grpcode', $grpcode);

        return view('users.inventory')->with([
            'page' => $page,
            'dept' => $this->getDepartment(),
            'items' => $itemnames,
        ]);
    }

    public function transactions(Request $request){
        $page = 'Purchase Request';

        $transaction = new Transaction();

        $prs = $transaction->getTransactions(['trans.rqstrdeptid' => auth()->user()->deptid, 'type' => $request->type]);

        return view('users.transactions')->with([
            'page' => $page,
            'dept' => $this->getDepartment(),
            'requests' => $prs
        ]);
    }

    public function ppmp(){
        $page = 'Project Procurement Management Plan';

        return view('users.ppmp')->with([
            'page' => $page,
            'dept' => $this->getDepartment()
        ]);
    }

    public function app(){
        $page = 'Annual Procurement Plan';
        return view('users.app')->with([
            'page' => $page,
            'dept' => $this->getDepartment()
        ]);
    }

    public function getDepartment(){
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

    public function generatePR(Request $request){
        $trans = new Transaction();

        $datas = $trans->getTransactionDatas($request->transcode);

        return view('forms.request')->with([
            'transcode' => $request->transcode,
            'transaction' => $datas
        ]);
    }

    public function generatePPMP(Request $request){
        $trans = new Transaction();

        $datas = $trans->getTransactionDatas($request->transcode);

        return view('forms.ppmp')->with([
            'transcode' => $request->transcode,
            'transaction' => $datas
        ]);
    }

    public function editPPMP(Request $request){
        $trans = new Transaction();

        $datas = $trans->getTransactionDatas($request->transcode);

        return view('users.editppmp')->with([
            'transcode' => $request->transcode,
            'transaction' => $datas,
            'dept' => $this->getDepartment(),
            'page' => 'PPMP'
        ]);
    }

    public function savePPMP(Request $request){
        $transitems = new TransactionItems();
        $milestones = new Milestones();

        foreach($request->items as $item){
            $transitems->updateWhere(['transcode' => $item['transcode'], 'itemcode' => $item['itemcode']], ['qty' => $item['qty']]);
        }

        foreach($request->milestones as $milestone){
            $milestones->updateOrInsert(['transcode' => $milestone['transcode'], 'itemcode' => $milestone['itemcode']], ['milestones' => $milestone['milestones']]);
        }

        $response['status'] = 'success';
        $response['message'] = 'PPMP Saved';

        return json_encode($response);
    }

    public function sendPPMP(Request $request){
        $td = new TransactionDetail();

        if( $td->updateWhere(['transcode' => $request->transcode], ['status' => 'P'])){
            $response['status'] = 'success';
            $response['message'] = 'PPMP Sent';
        }else{
            $response['status'] = 'error';
            $response['message'] = 'Failed to send PPMP';
        }

        echo json_encode($response);
    }
}
