<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
    protected $fillable = [
        'country_id', 'file_path', 'file_name', 'mime_type', 'file_size'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}