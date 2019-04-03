<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\CRUD;
use App\PAPDesc;
use App\Budgets;
use App\HospitalDepartments;

class PAP extends CRUD
{
    protected $key = 'id';
    protected $table = 'dbo.papcategory';
    public function __construct(){
        parent::__construct($this->key, $this->table);
    }

    public function getPAP(){
        $paps = $this->getAll();
        $papdesc = new PAPDesc();
        $budget = new Budgets();
        $departments = new HospitalDepartments();

        $response = array();

        foreach($paps as $pap){
            $response[$pap->description] = DB::table('dbo.papdesc as pap')
                                                    ->where(['categoryid' => $pap->id])
                                                    ->leftjoin('dbo.appbudgets as budget', 'pap.id', '=', 'budget.bpapid')
                                                    ->leftjoin('dbo.appmodes as mode', 'pap.id', '=', 'mode.mpapid')
                                                    ->leftjoin('dbo.appdepartments as dep', 'pap.id', '=', 'dep.dpapid')
                                                    ->leftjoin('dbo.proctype as proc', 'mode.mode', '=', 'proc.proccode')
                                                    ->select(
                                                        'pap.*',
                                                        'budget.*',
                                                        'proc.name as mode',
                                                        'proc.proccode as proccode',
                                                        'dep.*'
                                                    )
                                                    ->get();

                                                    
                foreach($response[$pap->description] as $key => $dep){
                    $deps = explode(',', $dep->departments);

                    $departs = $departments->getAllWhereIn('deptid', $deps);

                    $response[$pap->description][$key]->depnames = $departs;
                }
        }

        return $response;
    }
}
