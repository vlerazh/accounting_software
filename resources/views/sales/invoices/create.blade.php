@extends('layouts.app', ['activePage' => 'invoices', 'titlePage' => __('Invoices')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">New Invoice</h4>
                    <p class="card-category">Here you can add a new invoice</p>
                </div>
                <div class="card-body">
                    <form action="/invoices" method="POST">
                        @csrf
                       <div class="input-group mb-4">
                            <input type="date" class="form-control" name="invoice_date"  required >
                            <input type="date" class="form-control" name="due_date"  required >
                        </div>
                        <div class="input-group mb-4">
                            <select name="customer_id">
                                <option selected>-Select a Customer-</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                        {{-- <div class="input-group mb-4">
                            <select name="item_id">
                                <option selected>-Select an Item-</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name}}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        {{-- @livewire('items') --}}
                        <div class="card">
                            <div class="card-header">
                                Items
                            </div>
                    
                            <div class="card-body">
                                <table class="table" id="items_table">
                                    <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{-- @foreach ($orderItems as $index => $orderItems) --}}
                                        <tr>
                                            <td>
                                                <select name="item_id" class="form-control" id="items">
                                                    <option value="">-- choose item --</option>
                                                    @foreach ($items as $item)
                                                        <option value="{{ $item->id }}" >
                                                            {{ $item->name }}                                        
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number"
                                                       name="quantity"
                                                       class="form-control"
                                                       id="quantity"/>
                                                      
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" id="price" name="quantity">
                                            </td>
                                            <td>
                                                {{-- <a href="#" wire:click.prevent="removeItem({{$index}})">Delete</a> --}}
                                            </td>
                                        </tr>
                                    {{-- @endforeach --}}
                                    </tbody>
                                </table>
                    
                                <div class="row">
                                    <div class="col-md-12">
                                        <a class="btn btn-sm btn-secondary add_item">+ Add Another item</a>
                                    </div>
                                </div>
                            </div>
                        </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
var counter = 1;
var items = {!! json_encode($items->toArray()) !!}

console.log(items)
$('.add_item').click(function(event){
    console.log('add')
    event.preventDefault();
    counter++;
    var select = document.createElement('select')
    for(var i = 0 ; i< items.length ; i++){
       var opt = items[i]
       var el = document.createElement('option')
       el.textContent = opt.name
       el.value = opt.id
       select.appendChild(el)
    }

    // var newRow = jQuery(
    //    select +
    //     counter + '"/></td><td><input type="text" name="last_name' +
    //     counter + '"/></td></tr>');
    // $('#items_table').append(newRow);
});
</script>