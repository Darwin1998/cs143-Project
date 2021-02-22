@extends('layouts.admin')

@section('content')
<style>

    input {
      border-top-style: hidden;
      border-right-style: hidden;
      border-left-style: hidden;
      border-bottom-style: hidden;



    }

  </style>
<div class="card" style="width: 30rem;">
    <div class="card-body">
      <h5 class="card-title">Customers</h5>

        <table class="table borderless">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $c)
                <tr>
                    <td ><input type="text" id="customerName" value="{{$c->name}}"></td>
                    <td>{{$c->contact_number}}</td>
                    <td><button class="btn btn-primary" name="customerID" value="{{$c->id}}">select</button></td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <input type="text" id="customer" style="border: 0px" >

    </div>
  </div>
<div class="col-sm-10">
    <div class="card">
      <div class="card-header"><h4 style="text-align: center">Cart</h4></div>
      <div class="card-body">
        <!-- Display Cart-->
        <table class="table">
          <thead class="thead-dark">
                <tr>
                  <th>Products Added</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Item Total</th>
                  <th></th>
                </tr>
          </thead>
          <tbody>

                @foreach ($cart as $cartItem )
                    <form action="/transactions/payment" method="POST">

                        @csrf


                        <tr>

                        <td style=": blue"><input readonly type="text" name="productname" value="{{ $cartItem["product_name"] }}"></td>
                        <td><input readonly type="text" name="productprice"value="{{ $cartItem["product_price"] }}"></td>
                        <td><input readonly type="text" name="quantity" id="" value="{{ $cartItem["quantity"]}}"></td>

                        <td class="text-right"><input readonly type="text" style="margin-right: 150px"value="{{$cartItem["item_total"]}}"></td>


                        </tr>




                @endforeach



          </tbody>

      </table>
                        <p>Amount to pay: <h3>{{$total}}</h3></p>
                        <div class="text-right">

                            <button class="btn btn-warning" name="status"value="reserve" type="submit">
                                Reserve Order
                            </button>
                            <button class="btn btn-success"  name="complete"type="submit">@if(count($cart) == 0) disabled @endif
                                Place Order</button>


                    </form>
      </div>
      </div>
    </div>
  </div>

@endsection
