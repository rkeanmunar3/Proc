<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;
use App\TransactionDetail;
use App\TransactionItems;
use App\Transaction;
use App\Attachments;
use App\Milestones;
use DB;

class Transaction extends CRUD
{
    protected $fillable = [
        'transcode',
        'type',
        'rqstrid',
        'rqstrdeptid',
        'dtecode',
        'created_at',
        'updated_at'
    ];

    protected $table = 'dbo.transactions';
    protected $key = 'transcode';

    public function __construct(){
        parent::__construct($this->key, $this->table);
    }

    public function createTransaction($datas, $details, $items, $totaldatas){
        $transaction = new Transaction();
        $transdetail = new TransactionDetail();

        if($this->insert($datas)){
            $this->createTransactionDetails($details);
            $this->insertTransactionItem($items);
            $this->insertTransactionTotal($totaldatas);
            return true;
        }else{
            return false;
        }
    }

    public function createTransactionDetails($details){
        $transaction = new TransactionDetail();

        if($transaction->insert($details)){
            return true;
        }else{
            return false;
        }
    }

    public function insertTransactionItem($items){
        $totalprice = new TransactionPrice();
        $transitems = new TransactionItems();

        foreach($items as $item){
            $count = $transitems->countWhere(['transcode' => $item['transcode'], 'itemcode' => $item['itemcode']]);

            if($count > 0){
                $transitems->incrementWhere('qty', 1, ['transcode' => $item['transcode'], 'itemcode' => $item['itemcode'] ]);
            }elseif($count == 0){
                $transitems->insert([
                    'transcode' => $item['transcode'],
                    'itemcode' => $item['itemcode'],
                    'name' => $item['name'],
                    'specs' => $item['specs'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'created_at' => $item['created_at'],
                    'updated_at' => $item['updated_at'],
                    'itemstat' => $item['itemstat'],
                ]);
            }
        }
        
    }

    public function insertTransactionTotal($datas){
        $totalprice = new TransactionPrice();

        $totalprice->insert($datas);  
    }

    public function getTransactions($where){
        $response = DB::table($this->table.' as trans')
                        ->where($where)
                        ->join('dbo.transdetail as detail', 'trans.transcode', '=', 'detail.transcode')
                        ->join('dbo.hosp_departments as department', 'trans.rqstrdeptid', '=', 'department.deptid')
                        ->leftjoin('dbo.transprice as price', 'trans.transcode', '=', 'price.transcode')
                        ->join('dbo.statdesc as status', 'detail.status', '=', 'status.statcode')
                        ->select(
                            'trans.transcode',
                            'trans.type',
                            'trans.created_at',
                            'detail.purpose',
                            'detail.date_sent',
                            'price.totalprice',
                            'detail.date_sent',
                            'department.name as department',
                            'status.name as status',
                            'status.statcode',
                        )
                        ->get();
        
        foreach($response as $key => $res){
            $response[$key]->items = DB::table('dbo.transitems')
                                            ->where(['transcode' => $res->transcode])
                                            ->count();
        }
        return $response;
    }

   public function getTransactionDatas($transcode){
       $items = new TransactionItems();
       $itemcount = $items->getItemCount(['transcode' => $transcode]);
       $attachments = new Attachments();
       $milestone = new Milestones();
       $months = array([0 => 'jan', 1 => 'feb', 2 => 'march', 3 => 'apr', 4 => 'may', 5 => 'jun', 6 => 'jul', 7 => 'aug', 8 => 'sep', 9 => 'oct', 10 => 'nov', 11 => 'dec']);

       $response['items'] = DB::table($this->table.' as transaction')
                                ->where('transaction.transcode', $transcode)
                                ->join('dbo.transitems as items', 'transaction.transcode', '=', 'items.transcode')
                                ->leftjoin('dbo.itemdesc as idesc', 'items.itemcode', '=', 'idesc.itemcode')
                                ->select(
                                    'transaction.*',
                                    'items.*',
                                    'idesc.unit',
                                    'idesc.description'
                                )
                                ->get();

                                foreach($response['items'] as $key => $item){
                                    $ms = $milestone->getOneColumnWhere(['transcode' => $transcode, 'itemcode' => $item->itemcode], 'milestones');
                                    if(count($ms) > 0){
                                        foreach($ms as $m){
                                            $ms = $m;
                                        }
                                        $mstones = explode(':', $ms);
    
                                        $response['items'][$key]->jan = $mstones[0];
                                        $response['items'][$key]->feb = $mstones[1];
                                        $response['items'][$key]->mar = $mstones[2];
                                        $response['items'][$key]->apr = $mstones[3];
                                        $response['items'][$key]->may = $mstones[4];
                                        $response['items'][$key]->jun = $mstones[5];
                                        $response['items'][$key]->jul = $mstones[6];
                                        $response['items'][$key]->aug = $mstones[7];
                                        $response['items'][$key]->sep = $mstones[8];
                                        $response['items'][$key]->oct = $mstones[9];
                                        $response['items'][$key]->nov = $mstones[10];
                                        $response['items'][$key]->dec = $mstones[11];
                                    }else{
                                        $response['items'][$key]->jan = '';
                                        $response['items'][$key]->feb = '';
                                        $response['items'][$key]->mar = '';
                                        $response['items'][$key]->apr = '';
                                        $response['items'][$key]->may = '';
                                        $response['items'][$key]->jun = '';
                                        $response['items'][$key]->jul = '';
                                        $response['items'][$key]->aug = '';
                                        $response['items'][$key]->sep = '';
                                        $response['items'][$key]->oct = '';
                                        $response['items'][$key]->nov = '';
                                        $response['items'][$key]->dec = '';
                                    }
                                    
                                }
        
        $response['attachments'] = $attachments->getAllWhere([
            'transcode' => $transcode
        ]);

        $details = DB::table($this->table.' as transaction')
                                    ->where('transaction.transcode', $transcode)
                                    ->join('dbo.transdetail as details', 'transaction.transcode', '=', 'details.transcode')
                                    ->join('dbo.transprice as price', 'transaction.transcode', '=', 'price.transcode')
                                    ->join('dbo.users as user', 'transaction.rqstrdeptid', '=', 'user.deptid')
                                    ->join('dbo.departmentbudgets as budget', 'user.deptid', '=', 'budget.deptid')
                                    ->join('dbo.hosp_departments as hosdep', 'user.deptid', '=', 'hosdep.deptid')
                                    ->join('dbo.statdesc as stat', 'details.status', '=', 'stat.statcode')
                                    ->join('dbo.hospitaldivisions as hosdiv', 'hosdep.divisionid', '=', 'hosdiv.divisionid')
                                    ->join('dbo.typedesc as type', 'transaction.type', '=', 'type.typecode')
                                    ->leftjoin('dbo.approvedtransactions as approved', 'transaction.transcode', '=', 'approved.transcode')
                                    ->leftjoin('dbo.suppliers as supplier', 'details.supplierid', '=', 'supplier.suppid')
                                    ->select(
                                        'transaction.type',
                                        'details.*',
                                        'user.name',
                                        'hosdep.name as hosdep',
                                        'price.totalprice',
                                        'budget.budget',
                                        'stat.name as status',
                                        'stat.statcode as statcode',
                                        'approved.dateapproved',
                                        'supplier.name as supplier',
                                        'supplier.address as address',
                                        'hosdiv.name as division',
                                        'type.name as transtype',
                                    )
                                    ->get();

                                    foreach($details as $details){
                                        $response['details'] = $details;
                                        
                                    }

                                    $response['details']->itemcount = $itemcount;

        return $response;
   }

   public function getMilestones($transcode){
        $milestone = new Milestones();

        
   }

   public function approveTransaction($transcode){
       $transdetail = new TransactionDetail();

       if($this->updateWhere(['transcode' => $transcode], ['status' => 'C'])){
           if($transdetail->updateWhere(['transcode' => $transcode], ['status' => 'C'])){
               return true;
           }else{
               return false;
           }
       }
   }
}
