@extends('layouts.admin')
@section('content')

<div class="card">
    <h5 class="card-header">Transaction Details ({{$transaction->status}})</h5>
    <div class="card-body">



        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($transaction->transactionitems as $item)
                <tr>
                    <td>{{$item->product_name}}</td>
                    <td>{{$item->product_price}}</td>
                    <td>{{$item->quantity}}</td>

                </tr>
                @endforeach
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

