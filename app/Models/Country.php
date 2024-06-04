<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'shortname',
        'name',
        'phonecode',
    ];

    public static function getCountryName($aliasID)
    {
        $response = false;
        if (empty($response)) {
            $response = Self::Select('name')
                ->where('id','=',$aliasID)
                ->first();
        }
        return $response;
    }
}