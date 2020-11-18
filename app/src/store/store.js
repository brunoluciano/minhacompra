import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";
import resource from '../main.js'


Vue.use(Vuex)

export default new Vuex.Store({
    plugins: [createPersistedState()], //persistir dados

    state: {
        cliente: {
            data: {},
            pessoa: {},
        },
        clienteLogado: false,

        usuario: {
            data: {},
            empresa: {},
            token: {},
        },
    },
    mutations: {
        setUsuario(state, user) {
            state.usuario.data = user;
        },
        setUsuarioEmpresa(state, empresa_id) {
            resource.$http
                .get(`empresa/${empresa_id}`)
                .then((res) => res.json())
                .then((empresa) => {
                    state.usuario.empresa = empresa;
                    let url = `${resource.$http.options.root}/empresa/${empresa.id}/images/logo`;
                    state.usuario.empresa.imgUrl = url;
                }),
                (err) => {
                    console.log(err);
                };
        },
        setToken(state, token) {
            state.usuario.token = token;
        },

        login(state) {
            let user = localStorage.getItem("user");
            let token = localStorage.getItem("token");
            user = JSON.parse(user)
            state.usuario.data = user;
            state.usuario.token = token;
            resource.$http
                .get(`empresa/${user.empresa_id}`)
                .then((res) => res.json())
                .then((empresa) => {
                    state.usuario.empresa = empresa;
                    let url = `${resource.$http.options.root}/empresa/${empresa.id}/images/logo`;
                    state.usuario.empresa.imgUrl = url;
                }),
                (err) => {
                    console.log(err);
                };
        },

        logout(state) {
            state.usuario.data = "";
            state.usuario.empresa = "";
            state.usuario.token = "";

            localStorage.clear();
            localStorage.removeItem('vuex');
            resource.$router.push({ name: "home" });
        },

        loginCliente(state) {
            let cliente = localStorage.getItem("cliente");
            let token = localStorage.getItem("token");
            cliente = JSON.parse(cliente)
            state.cliente.data = cliente;
            state.usuario.token = token;
            resource.$http
                .get(`cliente/${cliente.id}`)
                .then((res) => res.json())
                .then((user) => {
                    state.cliente.pessoa = user.pessoa;
                }),
                (err) => {
                    console.log(err);
                };
        },

        logoutCliente(state) {
            state.cliente.data = "";
            state.cliente.pessoa = "";
            state.usuario.token = "";

            localStorage.clear();
            localStorage.removeItem('vuex');
            resource.$router.push({ name: "home" });
        },

        setClienteLogado(state, val) {
            state.clienteLogado = val;
        }

        // logout (state) {
        //     resource.$http
        //         .post("auth/usuario/logout", {
        //             headers: {
        //                 Authorization: `Bearer ${localStorage.getItem("token")}`,
        //             },
        //         })
        //         .then((res) => {
        //             res.json();
        //             state.usuario = "";
        //         },
        //         (err) => {
        //             console.log(err);
        //         });
        // },
    }
});