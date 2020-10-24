import Vue from 'vue'
import App from './App.vue'
import VueResource from 'vue-resource'
import VueRouter from 'vue-router'
import { routes } from './routes'
import './quasar'
import VueSplide from '@splidejs/vue-splide'

Vue.use(VueResource)
Vue.use(VueRouter)
Vue.use(VueSplide)

Vue.http.options.root = 'http://localhost:8000/api';

const router = new VueRouter({
    routes,
    mode: 'history'
})

Vue.config.productionTip = false

new Vue({
    router,
    render: h => h(App),
}).$mount('#app')