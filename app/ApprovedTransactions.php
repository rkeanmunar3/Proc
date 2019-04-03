<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;

class ApprovedTransactions extends CRUD
{
    protected $table = 'dbo.approvedtransactions';
    protected $key = 'dbo.transcode';

    public function __construct(){
        parent::__construct($this->key, $this->table);
    }
}
