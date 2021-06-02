<template>
<div>
    <div class="card">
        <div class="card-header">
            Items
        </div>

        <div class="card-body">
            <table class="table" id="items_table">
                <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    </tr>
                </thead>
                <tbody v-if="items">
                    <tr v-for="item in items" :key="item.id" >
                        <td>
                            {{ item.name }}
                        </td>
                        <td>
                            {{ item.quantity }}        
                        </td>
                        <td>
                           {{ item.sales_price }}
                        </td>
                        <td>
                            {{ item.total }}
                        </td>
                    </tr>

                </tbody>
            </table>
            <hr>
            <div class="row">
                <div class="col-xl-4 offset-9">
                <label for="sub-total">Sub-Total</label>
                <div class="col-sm-7" style="display:inline-block">
                    <input type="number" class="form-control" id="sub-total">
                </div> <br>
                <label for="discount">Discount</label>
                <div class="col-sm-7" style="display:inline-block">
                    <input type="number" class="form-control" id="discount">
                </div> <br>
                <label for="total">Total</label>
                <div class="col-sm-7" style="display:inline-block">
                    <input type="number" class="form-control" id="total">
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#itemsModal">+ Add Another item</a>
                </div>
            </div>
        </div>
    </div>
    <ItemsModal @selected-item="selectedItem"/>
</div>
</template>

<script>
import ItemsModal from '../partials/ItemsModal'
export default {
    name: 'InvoiceItems',
    data(){
        return{
            items:[]
        }
    },
    components:{
        ItemsModal: ItemsModal
    },
    methods:{
        selectedItem(item){
            this.items.push(item)
        }
    }
}
</script>