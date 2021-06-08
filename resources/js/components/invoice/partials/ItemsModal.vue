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
                                    :disabled="item.total_quantity == 0"
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
                         <p v-if="message" class="text-center" style="color:red">{{  message }}</p>
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
    props: ['invoice_id'],
    mounted(){
        this.getItems()
    },
    data(){
        return{
            items: [],
            selectedItem: {
                sales_price: 0,
                quantity: 1,
                total_quantity: 0,
                total: 0,
            },
            message: null

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
                this.selectedItem.name = response.data.item.name
                this.selectedItem.sales_price = response.data.item.sales_price
                this.selectedItem.total_quantity = response.data.item.total_quantity
            })
        },
        addInvoiceItem(){
            if(this.checkQuantity()){
                axios.post('storeInvoice' , {item: this.selectedItem , invoice_id:this.invoice_id}).then(response=>{
                    console.log(response);
                })
                this.$emit('selected-item',  this.selectedItem )
                this.selectedItem.sales_price = 0
                this.selectedItem.total_quantity = 0
                this.selectedItem.quantity = 1
                this.message = null
            }else{
                this.message = 'Only ' + this.selectedItem.total_quantity + ' items in stock' 
            }
 
        },
            checkQuantity(){
            if (this.selectedItem.total_quantity < this.selectedItem.quantity){
               return false
            }
            return true
        }
    },
    computed:{
        totalPrice(){
            let total = 0;
            total += (this.selectedItem.sales_price * this.selectedItem.quantity)
            this.selectedItem.total = total
            return total
        },
      
    }

}
</script>