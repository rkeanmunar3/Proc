<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;

class Modes extends CRUD
{
   protected $key = '';
   protected $table = 'dbo.appmodes';

   public function __construct(){
       parent::__construct($this->key, $this->table);
   }
}
