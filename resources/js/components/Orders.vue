<template>
<div class="container">
        <div class="row">
          
          <div class="col-12">
            <div class="card  mt-4 mb-1">
              <div class="card-header">
                <h3 class="card-title">Orders Table</h3>

                <div class="card-tools">
                  <router-link to="/add" tag="button" class="btn btn-success float-right mb-4">Add Order</router-link>
                  <a class="btn btn-warning" href="/export">Export As Excel</a>
                <div class="input-group mb-3 mt-2">
                  <input v-model="search" type="text" class="form-control" placeholder="enter your search pattern..">
                  <div class="input-group-append search">
                    <span class="input-group-text" id="basic-addon2" @click="makeSearch"><i class="fas fa-search"></i></span>
                  </div>
                </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Customer</th>
                      <th>Creation Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr  v-for="order in orders.data" :key="order.id">
                      <td>{{ order.id }}</td>
                      <td>{{ order.name }}</td>
                      <td>{{ order.customer.name }}</td>
                      <td>{{ order.created_at | formatDate}}</td>
                      <td><router-link :to="'/update/' + order.id" title="edit" tag="i" class="fas fa-edit text-blue edit"></router-link> |
                          <a title="delete" href="#" @click="deleteOrder(order.id)"><i class="fas fa-trash text-red"></i></a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <pagination :data="orders" @pagination-change-page="getResults"></pagination>
            <!-- /.card -->
          </div>
        </div>
    </div>
</template>

<script>
    export default {
      props: ['api_token'],
        mounted() {
          this.loadOrders();
        },

        computed: {
          
        },

        data(){
           return {
              orders: null,
              orderid: null,
              search: null
           }
        },

        methods: {
          // get the nth page
          getResults(page = 1){
           axios.get('/api/order?page=' + page, {
                                        headers: {
                                          'Authorization': `Bearer ${this.api_token}` 
                                        }
                      })
                .then(response => {
                  this.orders = response.data;
				   });
          },
          // load all orders
          loadOrders(search=null){
            if(!search){
              axios.get('/api/order', {
                                        headers: {
                                          'Authorization': `Bearer ${this.api_token}` 
                                        }
                      }).then((response) => {this.orders=response.data;});
              }
            else
              axios.get('/api/search?search='+search, {
                                        headers: {
                                          'Authorization': `Bearer ${this.api_token}` 
                                        }
                      }).then((response) => {this.orders=response.data;});
           },
          // search orders
          makeSearch(){
              this.loadOrders(this.search);
          },
          // delete an order
          deleteOrder(id){
              Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
             if (result.value) {

               axios.delete('/api/order/'+id, {
                                        headers: {
                                          'Authorization': `Bearer ${this.api_token}` 
                                        }
               }).then(() => {
                                Swal.fire(
                                  'Deleted!',
                                  'The order has been deleted.',
                                  'success'
                                );
                                this.loadOrders();
                                })
                .catch(() => {Swal.fire(
                                         'Something went wrong',
                                         'The order might be already deleted!',
                                         'error'
                                        );
                                        this.loadOrders();
                                        });
              }
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
.edit, .search{
  cursor: pointer;
}

</style>