<div>
    {{-- Success is as dangerous as failure. --}}
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
                @foreach ($orderItems as $index => $orderItems)
                    <tr>
                        <td>
                            <select name="orderItems[{{$index}}]"
                                    wire:model="orderItems.{{$index}}.item_id"
                                    class="form-control" id="items">
                                <option value="">-- choose item --</option>
                                @foreach ($allItems as $item)
                                    <option value="{{ $item->id }}" data-price="{{ $item->sales_price }}">
                                        {{ $item->name }}                                        
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number"
                                   name="orderItems[{{$index}}][quantity]"
                                   class="form-control"
                                   id="quantity"
                                   wire:model="orderItems.{{$index}}.quantity" />
                        </td>
                        <td>
                            <input type="number" class="form-control" id="price">
                        </td>
                        <td>
                            <a href="#" wire:click.prevent="removeItem({{$index}})">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-sm btn-secondary"
                        wire:click.prevent="addItem">+ Add Another item</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    var items  = document.getElementById('items')
    var price_input = document.getElementById('price')
    var quantity =  document.getElementById('quantity')
    items.onchange = function(event){
        var price = event.target.options[event.target.selectedIndex].dataset.price; 
        price_input.value = price
    }
    if(parseInt(quantity.value) === 1 ){
            price_input.value = price
    } 
    else{
            quantity.onchange = function(){
                quantity = this.value
                price_input.value = parseInt(price) * parseInt(this.value)
            }
           
        }

</script>