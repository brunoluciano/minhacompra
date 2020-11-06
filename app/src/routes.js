import Home from './components/main/Home.vue';
const BuscarLojas = () =>
    import ('./components/main/BuscarLojas.vue');

const IndexCliente = () =>
    import ('./components/main/cliente/Index.vue');
const PerfilCliente = () =>
    import ('./components/main/cliente/Perfil.vue');

const IndexLoja = () =>
    import ('./components/main/loja/Index.vue');
const MainLoja = () =>
    import ('./components/main/loja/Main.vue');
const Departamento = () =>
    import ('./components/main/loja/Departamento');


const IndexSistema = () =>
    import ('./components/app/Index.vue');
const DashboardGerente = () =>
    import ('./components/app/gerente/Dashboard.vue');
const IndexFuncionario = () =>
    import ('./components/app/funcionario/Index.vue');

export const routes = [{
        path: '*',
        component: Home,
        name: 'home',
        meta: { auth: true }
    },
    {
        path: '/user',
        component: IndexCliente,
        name: 'user',
        children: [{
            path: 'buscarLojas',
            component: BuscarLojas,
            name: 'buscarlojas',
            props: true,
            children: [{
                path: ':cep',
                component: BuscarLojas,
                name: 'buscarlojasbycep',
                props: true,
            }]
        }, {
            path: 'perfil',
            component: PerfilCliente,
            name: 'perfil'
        }]
    },
    {
        path: '/loja',
        component: IndexLoja,
        name: 'loja',
        children: [{
                path: ':id',
                component: MainLoja,
                name: 'lojaMain',
                props: true,
            },
            {
                path: ':loja/departamento/:departamento',
                component: Departamento,
                name: 'departamento',
                props: true,
            },
        ]
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