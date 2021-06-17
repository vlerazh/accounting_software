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
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody v-if="items">
                   
                    <tr v-for="(item,index) in items" :key="index" >
                        <td>
                            {{ item.name }}
                        </td>
                        <td>
                            {{ item.quantity }}        
                        </td>
                        <td>
                           {{ item.sales_price }} $
                        </td>
                        <td>
                            {{ item.total }} $
                        </td>
                        <td>
                            <button class="btn btn-danger" @click.prevent="deleteItem(index)">Delete</button>
                        </td>
                    </tr>

                </tbody>
            </table>
            <hr>
            <div class="row">
                <div class="col-xl-4 offset-9">
                    <label for="sub-total">Sub-Total</label>
                    <div class="col-sm-7" style="display:inline-block">
                        <input class="form-control" name="sub_total" v-model="sub_total"/>
                    </div> <br>
                    <label for="discount">Discount</label>
                    <div class="col-sm-7" style="display:inline-block">
                        <input type="number" class="form-control" id="discount" name="discount"  v-model="discount">
                    </div> <br> <br>
                    <label for="total">Total</label>
                    <div class="col-sm-7" style="display:inline-block">
                          <input class="form-control" name="total" v-model="totalAmount"/>
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
    <ItemsModal @selected-item="selectedItem" :invoice_id="invoice_id"/>
        <div class="input-group">
            <input type="submit" value="Cancel" class="btn btn-light">
            <input type="submit" value="Save" class="btn btn-success" @click.prevent="saveItems()">
        </div>
</div>
</template>

<script>
import axios from 'axios'
import ItemsModal from '../partials/ItemsModal'
export default {
    name: 'InvoiceItems',
    props:['invoice_id'],
    data(){
        return{
            items:[],
            sub_total: 0,
            discount: 0
        }
    },
    components:{
        ItemsModal: ItemsModal
    },
    methods:{
        selectedItem(item){
            this.items.push(item)
            this.calculateTotals()
        },
        calculateTotals(){
            let sub_total = 0
            this.items.forEach((item) =>{
                sub_total += item.total
            })
            this.sub_total = sub_total;
        },
        deleteItem(index){
            return this.items.splice(index,1)
        },
        saveItems(){
            console.log(this.sub_total)
            console.log(this.discount)
            console.log(this.totalAmount)
            axios.put('http://127.0.0.1:8000/data/editInvoice/'+ this.invoice_id, {
                sub_total: this.sub_total,
                discount: this.discount,
                total: this.totalAmount
            })
                .then(response => console.log(response.data))
         }
    },
    computed:{
        totalAmount(){
            return this.sub_total - (this.sub_total * (this.discount/100))
        }
    }
}
</script>