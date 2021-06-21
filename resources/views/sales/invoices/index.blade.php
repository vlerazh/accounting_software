@extends('layouts.app', ['activePage' => 'invoices', 'titlePage' => __('Invoices')])

@section('content')

    <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-12 text-right">
            <a href="/invoices/create" class="btn">
              
                Add New
            </a>

            <a href="#">
              <button class="btn">Import</button>
            </a>
            <a class="btn " href="{{ route('exportInvoice') }}">Export</a>
            <!-- <downloadExcel
              class   = "btn btn-default"
              :fetch   = "json_data"
              :fields = "json_fields"
              worksheet = "My Worksheet"
              name    = "invoices.xls">
                Export
            </downloadExcel> -->
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Invoices</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead class=" text-primary">
                    <th>ID</th>
                    <th>Invoice_no</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Actions</th>
                  </thead>
                  <tbody>
                    @forelse ( $invoices as $invoice )
                    <tr>
                      <td>{{ $invoice->id }}</td>
                      <td>{{ $invoice->invoice_no }}</td>
                      <td>{{ $invoice->customer_id}}</td>
                      <td>{{ $invoice->total }}</td>
                      <td>
                        <a href="/invoices/{{$invoice->id}}/edit">
                          <span class="material-icons">edit</span>
                        </a>
                        <form action="/invoices/{{ $invoice->id }}" method="POST" style="display: inline-block; cursor: pointer; color:#9c27b0">
                            @csrf
                            @method('delete')
                            <button style="background: transparent; border:none;" onclick="return confirm('Are you sure?')"> <span class="material-icons delete">delete</span></button>
                        </form>
                        <a href="/invoices/{{ $invoice->id }}">
                            <span class="material-icons">visibility</span>
                        </a>
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