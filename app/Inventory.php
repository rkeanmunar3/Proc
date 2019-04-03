<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use APP\CRUD;

class Inventory extends CRUD
{
    protected $table = 'dbo.inventory';
    protected $key = 'itemcode';

    public function __construct(){
        parent::__construct($this->key, $this->table);
    }
}
