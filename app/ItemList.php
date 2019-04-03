<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;
use DB;
use App\Inventory;

class ItemList extends CRUD
{
    //
    public function __construct(){
        parent::__construct('id', 'dbo.items');
    }

    public function getAllWithJoin($where, $in)
    {
        $inventory = new Inventory();

        $datas = DB::table($this->table.' as item')
                ->whereIn($where, $in)
                ->join('dbo.itemdesc as itemdesc', 'item.itemcode', '=', 'itemdesc.itemcode')
                ->leftjoin('dbo.itemprice as price', 'item.itemcode', '=', 'price.itemcode')
                ->leftjoin('dbo.stockrules as rule', 'item.itemcode', '=', 'rule.itemcode')
                ->select(
                    'itemdesc.specs',
                    'itemdesc.unit',
                    'itemdesc.brandname',
                    'itemdesc.description',
                    'price.price',
                    'item.*',
                    'rule.standardstock',
                    'rule.reorderpoint'
                )
                ->orderBy($this->key, 'ASC')
                ->get();

                foreach($datas as $key => $val){
                    $stockbal = $inventory->getOneColumnWhere(['itemcode' => $val->itemcode, 'department' => auth()->user()->deptid], 'balance');
                    $balance = 0;
                    foreach($stockbal as $bal){
                        if(is_numeric($bal)){
                            $balance = $bal;
                        }else{
                            $balance = 0;
                        }
                    }
                    $datas[$key]->stockbal = $balance;
                }
           
        return $datas;
    }

    public function getAllItems()
    {
        $inventory = new Inventory();

        $datas = DB::table($this->table.' as item')
            ->where(['codegrp' => 10402030])
            ->join('dbo.itemdesc as itemdesc', 'item.itemcode', '=', 'itemdesc.itemcode')
            ->select(
                'itemdesc.specs',
                'itemdesc.unit',
                'itemdesc.description',
                'item.*',
            )
            ->orderBy($this->key, 'ASC')
            ->get();

        return $datas;
    }
}
