@extends('layouts.app', ['activePage' => 'items', 'titlePage' => __('Items')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-12 text-right">
            <a href="/items/create" class="btn">
                Add New
            </a>
            <a href="#">
              <button class="btn">Import</button>
            </a>
            <a  href="{{ route('exportItem') }}">
              <button class="btn">Export</button>
            </a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Items</h4>
              <p class="card-category"> Here is a subtitle for this table</p>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Sale Price</th>
                    <th>Purchase Price</th>
                    <th>Total Quantity</th>
                    <th>Actions</th>
                  </thead>
                  <tbody>
                    @foreach ( $items as $item )
                    <tr>
                      <td>{{ $item->id }}</td>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->category->name }}</td>
                      <td>{{ $item->sales_price }}</td>
                      <td>{{ $item->purchase_price }}</td>
                      <td>{{ $item->total_quantity }}</td>
                      <td>
                        <a href="/items/{{$item->id}}/edit">
                          <span class="material-icons">edit</span>
                        </a>
                        <form action="/items/{{ $item->id }}" method="POST" style="display: inline-block; cursor: pointer; color:#9c27b0">
                            @csrf
                            @method('delete')
                            <button style="background: transparent; border:none;" onclick="return confirm('Are you sure?')"> <span class="material-icons delete">delete</span></button>
                        </form>
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