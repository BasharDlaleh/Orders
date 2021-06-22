<template>
<div class="container">
       <h2>Edit Order</h2>
<form @submit.prevent="updateOrder()">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" placeholder="Enter Name" v-model="order.name">
  </div>

  <div class="form-group">
    <label for="customer">Customer</label>
    <select class="form-control" id="customer" v-model="order.customer_id">
      <option v-for="customer in customers.data" :key="customer.id" :value="customer.id">{{customer.name}}</option>
    </select>
  </div>

  <div class="form-check" v-for="product in products.data" :key="product.id">
    <input type="checkbox" class="form-check-input" id="product" :value="product.id" v-model="order.products">
    <label class="form-check-label" for="product">{{product.name}}</label>
  </div>
  <br/>
  <button type="submit" class="btn btn-primary">Update</button>
</form>
    </div>
</template>

<script>
    export default {
      props: ['api_token'],
        mounted() {
          this.loadCustomers();
          this.loadProducts();
          this.loadOrder();
        },

        computed: {
          
        },

        data(){
           return {
             customers: null,
              products: null,
              order: {
                customer_id: null,
                name: null,
                products: []
              },
              id: this.$route.params.id,
        }
           
        },
                        
        methods: {
           
           loadOrder(){ 
              axios.get('/api/order/' + this.id, {
                                        headers: {
                                          'Authorization': `Bearer ${this.api_token}` 
                                        }
                      }).then((response) => { 
                this.order=response.data.data;
                this.order.products = this.order.products.map(function(val, index){
                                               return val.id })
                });
           },
           loadCustomers(){ 
              axios.get('/api/customer', {
                                        headers: {
                                          'Authorization': `Bearer ${this.api_token}` 
                                        }
                      }).then((response) => { this.customers=response;});
           },
           loadProducts(){
              axios.get('/api/product', {
                                        headers: {
                                          'Authorization': `Bearer ${this.api_token}` 
                                        }
                      }).then((response) => {this.products=response;});
           },
           updateOrder(){
             axios.put('/api/order/'+this.id, {name: this.order.name, customer_id: this.order.customer_id, products: this.order.products}, {
                                        headers: {
                                          'Authorization': `Bearer ${this.api_token}` 
                                        }
                      })
             .then(() => {
               Swal.fire(
                'Updated',
                'The order has been updated.',
                'success'
               );
               this.$router.push("/home")
               });
           }
    }
    }
</script>

<style scoped>
/* a class to disable the currently active page link */
.active{
  background-color: blue;
  cursor: auto;
  pointer-events:none;
}

</style>