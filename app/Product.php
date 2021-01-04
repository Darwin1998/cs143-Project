<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];


    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function getCurrentStocksAttribute()
    {
        return $this->inventories()->sum("count");
    }

    public function transactions()
    {
        return $this->hasMany(TransactionOfItem::class);
    }


}
