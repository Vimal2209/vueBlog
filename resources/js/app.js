require('./bootstrap');

window.Vue = require('vue');

import vuetify from '../plugins/vuetify'
import VueRouter from 'vue-router'
import router from '../routes'

Vue.use(VueRouter)

Vue.component('example', require('../js/components/Example.vue').default)

const app = new Vue({
    vuetify,
    el: '#app',
    router
});
