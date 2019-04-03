<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;
use DB;
class TransactionDetail extends CRUD
{
    protected $table = 'dbo.transdetail';
    protected $key = 'transcode';

    public function __construct(){
        parent::__construct($this->key, $this->table);
    }

    public function getTransactions($where, $in){
        $response = DB::table($this->table.' as detail')
                        ->whereIn($where, $in)
                        ->join('dbo.transactions as trans', 'detail.transcode', '=', 'trans.transcode')
                        ->join('dbo.hosp_departments as dep', 'trans.rqstrdeptid', '=', 'dep.deptid')
                        ->leftjoin('dbo.transprice as price', 'trans.transcode', '=', 'price.transcode')
                        ->leftjoin('dbo.statdesc as status', 'detail.status', '=', 'status.statcode')
                        ->select(
                            'trans.*',
                            'dep.*',
                            'detail.date_sent', 
                            'detail.status as statcode',
                            'status.name as status',
                            'price.totalprice'
                        )
                        ->get();

        return $response;
    }
}
