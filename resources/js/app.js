/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import VueRouter from "vue-router";
import Add from "./components/Add";
import Update from "./components/Update";
import Order from "./components/Orders";
import moment from "moment";
import Swal from 'sweetalert2';

window.Vue = require('vue').default;

window.Swal = Swal;

window.Fire=new Vue();

Vue.use(VueRouter);

Vue.filter('formatDate', function(date){

    return moment(date).format('DD-MMMM-YYYY HH:mm');
});

const routes = [
    { path: '/home', component: Order },
    { path: '/add', component: Add },
    { path: '/update/:id', component: Update },
];

const router = new VueRouter({
    routes,
    mode: 'history'
});

Vue.component('pagination', require('laravel-vue-pagination'));

// Vue.component('orders-component', require('./components/OrdersComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
});
