<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;
class Budgets extends CRUD
{
    protected $key = 'papid';
    protected $table = 'dbo.appbudgets';

    public function __construct(){
        parent::__construct($this->key, $this->table);
    }
}
