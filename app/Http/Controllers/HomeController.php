<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HospitalDepartments;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        switch(auth()->user()->role){
            case 1:{
                $view = 'mcc.dashboard';
                break;
            }
            case 2:{
                $view = 'pmo.dashboard';
                break;
            }
            case 3:{
                $view = 'users.dashboard';
                break;
            }
            case 4:{
                $view = 'mcc.dashboard';
                break;
            }
            case 5:{
                $view = 'budget.dashboard';
                break;
            }
        }
        return view($view)->with([
            'page' => 'Home',
            'dept' => $this->getDepartment()
        ]);
    }
    public function getDepartment(){
        $hd = new HospitalDepartments();
        $department = $hd->getAllWhere([
            'deptid' => auth()->user()->deptid,
        ]);

        foreach($department as $dept)
        {
            $dept = $dept->name;
        }

        return $dept;
    }
}
