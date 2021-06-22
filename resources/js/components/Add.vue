<template>
<div class="container">
      <h2>Add New Order</h2>
<form @submit.prevent="createOrder()">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" placeholder="Enter Name" v-model="order.name">
  </div>

  <div class="form-group">
    <label for="customer">Customer</label>
    <select class="form-control" id="customer" v-model="order.customerId">
      <option v-for="customer in customers.data" :key="customer.id" :value="customer.id">{{customer.name}}</option>
    </select>
  </div>

  <div class="form-check" v-for="product in products.data" :key="product.id">
    <input type="checkbox" class="form-check-input" id="product" :value="product.id" v-model="order.products">
    <label class="form-check-label" for="product">{{product.name}}</label>
  </div>
  <br/>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
</template>

<script>
    export default {
      props: ['api_token'],
        mounted() {
          this.loadCustomers();
          this.loadProducts();
        },

        computed: {
          
        },

        data(){
           return {
              customers: null,
              products: null,
              order: {
                customerId: null,
                name: null,
                products: []
              }
           }
        },

        methods: {
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
           createOrder(){
             axios.post('/api/order', {name: this.order.name, customer_id: this.order.customerId, products: this.order.products}, {
                                        headers: {
                                          'Authorization': `Bearer ${this.api_token}` 
                                        }
                      })
             .then(() => {
               Swal.fire(
                'Created',
                'The order has been created.',
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