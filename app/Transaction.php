<?php

namespace App;
use App\TransactionOfItem;
use Illuminate\Database\Eloquent\Model;
use App\Customer;

class Transaction extends Model
{
    protected $guarded = [];


    public $timestamps = false;

    public function transactionitems()
    {
        return $this->hasMany(TransactionOfItem::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
