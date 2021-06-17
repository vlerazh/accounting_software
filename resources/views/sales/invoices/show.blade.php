@extends('layouts.app', ['activePage' => 'invoices', 'titlePage' => __('Invoices')])

@section('content')
<div class="content">
    <div class="container">
        <div class="row"> 
        <div class="col-12">
            <button class="print btn btn-primary">Print Preview</button>
            <div class="card" id="invoice">
                <div class="card-body p-0">
                    <div class="row p-5">
                        <div class="col-md-6">
                            <img src="http://via.placeholder.com/400x90?text=logo">
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-1">Invoice {{ $invoice->invoice_no }}</p>
                            <p class="text-muted">Due to: {{ $invoice->due_date }}</p>
                        </div>
                    </div>

                    <hr class="my-5">

                    <div class="row pb-5 p-5">
                        <div class="col-md-6">
                            <p class="font-weight-bold mb-4">Client Information</p>
                            <p class="mb-1">Name: {{ $customer->name }}</p>
                            <p class="mb-1">Phone: {{ $customer->phone }}</p>
                            <p class="mb-1">Email: {{ $customer->email }}</p>
                            <p class="mb-1">Address: {{ $customer->address }}</p>
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-4">Payment Details</p>
                            <p class="mb-1"><span class="text-muted">VAT: </span> 1425782</p>
                            <p class="mb-1"><span class="text-muted">VAT ID: </span> 10253642</p>
                            <p class="mb-1"><span class="text-muted">Payment Type: </span> Root</p>
                            <p class="mb-1"><span class="text-muted">Name: </span> John Doe</p>
                        </div> 
                    </div>

                    <div class="row p-5">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold">ID</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Item Name</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Unit Cost</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item )
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->pivot->quantity }}</td>
                                            <td>{{ $item->sales_price }}</td>
                                            <td>{{ $item->pivot->quantity * $item->sales_price }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Grand Total</div>
                            <div class="h2 font-weight-light">{{ $invoice->total }}</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Discount</div>
                            <div class="h2 font-weight-light">{{ $invoice->discount }} %</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Sub Total amount</div>
                            <div class="h2 font-weight-light">{{ $invoice->sub_total }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js" integrity="sha512-i8ERcP8p05PTFQr/s0AZJEtUwLBl18SKlTOZTH0yK5jVU0qL8AIQYbbG5LU+68bdmEqJ6ltBRtCxnmybTbIYpw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.print').click(function(){
       window.print()
    });
</script>
@endsection

