
@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card mt-8">
                    <div class="card-header" style="text-align: center">
                        <h3>Sales Report</h3>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                  <tr>
                                    <th>Date</th>
                                    <th>OR#</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Item Total</th>
                                  </tr>
                            </thead>
                            <tbody>

                                @foreach($transactions as $t)

                                    <tr>
                                        <td>

                                            {{$t->date}}
                                        </td>
                                        <td>
                                            {{$t->OR_number}}
                                        </td>
                                        <td>
                                            {{$t->product_name}}
                                        </td>
                                        <td>
                                            {{$t->product_price}}
                                        </td>
                                        <td>
                                            {{$t->quantity}}
                                        </td>
                                        <td>
                                            {{$t->item_total}}
                                        </td>

                                    </tr>


                                @endforeach

                            </tbody>

                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
