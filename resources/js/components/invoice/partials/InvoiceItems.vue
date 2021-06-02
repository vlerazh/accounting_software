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
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select name="item_id" class="form-control" id="items">
                                                    <option value="">-- choose item --</option>
                                                    
                                                        <option value="item.id" >
                                                                                             
                                                        </option>
                                                
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
                                        </tr>
              
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
</template>

<script>
export default {
    name: 'InvoiceItems'
}
</script>