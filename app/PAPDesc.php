<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;

class PAPDesc extends CRUD
{
    protected $key = 'id';
    protected $table = 'dbo.papdesc';
    public function __construct(){
        parent::__construct($this->key, $this->table);
    }

}
