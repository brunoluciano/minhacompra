import Home from './components/main/Home.vue';
const BuscarLojas = () =>
    import ('./components/main/BuscarLojas.vue');

const IndexCliente = () =>
    import ('./components/main/cliente/Index.vue');
const PerfilCliente = () =>
    import ('./components/main/cliente/Perfil.vue');

const IndexSistema = () =>
    import ('./components/app/Index.vue');
const DashboardGerente = () =>
    import ('./components/app/gerente/Dashboard.vue');
const IndexFuncionario = () =>
    import ('./components/app/funcionario/Index.vue');

export const routes = [{
        path: '*',
        component: Home,
        name: 'home'
    },
    {
        path: '/user',
        component: IndexCliente,
        name: 'user',
        children: [{
            path: 'buscarLojas',
            component: BuscarLojas,
            name: 'buscarlojas'
        }, {
            path: 'perfil',
            component: PerfilCliente,
            name: 'perfil'
        }, ]
    },
    {
        path: '/app',
        component: IndexSistema,
        name: 'app',
        children: [{
                path: 'dashboard',
                component: DashboardGerente,
                name: 'dashboardgerente'
            },
            {
                path: 'pedidos',
                component: IndexFuncionario,
                name: 'dashboardgerente'
            }
        ]
    }
];