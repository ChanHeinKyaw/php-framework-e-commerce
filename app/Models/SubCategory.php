<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as Capsule;


class SubCategory extends Model
{
    public function genPaginate($limit){
        $table = $this->getTable();
        $datas = [];
        $queryDatas = Capsule::select("SELECT * FROM $table ORDER BY id DESC " . $limit);

        foreach($queryDatas as $data){
            $date = new Carbon($data->created_at);
            array_push($datas, [
                "id" => $data->id,
                "name" => $data->name,
                "cat_id" => $data->cat_id,
                "created" => $date->toFormattedDateString(),
            ]);
        }
        return $datas;
    }
}