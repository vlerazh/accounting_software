<template>
<div class="create">
    <div class="row">
        <div class="col-xl-5">
            <div class="mb-4">
                <label for="">Invoice Number</label>
                <input type="text" class="form-control " name="invoice_no"  disabled value="invoice_no" >
            </div>
            <div class="mb-4">
                <label for="">Invoice Date</label><br>
                <input type="date" class="form-control " name="invoice_date"  required >
            </div>
            <div class=" mb-4">
                <label for="">Due Date</label><br>
                <input type="date" class="form-control " name="due_date"  required > 
            </div>
        </div>
        <div class="col-xl-5 offset-1">
            <h5>From</h5>
            <hr>
            <div class="mb-4">
                <label for="">From</label>
                <input type="text" class="form-control " name="company_name"  v-model="company.name"  >
            </div>
            <div class="mb-4">
                <label for="">Adress</label>
                <input type="text" class="form-control " name="name" v-model="company.address" >
            </div>            
            <div class="mb-4">
                <label for="">City</label>
                <input type="text" class="form-control " name="name" v-model="company.city" >
            </div>            
            <div class="mb-4">
                <label for="">Country</label>
                <input type="text" class="form-control " name="name" v-model="company.country" >
            </div>            
            <div class="mb-4">
                <label for="">Postal Code</label>
                <input type="text" class="form-control " name="name" v-model="company.postal_code" >
            </div>            
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-xl-5" >
                <h5>For 
                    <span class="btn btn-sm btn-warning float-right" @click="clearCustomer">Clear</span>
                    <span class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#customersModal">Customer</span>
                </h5>
                <hr>
                <div class="mb-4" v-if="customer">
                    <input type="hidden" :value="customer.id" name="customer_id">
                    <label for="">Name</label>
                    <input type="text" class="form-control " name="customer_name"  v-model="customer.name">
                </div>
                <div class="mb-4">
                    <label for="">Email</label>
                    <input type="text" class="form-control " name="name" v-model="customer.email" >
                </div>
                <div class="mb-4">
                    <label for="">Phone</label>
                    <input type="text" class="form-control " name="name" v-model="customer.phone" >
                </div>
                <div class="mb-4">
                    <label for="">Address</label>
                    <input type="text" class="form-control " name="name" v-model="customer.name" >
                </div>
        </div>
    </div>
    <CustomerModal @customerSelected="selectedCustomer"/>
    <InvoiceItems />
</div>

</template>

<script>
import axios from 'axios'
import CustomerModal from './partials/CustomerModal'
import InvoiceItems from './partials/InvoiceItems'
export default {
    name:'CreateInvoice',
    data(){
        return{
            customer: {},
            company: []
        }
    },
    components:
    {
        CustomerModal:CustomerModal,
        InvoiceItems:InvoiceItems
    },        
    mounted(){
        this.getCompany()
    },
    methods:{
        selectedCustomer(customer){
            this.customer = customer
        },
        clearCustomer(){
            this.customer = { }
        },
        getCompany(){
            axios.get('http://127.0.0.1:8000/data/company/details').then(response =>{
                this.company = response.data
            })
        }
    }
}
</script>