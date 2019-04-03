<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class CRUD extends Model
{
    //
    protected $key;
    protected $table;

    public function __construct($key, $table)
    {
        $this->key = $key;
        $this->table = $table;

        
    }

    /* -----------------------------------------
                        READ
        ----------------------------------------- */
    public function getAll()
    {
        $response = DB::table($this->table)
                ->orderBy($this->key, 'ASC')
                ->get();
                
        return $response;
    }
    public function getAllWhere($where)
    {
        $response = DB::table($this->table)
                ->where($where)
                ->orderBy($this->key, 'DESC')
                ->get();
                
        return $response;
    }
    public function getAllWhereIn($where, $in)
    {
        $response = DB::table($this->table)
                ->whereIn($where, $in)
                ->orderBy($this->key, 'ASC')
                ->get();
                
        return $response;
    }
    public function getAllWhereNotIn($where, $in)
    {
        $response = DB::table($this->table)
            ->whereNotIn($where, $in)
            ->orderBy($this->key, 'ASC')
            ->get();

        return $response;
    }
    public function getOneColumnWhere($where, $pluck)
    {
        $response = DB::table($this->table)
                            ->where($where)
                            ->pluck($pluck);
        
        return $response;
    }
    public function getOneColumnWhereIn($where, $in, $pluck)
    {
        $response = DB::table($this->table)
                            ->whereIn($where, $in)
                            ->pluck($pluck);
        
        return $response;
    }
    public function getAllWithPagination($page)
    {
        $response = DB::table($this->table)
                    ->paginate($page);

        return $response;
    }

    public function getAllWithJoin($join_table, $key)
    {
        $response = DB::table($this->table)
                    ->join($join_table, $this->table.'.'.$this->key, '=', $join_table.'.'.$key)
                    ->select($this->table.'.*', $join_table.'.trans_status')
                    ->get();
                    
        return $response;
    }
    public function getAllWhereWithJoin($where, $join_table, $key)
    {
        $response = DB::table($this->table)
                    ->where($where)
                    ->join($join_table, $this->table.'.'.$this->key, '=', $join_table.'.'.$key)
                    ->select($this->table.'.*', $join_table.'.trans_status')
                    ->get();
                    
        return $response;
    }
    public function getAllWhereWithJoinPaginate($where, $join_table, $key, $page)
    {
        $response = DB::table($this->table)
                    ->where($where)
                    ->join($join_table, $this->table.'.'.$this->key, '=', $join_table.'.'.$key)
                    ->select($this->table.'.*', $join_table.'.trans_status')
                    ->paginate($page);
                    
        return $response;
    }

    public function countWhere($where)
    {
        $response = DB::table($this->table)
                        ->where($where)
                        ->count();

        return $response;
    }
     /* -----------------------------------------
                        CREATE
        ----------------------------------------- */

    public function insert($datas)
    {
        $response = DB::table($this->table)
                    ->insert($datas);

        return $response;
    }
    public function insertGetId($datas)
    {
        $response = DB::table($this->table)
                    ->insertGetID($datas);

        return $response;
    }

    /* ---------------------------------------
                        UPDATE
    ----------------------------------------*/

    public function updateWhere($where, $datas){
        $response = DB::table($this->table)
                        ->where($where)
                        ->update($datas);
        
        return $response;
    }

    public function incrementWhere($column, $value, $where){
        $response = DB::table($this->table)
                        ->where($where)
                        ->increment($column, $value);
        
        return $response;
    }

    /* -------------------------------------
                    DELETE
    -------------------------------------*/

    public function deleteWhere($where){
        $response = DB::table($this->table)
                        ->where($where)
                        ->delete();
        return $response;
    }
}
