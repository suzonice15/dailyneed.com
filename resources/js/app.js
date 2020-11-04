require('./bootstrap');
window.Vue = require('vue');

import { Form, HasError, AlertError } from 'vform'
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
window.Form=Form;


/////  add progress bar
import VueProgressBar from 'vue-progressbar'
const VueProgressBarOptions = {
    color: 'green',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
        speed: '0.5s',
        opacity: '0.6s',
        termination: 30
    },
    autoRevert: true,
    location: 'top',
    inverse: false
}
Vue.use(VueProgressBar, VueProgressBarOptions);

import Swal from 'sweetalert2'
window.Swal=Swal;
const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
toast.addEventListener('mouseleave', Swal.resumeTimer)
}
})
window.Toast=Toast;




import VueRouter from  'vue-router';
Vue.use(VueRouter);
import {routes} from './routers';

const  router=new VueRouter({
    routes,
    mode:'history'
});
import Select2 from 'v-select2-component';

Vue.component('Select2', Select2);


Vue.component('admin-master', require('./components/admin/adminmaster.vue').default);
Vue.component('pagination', require('./components/partial/PaginationComponent.vue').default);

window.Laravel = {
    "csrfToken": "foo",
    "baseUrl": "http:\/\/localhost:\/dailyneed.com\/"
}

const app = new Vue({
    el: '#app',
    router,
});
