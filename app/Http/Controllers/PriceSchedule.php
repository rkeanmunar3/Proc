<?php

namespace App\Http\Controllers;

use App\BidDetails;
use Illuminate\Http\Request;
use App\User;
use App\ItemList;
use App\Bids;
use App\Suppliers;
class PriceSchedule extends Controller
{
    public function newPriceSchedule(){
        $user = new User();
        $dept = $user->getDepartment();

        return view('pmo.pricesched')->with([
            'dept' => $dept,
            'page' => 'Price Schedule',
        ]);
    }

    public function getItems(Request $request){
        $bids = new Bids();
        $itemList = new ItemList();

        $items = $itemList->getAllItems();
        $id = 0;
        foreach ($items as $key => $item){
            $count = $bids->countWhere(['itemcode' => $item->itemcode]);
            $id += 1;
            if($count > 0){
                $bidders = $bids->getOneColumnWhere(['itemcode' => $item->itemcode], 'bidders');
                foreach ($bidders as $bidder){
                    $ids = $bidder;
                }
                $explodes = explode(':', $ids);

                $nbidders = count($explodes).' Bidders';
                $has_bidder = 1;
            }else{
                $nbidders = 'No Bidder';
                $has_bidder = 0;
            }
            $items[$key]->biddercount = $nbidders;
            $items[$key]->has_bidder = $has_bidder;
            $items[$key]->id = $id;
        }

        return json_encode($items);
    }

    public function addBidder(Request $request){
        $bid = new Bids();
        $bdetails = new BidDetails();
        $dtecode = date('Y');
        $bid_id = $dtecode.'-'.$request->itemcode;

        $count = $bid->countWhere(['bid_id' => $bid_id]);

        if($count > 0){
            $bidders = $bid->getOneColumnWhere(['bid_id' => $bid_id], 'bidders');
            foreach ($bidders as $bids){
                $bidderids = $bids;
            }
            $ids = $bidderids.':'.$request->bidderid;
            $bid->updateWhere(['bid_id' => $bid_id], ['bidders' => $ids]);
        }else{
            $bid->insert(['bid_id' => $bid_id, 'itemcode' => $request->itemcode, 'bidders' => $request->bidderid, 'dtecode' => $dtecode, 'created_at' => now(), 'updated_at' => now()]);
        }
        $bdetails->insert(['bid_id' => $bid_id, 'bidder_id' => $request->bidderid, 'bidprice' => $request->bidprice, 'brand' => $request->brand, 'description' => $request->description, 'manufacturer' => $request->manufacturer, 'origin' => $request->origin, 'dtecode' => $dtecode, 'created_at' => now(), 'updated_at' => now()]);
    }

    public function getBidders(Request $request){
        $bids = new Bids();

        $bid_id = date('Y').'-'.$request->itemcode;

        $datas = $bids->getBidDatas($bid_id);

        return json_encode($datas);
    }
}
