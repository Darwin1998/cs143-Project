<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cs143 </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/js/jquery.datetimepicker.css" >

</head>
<body>
    @php
        $user = Auth::user();

    @endphp
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">CS143 Computer Shop</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">


      <li class="nav-item">
        <a class="nav-link " href="/products" @if ($user->position == 'cashier')
            style="visibility: hidden;"
        @endif>Product Management</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="/users"  @if ($user->position == 'cashier')
            style="visibility: hidden;"
        @endif>Users</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="/transactions">Transactions</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="/salesreport" @if ($user->position == 'cashier')
            style="visibility: hidden;"
        @endif>Sales Report</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="/customers">Customer</a>
      </li>

    </ul>

    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{$user->first_name}}
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="nav-link " href="{{ route('logout') }}">Log Out</a>
        </div>
      </div>

  </div>

</nav>
 @yield('content')










    <script src="/js/jquery.js"></script>
    <script src='/js/jquery-3.5.1.min.js'></script>

    <script src='/js/bootstrap.js'></script>
    <script src='/js/bootstrap.min.js'></script>
    <script src='/js/jsCalculate.js'></script>


</body>
</html>
