<template>
    <div>
        <div class="modal fade" id="itemsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select an Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" data-backdrop="false" data-toggle="modal" data-target="#itemsModal"  aria-label="Close">X</button>
                    </div>
                    <div class="modal-body" >
                        <select class="form-select form-select-lg mb-3" name="customer_id" v-if="items" @change="getSelectedItem($event)">
                            <option selected>-Select an Item-</option>
                            <option v-for="item in items " 
                                    :key="item.id"
                                    :value="item.id"
                                    >{{ item.name }}</option>
                        </select>
                          <div class="m-4">
                              <label for="">Sales Price</label><br>
                            <input type="number" class="form-control" v-model="selectedItem.sales_price">
                         </div>
                          <div class="m-4">
                              <label for="">Quantity</label><br>
                            <input type="number" class="form-control" v-model="selectedItem.quantity">
                         </div>
                          <div class="m-4">
                              <label for="">Total</label><br>
                                <span>{{ totalPrice }}</span>
                         </div>
                         <span class="btn btn-success" @click="addInvoiceItem">Add</span>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'ItemsModal',
    mounted(){
        this.getItems()
    },
    data(){
        return{
            items: [],
            selectedItem: {
                sales_price: 0 ,
                quantity: 1,
            },

        }
    },
    methods:{
        getItems(){
            axios.get('http://127.0.0.1:8000/data/all-items').then(response => {
                this.items = response.data
            })
        },
        getSelectedItem(event){
            axios.get('http://127.0.0.1:8000/items/' + event.target.value).then(response => {
                console.log(response.data)
                this.selectedItem = response.data.item
            })
        },
        addInvoiceItem(){
            this.$emit('selected-item',  this.selectedItem )
            this.selectedItem = {}
        }
    },
    computed:{
        totalPrice(){
            let total = 0;
            total += (this.selectedItem.sales_price * this.selectedItem.quantity)
            this.selectedItem.total = total
            return total
        }
    }

}
</script>