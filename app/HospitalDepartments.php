<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;

class HospitalDepartments extends CRUD
{
    //
    public function __construct(){
        parent::__construct('deptid', 'dbo.hosp_departments');
    }
}
