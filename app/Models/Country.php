<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'capital',
        'population',
        'region',
        'flag_path',
    ];

    public function flag()
    {
        return $this->hasOne(Flag::class);
    }
}