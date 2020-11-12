import Vue from 'vue'
import App from './App.vue'
import VueResource from 'vue-resource'
import VueRouter from 'vue-router'
import { routes } from './routes'
import store from './store/store.js'
import './quasar'
import VueSplide from '@splidejs/vue-splide'

// import auth            from '@websanova/vue-auth';
// import authBearer      from '@websanova/vue-auth/dist/drivers/auth/bearer.esm.js';
// import httpVueResource from '@websanova/vue-auth/dist/drivers/http/vue-resource.1.x.esm.js';
// import routerVueRouter from '@websanova/vue-auth/dist/drivers/router/vue-router.2.x.esm.js';

Vue.use(VueResource)
Vue.use(VueRouter)
Vue.use(VueSplide)

Vue.router = new VueRouter({
    routes,
    mode: 'history'
});
const router = Vue.router;
Vue.http.options.root = 'http://localhost:8000/api';
// const api_url = Vue.http.options.root;

Vue.config.productionTip = false

// Auth
Vue.use(require('@websanova/vue-auth'), {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/vue-resource.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
    rolesVar: 'type',
    loginData: { url: 'http://localhost:8000/api/auth/usuario/login', method: 'POST', fetchUser: true },
    fetchData: { url: 'http://localhost:8000/api/auth/usuario/user-profile', method: 'GET' },
    refreshData: { url: 'http://localhost:8000/api/auth/usuario/refresh', method: 'POST', atInit: false }
});

export default new Vue({
    router,
    store,
    render: h => h(App),
    
    data: {
        qtdItensCarrinho: 0,
    }
}).$mount('#app')