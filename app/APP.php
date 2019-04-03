<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;
use DB;

class APP extends CRUD
{
    protected $key = 'id';
    protected $table = 'dbo.papdesc';
    public function __construct(){
        parent::__construct($this->key, $this->table);

    }

    public function getDatas(){
        $response = DB::table($this->table.' as app')
                            ->join('');
    }
}
