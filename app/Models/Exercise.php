<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'exercise'
    ];

    protected function casts()
    {
        return [
            'exercise' => 'json'
        ];
    }
}
