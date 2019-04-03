<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\PAP;
use App\HospitalDepartments;
use App\Budgets;
use App\Modes;
use App\BudgetDepartments;
use App\DepartmentBudgets;

class BUDGET extends Controller
{
    //
    public function budgetView(){
        $user = new User();
        $pap = new PAP();

        return view('budget.budget')->with([
            'dept' => $user->getDepartment(),
            'page' => 'Budget',
            'paps' => $pap->getPAP()
        ]);
    }

    public function getDepartments(){
        $departments = new HospitalDepartments();

        return json_encode($departments->getAll());
    }

    public function setBudget(Request $request){
        $budget = new Budgets();
        $mode = new Modes();
        $dbudgets = new DepartmentBudgets();

        $papid = $request->papid;
        $datas = [];

        foreach($request->datas as $key => $data){
            $datas[$key] = $data;
        }
        
        if($datas['budget'] != ''){
            if($budget->updateOrInsert(['bpapid' => $papid, 'bpapcode' => $request->papcode], ['bpapid' => $papid, 'budget' => $datas['budget'] ])){
                $dbudgets->updateOrInsert(['deptid' => 53], ['budget' => $datas['budget'] ]);
                $mode->updateOrInsert(['mpapcode' => $request->papcode, 'mpapid' => $papid], ['mode' => $datas['mode'], 'mpapcode' => $request->papcode ]);
                $response['status'] = 'success';
                $response['message'] = 'Budget saved';
            }else{
                $response['status'] = 'error';
                $response['message'] = 'Budget failed to save';
            }
        }

        echo json_encode($response);
    }

    public function setDepartments(Request $request){
        $department = new BudgetDepartments();
        $papid = $request->papid;
        $datas = '';

        foreach($request->datas as $data){
            $datas .= $data[0].',';
        }
        
        if($department->updateOrInsert(['dpapid' => $papid, 'dpapcode' => $request->papcode], ['departments' => $datas, 'dpapcode' => $request->papcode, 'dpapid' => $papid])){
           
            $response['status'] = 'success';
            $response['message'] = 'Departments added';
        }else{
            $response['status'] = 'error';
            $response['message'] = 'Departments failed to save';
        }

        echo json_encode($response);
    }

    public function printAPP(){
        $pap = new PAP();

        return view('forms.pap')->with([
            'paps' => $pap->getPAP()
        ]);
    }
}
