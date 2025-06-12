<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = ['meal'];

    protected function casts()
    {
        return [
            'meal' => 'json'
        ];
    }
}
