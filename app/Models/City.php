<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'state_id',
    ];

    public static function getCityName($ID)
    {
        $response = false;
        if (empty($response)) {
            $response = Self::Select('name')
                ->where('id','=',$ID)
                ->first();
        }
        return $response;
    }
}
