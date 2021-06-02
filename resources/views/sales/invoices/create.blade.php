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
                        {{-- @csrf --}}
                        <div id="create-invoice">
                            <create-invoice></create-invoice>
                        </div>
           
                        <div class="input-group">
                            <input type="submit" value="Cancel" class="btn btn-light">
                            <input type="submit" value="Save" class="btn btn-success">
                        </div>
                    </div>
               
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal -->

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

@push('footer-scripts')
    <script>
        var createForm = new Vue({
            el: '#create-invoice',
            
        })
    </script>
@endpush


{{-- 
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
</script> --}}