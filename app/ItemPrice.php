<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;

class ItemPrice extends CRUD
{
    //
    protected $table = 'dbo.itemprice';
    protected $key = 'itemcode';

    public function __construct(){
        parent::__construct($this->key, $this->table);
    }

    public function getPrice($itemcode){
        $response = $this->getOneColumnWhere(['itemcode' => $itemcode], 'price');

        if($response->count() > 0){
            return $response[0];
        }else{
            return 0;
        }

    }
}
