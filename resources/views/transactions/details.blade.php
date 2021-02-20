@extends('layouts.admin')
@section('content')

    @foreach ($transaction->transactionitems as $item )
        <h1>{{$item->product_name}}</h1>
    @endforeach
@endsection
