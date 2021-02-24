@extends('layouts.admin')

@section('content')
<div class="row d-flex justify-content-center">
  <div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h4 style="text-align: center">Users</h4>
            <!-- Button trigger modal -->
            <button id="new-user-button" type="button" class="btn btn-primary float float-right" data-toggle="modal" data-target="#UserModal">
                New User
            </button>
        </div>
        <div class="card-body">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>


                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->position }}</td>
                        <td>
                            <button
                                    data-user-email="{{ $user->email }}"
                                    data-user-password="{{ $user->password }}"
                                    data-user-first_name="{{ $user->first_name }}"
                                    data-user-last_name="{{ $user->last_name }}"
                                    data-user-position="{{ $user->position }}"
                                    data-user-id="{{ $user->id }}"
                                    class="btn btn-primary edit-button">Edit

                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No data</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>
    </div>
  </div>
</div>















  <!-- Modal -->
  <div class="modal fade" name="UserModal" id="UserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div id="error-container"></div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail">Email</label>
                    <input  name="email"type="email" class="form-control"  placeholder="Email">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input name="password"type="password" class="form-control"  placeholder="Password">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputFirstName">First Name</label>
                  <input name="first_name"type="text" class="form-control" placeholder="First Name">
                </div>
                <div class="form-group">
                  <label for="inputLastName">Last Name</label>
                  <input name="last_name"type="text" class="form-control"  placeholder="Last Name">
                </div>
                <div class="form-group">
                    <label for="position">Choose position:</label>

                    <select name="position" id="position">
                        <option >------</option>
                        <option value="admin">Admin</option>
                        <option value="manager">Manager</option>
                        <option value="cashier">Cashier</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <button id="save-button"type="submit" class="btn btn-primary save-button">Add</button>

        </div>

      </div>
    </div>
  </div>
@endsection
<script src="/js/jquery.js"></script>
<script src="/js/jquery-3.5.1.min.js"></script>

<script>
    $(document).ready(function () {

        let selectedUserId = null;

        $("#new-user-button").click(function () {

            selectedUserId = null;

            $("#UserModal .modal-title").html("New User")


            $("#error-container").html("")
            $(`#UserModal input[name="email"]`).val("");
            $(`#UserModal input[name="password"]`).val("");
            $(`#UserModal input[name="first_name"]`).val("");
            $(`#UserModal input[name="last_name"]`).val("");
            $(`#UserModal option:selected`).val("");

            $("#UserModal").modal({
                backdrop: 'static'
            })
        });


        $(".edit-button").click(function () {

            selectedUserId = $(this).data("user-id");

            const email = $(this).data("user-email");
            const password = $(this).data("user-password");
            const first_name = $(this).data("user-first_name");
            const last_name = $(this).data("user-last_name");
            const position = $(this).data("user-position");

            $(`#UserModal input[name="email"]`).val(email);
            $(`#UserModal input[name="password"]`).val(password);
            $(`#UserModal input[name="first_name"]`).val(first_name);
            $(`#UserModal input[name="last_name"]`).val(last_name);


            $("#UserModal .modal-title").html("Edit User")

            $("#error-container").html("")

            $("#UserModal").modal({
                backdrop: 'static'
            })
        });


        $("#UserModal .save-button").click(function ()
        {

            const email = $(`#UserModal input[name="email"]`).val();
            const password = $(`#UserModal input[name="password"]`).val();
            const first_name = $(`#UserModal input[name="first_name"]`).val();
            const last_name = $(`#UserModal input[name="last_name"]`).val();
            const position = $(`#UserModal option:selected`).val();
            console.log(position);


           $.ajax({
                url: selectedUserId == null ? "/users" : `users/${selectedUserId}`,
                method: selectedUserId == null ? "POST" : "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    email: email,
                    password: password,
                    first_name: first_name,
                    last_name: last_name,
                    position: position

                },
                success: function (response) {
                    $("#UserModal").modal("hide");
                    document.location.reload();
                },
                error: function (e) {
                    console.log(e.responseJSON.errors)

                    let html = "<div class='alert alert-danger'> Errors <ul>";

                    const errors = e.responseJSON.errors;

                    for (const key in errors) {
                        html += `<li>${errors[key]}</li>`
                    }

                    html += "</li></div>";

                    $("#error-container").html(html);

                }
            });

        });

    });
</script>
