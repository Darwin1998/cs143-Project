<?php

namespace App\Http\Controllers;
use\App\Product;
use App\TransactionOfItem;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class TransactionOfItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Product $product)
    {
        $cart = session("cart",[]);
        $total = collect($cart)->sum(function($item) {

        });

        $products = Product::query()->paginate(5);
        return view('transaction_of_items.index', compact('products','cart','total'));
    }

    public function store(Request $request,Product $products)
    {


    }
   public function addToCart(Request $request)
   {
       $productID = $request->product_id;
       $productName = $request->product_name;
       $productPrice = $request->product_price;
       $cart = session("cart",[]);

       $found = false;

       foreach($cart as &$item)
       {
           if($item["product_id"] == $productID)
           {
               $item["counter"]++;
               $item["item_total"]=$item["counter"] * $item["product_price"];
               $found = true;
           }
       }
       if ($found == false)
       {
           $cart[] = [
            "item_total" => $productPrice,
            "counter" => 1,
            "product_id" => $productID,
            "product_name" =>$productName,
            "product_price" => $productPrice,

           ];

       }

       session()->put("cart",$cart);

      return redirect()->route("index");
   }
   public function removefromCart(Request $request)
    {

        //Process herr
        $productId = $request->product_id;

        $cart = session("cart", []);


        foreach ($cart as $index => $item) {
            if ($item["product_id"] == $productId) {
                unset($cart[$index]);
            }
        }


        session()->put("cart", $cart);

        return redirect()->route("index");
    }


}
