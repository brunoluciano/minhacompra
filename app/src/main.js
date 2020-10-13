import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import { routes } from './routes'
import './quasar'
import {
    Quasar,
    Loading
} from 'quasar'

Vue.use(VueRouter)
Vue.use(Quasar, {
    plugins: {
        Loading
    },
    config: {
        loading: { /* look at QUASARCONFOPTIONS from the API card (bottom of page) */ }
    }
})
const router = new VueRouter({
    routes,
    mode: 'history'
})

Vue.config.productionTip = false

new Vue({
    router,
    render: h => h(App),
}).$mount('#app')