@extends('layouts.app', ['activePage' => 'items', 'titlePage' => __('Customers')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">New Item</h4>
                    <p class="card-category">Here you can add a new item</p>
                </div>
                <div class="card-body">
                    <form action="/items" method="POST">
                        @csrf
                        <div class="input-group mb-4">
                            <input type="text" class="form-control" placeholder="Enter name" name="name" required >
                        </div>
                        <div class="input-group mb-4">
                            <input type="text" class="form-control" placeholder="Enter sale price" name="sales_price" required >
                            <input type="text" class="form-control" placeholder="Enter purchase price" name="purchase_price" required >
                        </div>
                        <div class="input-group mb-4">
                            <select class="form-select" aria-label="Default select example" name="category_id">
                                <option selected>-Select Category-</option>
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