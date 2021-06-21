@extends('layouts.app', ['activePage' => 'categories', 'titlePage' => __('Categories')])

@section('content')

    <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-12 text-right">
            <a href="/categories/create" class="btn">
              
                Add New
            </a>

            <a href="#">
              <button class="btn">Import</button>
            </a>
            <!-- <downloadExcel
              class   = "btn btn-default"
              :fetch   = "json_data"
              :fields = "json_fields"
              worksheet = "My Worksheet"
              name    = "customers.xls">
                Export
            </downloadExcel> -->
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Categories</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                  </thead>
                  <tbody>
                    @forelse ( $categories as $category )
                    <tr>
                      <td>{{ $category->id }}</td>
                      <td>{{ $category->name }}</td>
                      <td>
                        <a href="/categories/{{$category->id}}/edit">
                          <span class="material-icons">edit</span>
                        </a>
                        <form action="/categories/{{ $category->id }}" method="POST" style="display: inline-block; cursor: pointer; color:#9c27b0">
                            @csrf
                            @method('delete')
                            <button style="background: transparent; border:none;" onclick="return confirm('Are you sure?')"> <span class="material-icons delete">delete</span></button>
                        </form>
                      </td>
                    </tr>
                    @empty
                      <tr>
                        <td><i class="fa fa-folder-open"></i> No Record found</td>
                      </tr>
                    @endforelse
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