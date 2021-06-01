@extends('layouts.app', ['activePage' => 'customers', 'titlePage' => __('Customers')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">New Customer</h4>
                    <p class="card-category">Here you can add a new customer</p>
                </div>
                <div class="card-body">
                    <form action="/customers" method="POST">
                        @csrf
                       <div class="input-group mb-4">
                            <input type="text" class="form-control" name="name" placeholder="Enter name"  required >
                            <input type="text" class="form-control" name="email" placeholder="Enter email" required >
                        </div>
                       <div class="input-group mb-4">
                            <input type="text" class="form-control" name="phone" placeholder="Enter phone" required >
                        </div>
                        <div class="input-group mb-4">
                         
                            <input type="text" class="form-control" name="address" placeholder="Enter address">
                        </div>
                        <input type="submit" value="Cancel" class="btn btn-light">
                        <input type="submit" value="Save" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@if ($errors->any())
<div>
    @foreach ($errors->all() as $error )
        <li>
            {{ $error }}
        </li>
    @endforeach
</div>
@endif
@endsection