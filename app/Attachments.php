<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;

class Attachments extends CRUD
{
    protected $table = 'dbo.attachments';
    protected $key = 'id';

    public function __construct(){
        parent::__construct($this->key, $this->table);
    }
}
