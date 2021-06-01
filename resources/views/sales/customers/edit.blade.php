@extends('layouts.app', ['activePage' => 'customers', 'titlePage' => __('Customers')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Edit Customer</h4>
                    <p class="card-category">Here you can edit a customer</p>
                </div>
                <div class="card-body">
                    <form action="/customers/{{ $customer->id }}" method="POST">
                        @csrf
                        @method('PUT')
                       <div class="input-group mb-4">
                            <input type="text" class="form-control" name="name" value="{{ $customer->name }}" required >
                            <input type="text" class="form-control" name="email" value="{{ $customer->email }}" required >
                        </div>
                       <div class="input-group mb-4">
                            <input type="text" class="form-control" name="phone" value="{{ $customer->phone }}" required >
                        </div>
                        <div class="input-group mb-4">
                         
                            <input type="text" class="form-control" name="address" value="{{ $customer->address }}">
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