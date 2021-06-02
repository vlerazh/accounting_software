<template>
    <div>
        <div class="modal fade" id="customersModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select a Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" data-backdrop="false" data-toggle="modal" data-target="#customersModal"  aria-label="Close">X</button>
                    </div>
                    <div class="modal-body" >
                        <select class="form-select form-select-lg mb-3" name="customer_id" v-if="customers" @change="getCustomer($event)">
                            <option selected>-Select a Customer-</option>
                            <option v-for="customer in customers " 
                                    :key="customer.id"
                                    :value="customer.id"
                                    >{{ customer.name }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'CustomerModal',
    mounted(){
        this.getCustomers()
    },
    data(){
        return{
            customers: []
        }
    },
    methods:{
        getCustomers(){
            axios.get('http://127.0.0.1:8000/data/all').then(response =>{
                this.customers = response.data
            })
        },
        getCustomer(event){
            axios.get('http://127.0.0.1:8000/customers/' + event.target.value).then(response => {
                console.log(response.data)
                this.$emit('customerSelected',  response.data.customer)
            })
        }
    }

}
</script>