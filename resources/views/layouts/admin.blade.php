<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cs143 </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href='/jquery.datetimepicker.css'>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      @auth
      <li class="nav-item active">
        @if (Route::has('register'))
                <a class = "nav-link"href="{{ route('register') }}">Add User</a>
        @endif
      </li>
      @endauth
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="/products">Product Management</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="/inventories">Inventory Management</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="/transactions">Make Transaction</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
 @yield('content')











    <script src='/js/jquery.min.js'></script>

    <script src='/js/bootstrap.js'></script>
    <script src='/js/bootstrap.min.js'></script>
    <script src='/js/jsCalculate.js'></script>


</body>
</html>
