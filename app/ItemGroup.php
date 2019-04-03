<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;

class ItemGroup extends CRUD
{
    protected $table = 'dbo.itemgrp';
    protected $key = 'grpcode';

    public function __construct(){
        parent::__construct($this->key, $this->table);
    }
}
