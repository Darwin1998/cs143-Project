<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header" style="text-align: center">
                      Welcome
                    </div>
                    <div class="card-body" style="text-align: center">
                        <form action="{{ route('authenticate')}}" method="POST" autocomplete="off">
                            @csrf
                            <div class="form-group">
                              <label for="exampleInputEmail1">Email address</label>
                              <input style="text-align: center" name ="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" autocomplete="off">
                              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            @error('message')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                            <div class="form-group">
                              <label for="exampleInputPassword1">Password</label>
                              <input style="text-align: center" name="password"type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" autocomplete="off">
                            </div>

                            <button type="submit" class="btn btn-primary">Log in</button>
                          </form>
                    </div>
                  </div>

            </div>
        </div>
    </div>









</body>
</html>
