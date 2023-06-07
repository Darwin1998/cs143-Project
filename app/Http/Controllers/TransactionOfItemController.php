<?php

namespace App\Http\Controllers;
use App\Product;

use App\Inventory;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

use \App\Transaction;
class TransactionOfItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



}
