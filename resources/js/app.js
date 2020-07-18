
require('./bootstrap');

window.Vue = require('vue');
import Vuetify from '../plugins/vuetify'
import VueRouter from 'vue-router';
import Toasted from 'vue-toasted';
import Swal from 'sweetalert2';

Vue.use(Toasted)
Vue.use(VueRouter);


window.Swal=Swal;
const Toast = Swal.mixin({
  toast: true,
  position: 'top-right',
  showConfirmButton: false,
  timer: 3000
});
window.Toast=Toast;

Vue.component('Navbar', require('./components/header/Navbar.vue').default);
Vue.component('NProduct', require('./components/pages/NProduct.vue').default);
Vue.component('NCategory', require('./components/pages/NCategory.vue').default);

const routes = [
    { name:'home', path: '/', component:  require('./components/pages/Home.vue').default },
    { name:'products', path: '/products', component:  require('./components/pages/Products.vue').default },
    { name:'categorys', path: '/categorys', component:  require('./components/pages/Categorys.vue').default },
    ]

const router = new VueRouter({
    routes:routes ,
mode:'history' // short for `routes: routes`
})

const app = new Vue({
    vuetify:Vuetify,
    el: '#app',
    router
});