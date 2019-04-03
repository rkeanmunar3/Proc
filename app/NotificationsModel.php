<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CRUD;
use App\ItemList;
use App\Inventory;
use App\StockRules;
use App\DepartmentPermissions;

class NotificationsModel extends CRUD
{
    protected $table = 'dbo.notifications';
    protected $key = 'id';

    public function __construct(){
        parent::__construct($this->key, $this->table);
    }
    
    public function getNotifications(){
        $myitems = new DepartmentPermissions();
        $itemlist = new ItemList();

        $stockrule = new StockRules();
        $inventory = new Inventory();
        

        $restockItems = [];
        $grpcodes = $myitems->getOneColumnWhere(['deptid' => auth()->user()->deptid, 'grpcode' => '10402030'], 'grpcode');


        $items = $itemlist->getAllWhereIn('codegrp', $grpcodes);

        foreach($items as $key => $item){
            $onhand = $inventory->getOneColumnWhere(['itemcode' => $item->itemcode, 'department' => auth()->user()->deptid], 'balance');
            $reorder = $stockrule->getOneColumnWhere(['itemcode' => $item->itemcode], 'reorderpoint');
            $items[$key]->balance = $onhand;
            if($onhand <= $reorder){
                array_push($restockItems, $item);
            }
        }

        return count($restockItems);
    }
}
