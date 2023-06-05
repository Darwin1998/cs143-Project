@extends('layouts.admin')

@section('content')
<div class="card" style="width: 25rem;">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th></th>
                </tr>

            </thead>
            <tbody>

                @foreach ($customers as $c)
                    <form action="/transactions/{{$c->id}}" method="POST">
                        @csrf
                        <tr>
                            <td>{{$c->name}}</td>
                            <td>{{$c->contact_number}}</td>
                            <td><button name="customerId" class="btn btn-primary" value="{{$c->id}}">select</button></td>
                        </tr>
                    </form>

                @endforeach

            </tbody>
        </table>
    </div>
  </div>

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
                                    <form action="/transactions/{{ $product->id }}" method="POST">
                                        @csrf
                                        <tr>

                                            <td> {{ $product->id }} </td>
                                            <td> {{$product->name}} </td>
                                            <td>{{$product->getCurrentStocksAttribute()}}</td>
                                            <td> {{$product->price}} </td>

                                            <td><button class="btn btn-dark" type="submit" @if ($product->getCurrentStocksAttribute() == 0)
                                                style="visibility: hidden"
                                            @endif>Add</button></td>


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
                                        <td> {{ $cartItem["quantity"]}}</td>

                                        <td class="text-right">
                                            {{$cartItem["item_total"]}}
                                        </td>
                                        <td> <button type="submit" name="product_id" value="{{ $cartItem["product_id"] }}"  class="btn btn-danger">x</button></td>
                                    </tr>


                                </form>

                            @endforeach



                    </tbody>

                </table>
               <p>Total: <h3>{{$total}}</h3></p>
                <div class="text-right">


                    <a  href="/transactions/checkout"

                        @if(count($cart) == 0) style="visibility: hidden" @endif

                        class="btn btn-success">Checkout</a>
                </div>
                </div>
              </div>
            </div>

        </div>
    </div>

  </div>


@endsection
