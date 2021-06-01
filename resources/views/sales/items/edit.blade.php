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
                    <form action="/items/{{ $item->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="input-group mb-4">
                            <input type="text" class="form-control"  value="{{ $item->name }}" name="name" required >
                        </div>
                        <div class="input-group mb-4">
                            <input type="text" class="form-control"  name="sales_price" value="{{ $item->sales_price }}" required >
                            <input type="text" class="form-control" name="purchase_price" value="{{ $item->purchase_price }}" required >
                        </div>
                        <div class="input-group mb-4">
                            <select class="form-select" aria-label="Default select example" name="category_id">
                                <option selected>{{ $item->category->name }}</option>
                                @foreach ($categories as $category )
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach   
                            </select>
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