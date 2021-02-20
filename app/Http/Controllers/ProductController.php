<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
        $products = Product::query()->paginate(5);
        return view('product.index', compact('products'));
    }
    public function create()
    {
        $product = new Product();
        return view('product.create', compact('product'));

    }
    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            
        ]);

        Product::create($data);
        return redirect('/products');
    }

    public function show(Product $product)
    {
        
        
        return view('product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }
    public function update(Product $product)
    {
        $data = request()->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            
        ]);

        $product->update($data);
        return redirect('/products');
    }
}
