@extends('layouts.admin')
@section('content')
<link rel="stylesheet" type="text/css" href="/js/jquery.datetimepicker.css" >
 <div class="card border-dark mb-3 d-flex justify-content-center" style="max-width: 18rem; margin-left: 500px">
  <div class="card-header">Product Details</div>
  <div class="card-body text-dark">

    <h5 class="card-title">{{$product->name}}</h5>
    <p class="card-text">Remaining Stock: {{$product->inventories()->sum('count')}}</p>
    <p class="card-text">Price: {{$product->price}}</p>


     <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
  Edit
</button>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ReceiveStocksModal">
    Receive Stocks
  </button>





<!-- Modal  for edit product, built in javascript-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit product details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="/products/{{$product->id}}" method="POST" id="product">

        <div class="modal-body">
            <div class="card-body">
                @method('PUT')


                            @csrf

                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input name="name"
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    aria-describedby="namehelp"
                                    placeholder="Enter product name"
                                    value = "{{$product->name}}">

                                @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Product price</label>
                                <input name="price"
                                    type="text"
                                    class="form-control"
                                    id="price"
                                    aria-describedby="pricehelp"
                                    placeholder="Enter price"
                                    value = "{{$product->price}}">

                                @error('price')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                        <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </div>


                    </div>

        </div>
        </form>
        </div>
    </div>
    </div>


    <!-- Modal  for Receive stocks, built in javascript-->
    <div class="modal fade" id="ReceiveStocksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Receive Stocks</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/products/{{$product->id}}" method="POST" id="product">

            <div class="modal-body">
                <div class="card-body">



                                @csrf

                                <div class="form-group">
                                    <label for="date_time">Date</label>
                                    <input name="date_time"id="datetimepicker" type="text" autocomplete="off">
                                    <script src="/js/jquery.js"></script>
                                    <script src="/js/build/jquery.datetimepicker.full.min.js"></script>
                                    <script>
                                       jQuery('#datetimepicker').datetimepicker({
                                            format:'Y-m-d h:i:s A',

                                            });
                                    </script>

                                    @error('date')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="count">How many?:</label>
                                    <input name="count"
                                        type="text"
                                        class="form-control"
                                        id="count"
                                        aria-describedby="counthelp">



                                    @error('count')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                            <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                        </div>


                        </div>

            </div>
            </form>
            </div>
        </div>
        </div>
</div>
 </div>
 <caption>Inventory Logs </caption>
 <table class="table">
    <thead class="thead-dark">
      <tr>

        <th scope="col">Date</th>
        <th scope="col">Type</th>
        <th scope="col">Count</th>


      </tr>
    </thead>



    <tbody>
        @foreach ($product->inventories as $inventory )
          <tr>

            <td>{{ $inventory->date_time }}</td>
            <td>{{ $inventory->count > 0 ? "Received":"Released"}}</td>
            <td>{{ abs($inventory->count) }}</td>
          </tr>
        @endforeach


    </tbody>

  </table>
@endsection
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->

@section('scripts')
<script src="/js/jquery.js"></script>
<script src="/js/build/jquery.datetimepicker.full.min.js"></script>
<script>
    jQuery('#datetimepicker').datetimepicker();
</script>
@endsection



