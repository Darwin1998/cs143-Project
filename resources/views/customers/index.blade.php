@extends('layouts.admin')

@section('content')

<div class="row d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 style="text-align: center">Customers</h5>
                <div class="ml-auto">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <form action="/search" method="POST" role="search">
                                    <td>

                                            @csrf
                                            <div class="inner-addon right-addon">
                                                <i class="fa fa-search text-warning"></i>
                                                <input style="width: 420px" type="text" name="q" placeholder="Search customer..."
                                                    class="form-control"/><span class="input-group-btn">


                                            </div>
                                            <button  type="submit" style="inline-block" class="btn btn-primary float float-left">
                                                Search
                                            </button>

                                    </td>
                                </form>
                                <td>
                                    <button id="new-customer-button" type="button" class="btn btn-primary float float-right" data-toggle="modal" data-target="#CustomerModal">
                                        New Customer
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>



                <!-- Button trigger modal -->


            </div>
            <div class="card-body">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>


                    @forelse($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->contact_number}}</td>
                            <td>
                                <button
                                        data-customer-name="{{ $customer->name }}"
                                        data-customer-address="{{ $customer->address }}"
                                        data-customer-contact="{{ $customer->contact_number }}"

                                        data-customer-id="{{ $customer->id }}"
                                        class="btn btn-primary edit-button">Edit

                                </button>
                                <button
                                        data-customer-name="{{ $customer->name }}"
                                        data-customer-address="{{ $customer->address }}"
                                        data-customer-contact="{{ $customer->contact_number }}"

                                        data-customer-id="{{ $customer->id }}"
                                        class="btn btn-danger delete-button">Delete

                                </button>
                            </td>
                            <td>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No data</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{$customers->links()}}

            </div>
        </div>
    </div>
</div>















  <!-- Modal -->
  <div class="modal fade" name="CustomerModal" id="CustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div id="success-container"></div>
            <div id="error-container"></div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputName">Name</label>
                    <input  name="name"type="text" class="form-control"  placeholder="Name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputAddress">Address</label>
                    <input name="address"type="text" class="form-control"  placeholder="Address">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputContact">Contact</label>
                  <input name="contact_number"type="text" class="form-control" placeholder="+639xxxxxxxxxx">
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

        let selectedCustomerId = null;

        $("#new-customer-button").click(function () {

            selectedCustomerId = null;

            $("#CustomerModal .modal-title").html("New Customer")


            $("#error-container").html("")
            $(`#CustomerModal input[name="name"]`).val("");
            $(`#CustomerModal input[name="address"]`).val("");
            $(`#CustomerModal input[name="contact_number"]`).val("");


            $("#CustomerModal").modal({
                backdrop: 'static'
            })
        });


        $(".edit-button").click(function () {

            selectedCustomerId = $(this).data("customer-id");

            const name = $(this).data("customer-name");
            const address = $(this).data("customer-address");
            const contact = $(this).data("customer-contact");


            $(`#CustomerModal input[name="name"]`).val(name);
            $(`#CustomerModal input[name="address"]`).val(address);
            $(`#CustomerModal input[name="contact_number"]`).val(contact);



            $("#CustomerModal .modal-title").html("Edit Customer")

            $("#error-container").html("")

            $("#CustomerModal").modal({
                backdrop: 'static'
            })
        });


        $("#CustomerModal .save-button").click(function ()
        {

            const name = $(`#CustomerModal input[name="name"]`).val();
            const address = $(`#CustomerModal input[name="address"]`).val();
            const contact = $(`#CustomerModal input[name="contact_number"]`).val();
            console.log(contact);

           $.ajax({
                url: selectedCustomerId == null ? "/customers" : `customers/${selectedCustomerId}`,
                method: selectedCustomerId == null ? "POST" : "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: name,
                    address: address,
                    contact_number: contact

                },
                success: function (response) {
                    let html = "<div class = 'alert aler-success'> Customer added!<div>";
                    $("#success-container").html(html);
                    alert('Customer added!');

                    $("#CustomerModal").modal("hide");


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
