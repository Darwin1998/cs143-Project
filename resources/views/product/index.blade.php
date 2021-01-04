@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <div class="card mt-4">
                <div class="card-header" style="text-align: center">
                  Products
                  <button type="button" class="btn btn-success btn-sm btn-lg float-left" data-toggle="modal" data-target="#AddproductModal">
                    Add Product
                  </button>
                </div>
                 <!-- Button trigger modal -->


<!-- Modal  for adding product, built in javascript-->
<div class="modal fade" id="AddproductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="/products" method="POST" id="product">
      <div class="modal-body">
        <div class="card-body">


                        @csrf

                         <div class="form-group">
                            <label for="name">Product Name</label>
                            <input name="name"
                                   type="text"
                                   class="form-control"
                                   id="name"
                                   aria-describedby="namehelp"
                                   placeholder="Enter product name"
                                   value = "{{old('name')}}">

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
                                   value = "{{old('price')}}">

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





                <div class="card-body">



                            <div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th style="text-align: center">
                                                Name
                                            </th>
                                            <th style="text-align: center">
                                               Price
                                            </th>
                                            <th style="text-align: center">
                                                Current Stock
                                             </th>




                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($products as $_product)
                                        <tr>

                                            <td><a href="{{route("products.show",$_product->id)}}" class="btn btn-info">Update</td>
                                            <td>{{$_product->name}}</td>
                                            <td style="text-align:center">₱{{$_product->price}}</td>
                                            <td style="text-align: center">{{$_product->inventories()->sum('count')}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>


                    {!! $products->links() !!}


                </div>
            </div>

        </div>


    </div>
</div>

@endsection
