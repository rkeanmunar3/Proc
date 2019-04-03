<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;
use DB;

class TransactionItems extends CRUD
{
    protected $table = 'dbo.transitems';

    protected $fillable = [
        'prno',
        'itemcode',
        'grpcode',
        'qty',
        'unitofissue',
        'name',
        'specs',
        'stockno',
        'created_at',
        'updated_at'
    ];

    public function __construct(){
        parent::__construct('id', $this->table);
    }

    public function getItemsWithPrice($where){
        $items = DB::table($this->table.' as item')
                    ->where($where)
                    ->join('dbo.itemdesc as desc', 'item.itemcode', '=', 'desc.itemcode')
                    ->select('item.*', 'desc.description', 'desc.specs', 'desc.unit')
                    ->get();
        return $items;
    }

    public function getItemCount($where){
        $items = DB::table($this->table.' as item')
                    ->where($where)
                    ->count();
                    
        return $items;
    }
}
