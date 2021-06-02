<template>
    <div>
        <div class="modal fade" id="itemsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select an Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" data-backdrop="false" data-toggle="modal" data-target="#itemsModal"  aria-label="Close"></button>
                    </div>
                    <div class="modal-body" >
                        <select class="form-select  mb-3"  v-if="items" @change="getSelectedItem($event)">
                            <option selected>-Select an Item-</option>
                            <option v-for="item in items " 
                                    :key="item.id"
                                    :value="item.id"
                                    >{{ item.name }}</option>
                        </select>
                          <div class="m-4">
                              <label for="">Sales Price</label><br>
                              <p class="price">{{ selectedItem.sales_price }} $</p>
                         </div>
                          <div class="m-4">
                              <label for="">Quantity</label><br>
                            <input type="number" class="form-control" v-model="selectedItem.quantity" name="quantity">
                         </div>
                          <div class="m-4">
                              <label for="">Total</label><br>
                                <p class="price">{{ totalPrice }} $</p>
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
            selectedItem: { },

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
                this.selectedItem = response.data.item
            })
        },
        addInvoiceItem(){
            this.$emit('selected-item',  this.selectedItem )
            this.selectedItem = {}
            $('#itemsModal').toggle()
            $('.modal-backdrop').hide()
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