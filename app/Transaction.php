<?php

namespace App;
use App\TransactionOfItem;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];


    public $timestamps = false;

    public function transactionitems()
    {
        return $this->hasMany(TransactionOfItem::class);
    }
}
