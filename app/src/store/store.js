import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";
import resource from '../main.js'


Vue.use(Vuex)

export default new Vuex.Store({
    plugins: [createPersistedState()], //persistir dados

    state: {
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
            state.usuario.data = JSON.parse(user);
            state.usuario.token = token;
            resource.$http
                .get(`empresa/${state.usuario.data.empresa_id}`)
                .then((res) => res.json())
                .then((empresa) => {
                    state.usuario.empresa = empresa;
                    let url = `${resource.$http.options.root}/empresa/${state.usuario.data.empresa_id}/images/logo`;
                    state.usuario.empresa.imgUrl = url;
                }),
                (err) => {
                    console.log(err);
                };
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