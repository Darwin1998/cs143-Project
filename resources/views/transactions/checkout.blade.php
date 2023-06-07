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
            <form action="{{ route('transaction.payment') }}" method="POST">
                @foreach ($cart as $cartItem )
                        @csrf
                        <tr>
                        <td style=": blue"> {{ $cartItem["product_name"] }} </td>
                        <td>{{ $cartItem["product_price"] }}</td>
                        <td>{{ $cartItem["quantity"]}}</td>
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
                            <button class="btn btn-success"  name="complete" type="submit">@if(count($cart) == 0) disabled @endif
                                Place Order</button>


                    </form>
      </div>
      </div>
    </div>
  </div>

@endsection
