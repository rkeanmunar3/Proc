<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;

class TransactionPrice extends CRUD
{
    //
    protected $fillable = [
        'prno',
        'totalprice',
        'created_at',
        'updated_at'
    ];

    public function __construct(){
        parent::__construct('prno', 'dbo.transprice');
    }
}
