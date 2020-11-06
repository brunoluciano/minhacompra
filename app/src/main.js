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
const api_url = Vue.http.options.root;



const router = new VueRouter({
    routes,
    mode: 'history'
})

Vue.config.productionTip = false

// Auth
Vue.use(require('@websanova/vue-auth'), {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/vue-resource.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
    rolesVar: 'type',
    loginData: { url: `${api_url}/auth/usuario/login`, method: 'POST', fetchUser: true },
    fetchData: { url: `${api_url}/auth/usuario/user-profile`, method: 'GET' },
    refreshData: { url: `${api_url}/auth/usuario/refresh`, method: 'POST', atInit: false }
})

new Vue({
    router,
    render: h => h(App),

    data: {
        qtdItensCarrinho: 0,
    }
}).$mount('#app')