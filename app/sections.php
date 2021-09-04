<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sections extends Model
{
    protected $guarded = [];


    public function products()
    {
        return $this->hasMany(products::class);
    }
}
