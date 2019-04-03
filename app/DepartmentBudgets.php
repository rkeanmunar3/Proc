<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;

class DepartmentBudgets extends CRUD
{
    protected $key = 'deptid';
    protected $table = 'dbo.departmentbudgets';

    public function __construct(){
        parent::__construct($this->key, $this->table);
    }
}
