<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
