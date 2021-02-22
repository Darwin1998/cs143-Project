<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\TransactionOfItem;
use App\Product;
use \Carbon\Carbon;
use App\Inventory;

class TransactionController extends Controller
{
    public function index()
    {


        $transactions = Transaction::query()->get();


        return view('transactions.index',compact('transactions'));
    }
    public function details(Transaction $transaction)
    {

        return view('transactions.details', compact('transaction'));
    }

    public function create(Product $product,Request $request, Customer $customer)
    {
        $cart = session("cart",[]);//session data

        $total = collect($cart)->sum(function($item) { //traverse session and get the sum
            return $item['item_total'];
        });

        $products = Product::query()->paginate(5);//query for all products available

        $customers = Customer::query()->paginate(5);
        return view('transactions.cart', compact('products','cart','total','customers'));
    }

    public function cancel(Transaction $transaction)
    {

        $details = [

          'status'=> 'cancelled'

        ];
        $transaction->update($details);



    }
    public function complete(Transaction $transaction)
    {

        $details = [

          'status'=> 'completed'

        ];
        $transaction->update($details);



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
               $item["quantity"] ++;
               $item["item_total"]=$item["quantity"] * $item["product_price"];
               $found = true;

           }
       }
       if ($found == false)
       {
           $cart[] = [

            "product_id" => $productID,
            "product_name" =>$productName,
            "quantity" => 1,
            "product_price" => $productPrice,
            "item_total" => $productPrice,






           ];

       }

       session()->put("cart",$cart);


      return redirect()->route("create");
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

        return redirect()->route("create");
    }
    public function checkout(Request $request)
    {
        $cart = session("cart",[]);//session data
        $total = collect($cart)->sum(function($item) { //traverse session and get the sum
            return $item['item_total'];
        });
        $customers = Customer::query()->paginate(5);

        return view('transactions.checkout', compact('cart','total','customers'));
    }
    public function selectCustomer(Request $request)
    {
        $customer = $request->customerId;
         session()->put('customer',$customer);
         return redirect()->back();
    }


    public function payment(Request $request)
    {
        $cart = session("cart",[]);
        $total = collect($cart)->sum(function($item) { //traverse session and get the sum
            return $item['item_total'];
        });
        $status = $request->status == 'reserve'? 'reserved': 'completed';
        $customer = session()->get('customer');
        $details = [
          "date" => Carbon::now(),
          "OR_number"=> $this->generateOR(),
          'total_amount' => $total,
          'status'=> $status,
          'customer_id' => $customer


        ];
        $transaction = Transaction::create($details);

        foreach($cart as $c){
            $transaction->transactionitems()->create($c);
            Inventory::create([
                "product_id" => $c["product_id"],
                "count" => -$c["quantity"],
                "date_time" => date("Y-m-d h:i:s A")
             ]);

        }



        $request->session()->forget('cart');

        return redirect('/transactions');







    }
   public function generateOR()
    {
        $or_number = "OR-" . str_pad( Transaction::count() + 1 , 8, '0', STR_PAD_LEFT);
        return $or_number;

    }


}
