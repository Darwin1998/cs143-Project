<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionOfItem extends Model
{

    protected $guarded = [];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
