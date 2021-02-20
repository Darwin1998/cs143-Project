
@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card mt-8">
                    <div class="card-header" style="text-align: center">
                        <h3>Transactions</h3>
                        <a href="{{ route('create') }}" class="btn btn-primary justify-content-right"> Add Transaction</a>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                  <tr>
                                    <th>Date</th>
                                    <th>OR#</th>
                                    <th>Item Total</th>
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
                                            {{$t->total_amount}}
                                        </td>
                                        <td>
                                            <a href="/transactions/{{$t->id}}/details" class="btn btn-success">View</a>
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
