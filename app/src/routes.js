import Home from './components/main/Home.vue';
const BuscarLojas = () =>
    import ('./components/main/BuscarLojas.vue');
const PerfilCliente = () =>
    import ('./components/main/cliente/Perfil.vue');

export const routes = [{
        path: '*',
        component: Home,
        name: 'home'
    },
    {
        path: '/buscarLojas',
        component: BuscarLojas,
        name: 'buscarlojas'
    }, {
        path: '/perfil',
        component: PerfilCliente,
        name: 'perfil'
    }
];