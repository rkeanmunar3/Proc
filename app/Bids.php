<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;
use DB;

class Bids extends CRUD
{
    protected $key = 'id';
    protected $table = 'dbo.bids';

    protected $fillable = [
        'itemcode',
        'bidders',
        'created_at',
        'updated_at',
        'dtecode'
    ];
    public function __construct()
    {
        parent::__construct($this->key, $this->table);
    }

    public function getBidDatas($bid_id)
    {
        $response = DB::table($this->table.' as bid')
                        ->where(['bid.bid_id' => $bid_id])
                        ->join('dbo.biddetails as detail', 'bid.bid_id', '=', 'detail.bid_id')
                        ->join('dbo.suppliers as supplier', 'detail.bidder_id', '=', 'supplier.suppid')
                        ->select(
                            'detail.*',
                            'supplier.name'
                        )
                        ->orderBy('bidprice', 'ASC')
                        ->get();


        return $response;
    }
}
