@extends('layouts.app', ['activePage' => 'customers', 'titlePage' => __('Customers')])

@section('content')

    <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-12 text-right">
            <a href="/customers/create" class="btn">
              
                Add New
            </a>

            <a href="#">
              <button class="btn">Import</button>
            </a>
            <a  href="{{ route('exportCustomer') }}" class="btn ">Export</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Customers</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Actions</th>
                  </thead>
                  <tbody>
                    @foreach ( $customers as $customer )
                    <tr>
                      <td>{{ $customer->id }}</td>
                      <td>{{ $customer->name }}</td>
                      <td>{{ $customer->email }}</td>
                      <td>{{ $customer->phone }}</td>
                      <td>{{ $customer->address }}</td>
                      <td>
                        <a href="/customers/{{$customer->id}}/edit">
                          <span class="material-icons">edit</span>
                        </a>
                        <form action="/customers/{{ $customer->id }}" method="POST" style="display: inline-block; cursor: pointer; color:#9c27b0">
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
@endsection