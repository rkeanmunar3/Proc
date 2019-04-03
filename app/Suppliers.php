<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;

class Suppliers extends CRUD
{
    protected $table = 'dbo.suppliers';
    protected $key = 'suppid';

    public function __construct(){
        parent::__construct($this->key, $this->table);
    }
}
