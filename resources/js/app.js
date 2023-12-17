require ('./bootstrap')

import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import axios from 'axios';

Vue.use(Vuetify)
Vue.component('auth-component', require('./components/AuthComponent.vue').default)
Vue.component('payment-component', require('./components/admin/PaymentComponent.vue').default)

const vuetify = new Vuetify({
    icons: {
        iconfont: 'mdiSvg', // Выберите нужный формат (mdi, mdiSvg, md, fa, fa4, faSvg)
    },
});

const app = new Vue({
    vuetify: vuetify,
    el: '#app',
})

window.axios = axios;