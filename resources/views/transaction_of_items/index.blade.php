@extends('layouts.admin')

@section('content')
<div class="card text-center">
    <div class="card-header">
        <h3>Transaction</h3>
    </div>
    <div class="card-body">
        <div class="row">

            <div class="col-sm-6">
              <div class="card">
                <div class="card-header">
                    <h4>Products</h4>
                </div>
                <div class="card-body">
                  <!-- products-->

                  <table class="table">
                      <thead class="thead-dark">
                            <tr>

                                <th>Id#</th>
                                <th>Name</th>
                                <th>Stocks Remaining</th>
                                <th>Price</th>
                                <th></th>

                            </tr>
                      </thead>
                      <tbody>


                                @foreach ($products as $product )
                                    <form action="/transactions" method="POST">
                                        @csrf
                                        <tr>

                                            <td ><input name="product_id" type="text" value="{{$product->id}}" style="border: 0px; width: 20px" readonly></td>
                                            <td><input name="product_name" type="text" value="{{$product->name}}" style="border: 0px;width: 100px" readonly></td>
                                            <td>{{$product->getCurrentStocksAttribute()}}</td>
                                            <td><input name="product_price"type="text" value="{{$product->price}}" style="border: 0px;width: 50px" readonly></td>

                                            <td><button class="btn btn-dark" type="submit" name="product_id" value = "{{$product->id}}">Add</button></td>


                                        </tr>
                                    </form>

                                @endforeach



                      </tbody>

                  </table>

                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="card">
                <div class="card-header"><h4>Cart</h4></div>
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
                                <form action="/transactions" method="POST">
                                    @method("DELETE")
                                    @csrf


                                    <tr>

                                        <td style=": blue">{{ $cartItem["product_name"] }}</td>
                                        <td>{{ $cartItem["product_price"] }}</td>
                                        <td> {{ $cartItem["counter"]}}</td>

                                        <td class="text-right">
                                            {{$cartItem["item_total"]}}
                                        </td>
                                        <td> <button type="submit" name="product_id" value="{{ $cartItem["product_id"] }}"  class="btn btn-danger">x</button></td>
                                    </tr>


                                </form>

                            @endforeach



                    </tbody>

                </table>
                {{$total}}
                <div class="text-right">

                    <button

                        @if(count($cart) == 0) disabled @endif

                        class="btn btn-success">Checkout</button>
                </div>
                </div>
              </div>
            </div>

        </div>
    </div>
    <div class="card-footer text-muted">
      2 days ago
    </div>
  </div>

<p style="font"></p>
@endsection
