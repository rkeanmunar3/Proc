<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\TransactionItems;
use App\HospitalDepartments;

class Pharmacy extends Controller
{
    public function viewPR(Request $request){
        $items = new TransactionItems();

        $datas = $items->getAllWhere([
            'prno' => $request->prno
        ]);

        return view('pharmacy.viewpr')->with([
            'prno' => $request->prno,
            'dept' => $this->getDepartment(),
            'page' => 'View PR',
            'items' => $datas
        ]);
    }

    public function viewAllPR(Request $request){
        $pr = new Transaction();
        $pi = new TransactionItems();

        $deptid = auth()->user()->deptid;

        $prs = $pr->fetchAll(['rqstrdeptid' => $deptid]);

        foreach($prs as $key => $pr)
        {
            $prs[$key]->items = $pi->countWhere(['prno' => $pr->transcode]);
        }

        return view('pharmacy.pr')->with([
            'requests' => $prs,
            'page' => 'Purchase Requests',
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
}
