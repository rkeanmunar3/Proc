<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;

class BudgetDepartments extends CRUD
{
    protected $key = '';
    protected $table = 'dbo.appdepartments';

    public function __construct(){
        parent::__construct($this->key, $this->table);
    }
}
