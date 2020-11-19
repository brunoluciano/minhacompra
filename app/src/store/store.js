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
            carrinho: {},
            listaprodutos: {},
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
                    state.cliente.carrinho = user.carrinho;

                    resource.$http
                        .get(`cliente/${cliente.id}/listacarrinho`)
                        .then((res) => res.json())
                        .then((listaprodutos) => {
                            state.cliente.listaprodutos = listaprodutos;
                            state.cliente.listaprodutos.forEach((listaproduto) => {
                                listaproduto.produto.imgUrl = `${resource.$http.options.root}/empresa/${listaproduto.produto.empresa_id}/images/produto/${listaproduto.produto.id}`;
                            });
                        }),
                        (err) => {
                            console.log(err);
                        };
                    console.log(state.cliente)
                }),
                (err) => {
                    console.log(err);
                };
        },

        logoutCliente(state) {
            resource.$router.push({ name: "home" });

            state.cliente.data = "";
            state.cliente.pessoa = "";
            state.usuario.token = "";

            localStorage.clear();
            localStorage.removeItem('vuex');
        },

        setClienteLogado(state, val) {
            state.clienteLogado = val;
        },

        addProdutoCarrinho(state, val) {
            val.produto.imgUrl = `${resource.$http.options.root}/empresa/${val.produto.empresa_id}/images/produto/${val.produto.id}`;
            state.cliente.carrinho.qtdItens++;
            state.cliente.carrinho.total = val.carrinho.total;
            state.cliente.listaprodutos.push(val);
            console.log(val)
        },

        addQtdItensCarrinho(state) {
            state.cliente.carrinho.qtdItens++;
        },
        remQtdItensCarrinho(state) {
            state.cliente.carrinho.qtdItens--;
        },

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