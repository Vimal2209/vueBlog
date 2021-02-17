import VueRouter from 'vue-router'
import Example from './js/components/Example.vue'

let routes = [
    {
        path: '/generate_doc',
        component: Example
    }
]

export default new VueRouter({
    routes
}) 