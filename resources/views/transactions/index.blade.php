
@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card mt-8">
                    <div class="card-header" style="text-align: center">
                        <h3>Transactions</h3>
                        <a href="{{ route('create') }}" class="btn btn-primary btn-lg float-right btn-sm"> New Transaction</a>
                    </div>

                        <p></p>

                    <div class="card-body">
                        <table class="table striped" s>
                            <thead class="thead-dark">
                                  <tr>
                                    <th>Date</th>
                                    <th>OR#</th>
                                    <th>Customer</th>
                                    <th>Item Total</th>
                                    <th>Status</th>
                                    <th></th>
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
                                            {{!empty($t->customer['name']) ? $t->customer['name']:'N/A'}}
                                        </td>
                                        <td>
                                            {{$t->total_amount}}
                                        </td>
                                        <td>
                                            <span class="@if($t->status == "reserved") badge badge-warning
                                                        @elseif($t->status == "completed")badge badge-success
                                                        @elseif($t->status == "cancelled")badge badge-danger @endif" >
                                                {{$t->status}}
                                        </td>
                                        <td>
                                            <a href="/transactions/{{$t->id}}/details" class="btn btn-outline-dark btn-sm">View</a>
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
