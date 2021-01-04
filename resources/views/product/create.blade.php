@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create product</div>

                <div class="card-body">

                    <form action="/products" method="POST" id="product">
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
                        <button type="submit" class="btn btn-primary">Create Product</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
