<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;

class StockRules extends CRUD
{
    protected $table = 'dbo.stockrules';
    protected $key = 'itemcode';

    public function __construct(){
        parent::__construct($this->key, $this->table);
    }
}
