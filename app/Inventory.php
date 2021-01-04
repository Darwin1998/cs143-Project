<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $guarded = [];

    protected $fillable = ['product_id','count','date_time'];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

}
