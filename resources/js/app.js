require ('./bootstrap')

import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import axios from 'axios';

Vue.use(Vuetify)
Vue.component('auth-component', require('./components/AuthComponent.vue').default)
Vue.component('payment-component', require('./components/admin/PaymentComponent.vue').default)
Vue.component('sidebar-component', require('./components/admin/SidebarComponent.vue').default)

const app = new Vue({
    vuetify: new Vuetify(),
    el: '#app',
})

window.axios = axios;