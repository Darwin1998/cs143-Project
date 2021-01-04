<?php

namespace App\Http\Controllers;
use\App\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Product $product )
    {
        $products = Product::query()->paginate(5);
        return view('inventory.index', compact('products'));
    }

    public function store(Request $request, Product $product)
    {

        $data = request()->validate([
            'count' => 'required|numeric',
            'date_time' => 'required',


        ]);

       $inventory =  $product->inventories()->create($data);
        return redirect()->back();
    }
}
