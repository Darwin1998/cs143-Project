@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <h5 class="d-flex flex-row align-items-center">
                    Transaction Details
                </h5>

                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td>OR number: </td>
                            <td>{{$transaction->OR_number}}</td>
                        </tr>
                        <tr>
                            <td>Transaction Date: </td>
                            <td>{{$transaction->date}}</td>
                        </tr>
                        <tr>
                            <td>Customer</td>
                            <td>{{!empty($transaction->customer['name']) ? $transaction->customer['name']:'N/A'}}</td>
                        </tr>
                        <tr>
                            <td>
                                Status:
                            </td>
                            <td>
                                {{$transaction->status}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Total Amount:
                            </td>
                            <td>
                                {{$transaction->status == 'cancelled'?'Cancelled':$transaction->total_amount}}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <button
                id="complete-button"
                @if ($transaction->status == 'completed' ||$transaction->status == 'cancelled')
                     style="visibility: hidden"


                 @endif class="btn btn-primary">
                     Complete Transaction
               </button>

               <button
                 id="cancel-button"
                 @if ($transaction->status == 'completed'||$transaction->status == 'cancelled')
                     style="visibility: hidden"

                 @endif class="btn btn-warning">
                     Cancel Transaction
               </button>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header"><h5>Items</h5></div>
            <div class="card-body">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction->transactionitems as $item)
                        <tr>

                            <td>{{$item->product_name}}</td>
                            <td>{{$item->product_price}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->item_total}}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>





@endsection
<script src="/js/jquery.js"></script>
<script src="/js/jquery-3.5.1.min.js"></script>

<script>
$(document).ready(function () {

    let transactionID = {{$transaction->id}};

    $("#complete-button").click(function () {
        $.ajax({
            url:  "/transactions/{{ $transaction->id }}/complete",
            method:  "PUT",
            data: {
                _token: "{{ csrf_token() }}",

                status: 'completed'
            },
            success: function (response) {

                    document.location.href='/transactions';
                }




        });

    });


    $("#cancel-button").click(function () {

        $.ajax({
            url:  "/transactions/{{ $transaction->id }}/cancel",
            method:  "PUT",
            data: {
                _token: "{{ csrf_token() }}",

                status: 'cancelled'
            },
            success: function (response) {

                    document.location.href='/transactions';
                }




        });
    });



});
</script>

