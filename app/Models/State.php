<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'country_id',
    ];

    public static function getStateName($state_id)
    {
        $responce=false;
        if(empty($responce)){
            $responce = Self::Select('name')
            ->where('id','=',$state_id)
            ->first();
        }
        return $responce;
    }
}