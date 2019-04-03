<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;

class BidDetails extends CRUD
{
    protected $key = 'id';
    protected $table = 'dbo.biddetails';
    protected $fillable = [
        'bidder_id',
        'bidprice',
        'brand',
        'description',
        'manufacturer',
        'origin',
        'created_at',
        'updated_at',
        'dtecode'
    ];

    public function __construct()
    {
        parent::__construct($this->key, $this->table);
    }
}
