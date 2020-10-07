import Home from './components/main/Home.vue';
const BuscarLojas = () => import('./components/main/BuscarLojas.vue');

export const routes = [{
    path: '*',
    component: Home,
    name: 'home'
}, {
    path: '/buscarLojas',
    component: BuscarLojas,
    name: 'buscarlojas'
}];