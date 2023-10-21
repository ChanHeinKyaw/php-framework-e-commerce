<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as Capsule;

class Category extends Model
{
    protected $fillable = ['name','slug'];

    public function genPaginate($limit){
        $table = $this->getTable();
        $datas = [];
        $queryDatas = Capsule::select("SELECT * FROM $table ORDER BY id DESC " . $limit);

        foreach($queryDatas as $data){
            $date = new Carbon($data->created_at);
            array_push($datas, [
                "id" => $data->id,
                "name" => $data->name,
                "slug" => $data->slug,
                "created" => $date->toFormattedDateString(),
            ]);
        }
        return $datas;
    }
}