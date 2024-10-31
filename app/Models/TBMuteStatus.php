<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TBMuteStatus extends Model
{
    protected $connection = "itugrowth";
    public $table = "status";
    public $primaryKey = "id";
    protected $guarded = [];
    public $timestamps = false;

    public static function getWhere(array $filter,$single = false)
    {
        $criteria = 'get';
        if ($single)
            $criteria = 'first';

        if ($filter)
            return DB::connection((new self())->connection)
                ->table((new self())->table)->select('*')
                ->where($filter)->$criteria();

        return self::all();
    }


    public function getclasses()
    {
       
        return $this->belongsTo(TBclasses::class,'ClassName','id');
    }

}
