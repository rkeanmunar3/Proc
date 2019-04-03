<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;

class DepartmentPermissions extends CRUD
{
    //
    public function __construct(){
        parent::__construct('id', 'dbo.deptitems');
    }
}
