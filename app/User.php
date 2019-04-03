<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\HospitalDepartments;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'department_id','role','is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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
