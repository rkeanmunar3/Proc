<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;

class Milestones extends CRUD
{
    protected $table = 'dbo.ppmpmilestones';
    protected $key = 'id';

    public function __construct(){
        parent::__construct($this->key, $this->table);
    }
}
